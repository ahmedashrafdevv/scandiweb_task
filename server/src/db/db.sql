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
# here we are creating the product types table with very simple schema just store the name
# and now we can create as many types as we can and attach them to the products simply
CREATE TABLE types(
    id INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(250),
    prop_name varchar(100),
    prop_unit varchar(100)
) ENGINE = INNODB;
# here we are creating the products table
# we  will store sku as binary and reurn it in redable way on select
# typeId column will be used to select the properties of the products from properties table
# it will has a foreign key with types.id so we will be able to view the name of the type by simple inner join
CREATE TABLE products(
    sku VARCHAR(36) PRIMARY KEY,
    name VARCHAR(250),
    price FLOAT,
    `type_id` INT,
    prop_content VARCHAR(100),
    CONSTRAINT fk_type FOREIGN KEY(`type_id`) REFERENCES types(id) ON DELETE SET NULL ON UPDATE SET NULL,
    INDEX (sku) 
) ENGINE = INNODB;

# let's  insert some dummy data
INSERT INTO types(`name` , prop_name , prop_unit)
VALUES('DVD' , 'size'  , 'mb'),('FURNITURE' , 'Dimensions' , 'HxWxL' ),('BOOK'  , 'Weight' , 'kg');
# here is the ids of types as inserted above 
#  [
#       1 , DVD
#       2 , FURNITURE
#       3 , BOOK
#   ]

INSERT INTO products(sku, name, price, `type_id` , prop_content)
VALUES
    (UUID(), 'ACME DISC', 1, 1 , '20'),
    (UUID(), 'CHAIR', 40, 2 , '24X24X24'),
    (UUID(), 'WAR AND PEACE', 20 , 3, '.5');
        
# now lets create our procedures logic

# get products procedure will be called to load all the products from the database at once
DELIMITER //

CREATE PROCEDURE GetProducts()
BEGIN
	SELECT p.sku , p.name , p.price , t.prop_name , t.prop_unit , p.prop_content FROM `products` p INNER JOIN types t ON p.type_id = t.id ORDER BY p.sku ;
END //

DELIMITER ;


# create product procedure will be called to create a  new product
DELIMITER //

CREATE PROCEDURE CreateProduct(
    IN productName varchar(250) ,
    IN productPrice FLOAT , 
    IN productTypeId int , 
    IN propContent varchar(100)
)
BEGIN
    DECLARE uuid VARCHAR(36);
    SET uuid = UUID();
	INSERT INTO products 
    (
        sku,
        name,
        price,
        `type_id`,
        prop_content
    ) 
    VALUES 
    (
        uuid,
        productName,
        productPrice,
        productTypeId,
        propContent
    );
    SELECT uuid;
END //

DELIMITER ;





# create product procedure will be called to create a  new product
DELIMITER //

CREATE PROCEDURE GetTypes()
BEGIN
    SELECT id , name , prop_name , prop_unit FROM types;
END //

DELIMITER ;



# delete product procedure will be called to create a  new product
DELIMITER //

CREATE PROCEDURE DeleteProducts(IN productSku VARCHAR(36))
BEGIN
    DELETE FROM products WHERE sku = productSku;
END //

DELIMITER ;
