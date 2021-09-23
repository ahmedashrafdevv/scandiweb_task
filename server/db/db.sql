# schema
    #types :
    #structure 
    #id
    #name
    # relations
    # every type belongs to many products
    #products :
    #structure 
    # id INT
    # name VARCHAR
    # sku VARCHAR
    # price FLOAT
    # typeId INT
    # relations
    # every product has one type
    # every product has many properties
    #properties :
    #structure 
    #name  VARCHAR
    #unit  VARCHAR
    #content  VARCHAR
    #productId  INT
    # relations
    # every property has one product
DROP
    DATABASE IF EXISTS scandiweb_products;
CREATE DATABASE scandiweb_products;
# here we are creating the product types table with very simple schema just store the name
# and now we can create as many types as we can and attach them to the products simply
CREATE TABLE TYPES(
    id INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(250)
) ENGINE = INNODB;
# here we are creating the products table
# we  will store sku as binary and reurn it in redable way on select
# typeId column will be used to select the properties of the products from properties table
# it will has a foreign key with types.id so we will be able to view the name of the type by simple inner join
CREATE TABLE products(
    sku VARCHAR(36) PRIMARY KEY,
    name VARCHAR(250),
    price FLOAT,
    typeId INT,
    CONSTRAINT fk_type FOREIGN KEY(typeId) REFERENCES TYPES(id) ON DELETE RESTRICT ON UPDATE RESTRICT,

    INDEX (sku) 
) ENGINE = INNODB;
# here we are creating the products table
# this table will be responsible for creating properties as many as we like to any specific product
# [NOTE] i didn't add a primary key to this table 
# because i dont think at any time this project may need to list properties based on there ids
# it will always be attached with products
CREATE TABLE properties(
    name VARCHAR(250),
    unit VARCHAR(10) UNIQUE,
    content VARCHAR(100) UNIQUE,
    productSku VARCHAR(36),
    CONSTRAINT fk_product FOREIGN KEY(productSku) REFERENCES products(sku) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = INNODB;
# let's  insert some dummy data
INSERT INTO TYPES(`name`)
VALUES('DVD'),('FURNITURE'),('BOOK');
# here is the ids of types as inserted above 
#  [
#       1 , DVD
#       2 , FURNITURE
#       3 , BOOK
#   ]

INSERT INTO products(sku, name, price, typeId)
VALUES
    (UUID(), 'ACME DISC', 1, 1),
    (UUID(), 'CHAIR', 40, 2),
    (UUID(), 'WAR AND PEACE', 20, 3);
        
        
INSERT INTO properties(
            name,
            unit,
            content,
            productSku
        )
    VALUES(
        'Size',
        'MB',
        '700',
    (SELECT
        sku
    FROM
        products
    LIMIT 1)
    ),
    (
        'Weight',
        'KG',
        '2',
    (SELECT
        sku
    FROM
        products
    LIMIT 1 OFFSET 1)
    ),
    (
        'Dimensions',
        'HxWxL',
        '24x45x15',
    (SELECT
        sku
    FROM
        products
    LIMIT 1 OFFSET 2)
    );





# now lets create our procedures logic

# get products procedure will be called to load all the products from the database at once
DELIMITER //

CREATE PROCEDURE GetProducts()
BEGIN
	SELECT p.sku , p.name , p.price , prop.name , prop.unit , prop.content FROM `products` p JOIN properties prop ON p.sku = prop.productSku ORDER BY p.sku 
END //

DELIMITER ;


# create product procedure will be called to create a  new product
DELIMITER //

CREATE PROCEDURE CreateProduct(
    IN productName varchar(250) ,
    IN productPrice FLOAT
)
BEGIN
	INSERT INTO products 
    (
        sku,
        name,
        price
    ) 
    VALUES 
    (
        UUID(),
        productName,
        productPrice
    )
END //

DELIMITER ;


# create property procedure will be called to create a  new prop  to an existing product
# it will takes PRODUCT sku as a parameter
DELIMITER //

CREATE PROCEDURE CreateProperty(
    IN propName varchar(250) ,
    IN propUnit varchar(10) ,
    IN propContent varchar(100) ,
    IN propProductSku varchar(36) 
)
BEGIN
	INSERT INTO properties 
    (
        name,
        unit,
        content,
        productSku
    ) 
    VALUES 
    (
        propName,
        propUnit,
        propContent,
        propProductSku
    )
END //

DELIMITER ;


