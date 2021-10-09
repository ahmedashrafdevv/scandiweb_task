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
USE scandiweb_products;

source /home/dev/db.sql


DROP
    DATABASE IF EXISTS scandiweb_products_test;
CREATE DATABASE scandiweb_products_test;
USE scandiweb_products_test;

source /home/dev/db.sql
