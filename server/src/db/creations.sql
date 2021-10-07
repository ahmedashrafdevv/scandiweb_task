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

source //wsl$/Ubuntu/home/dev/ahmedashrafdevv/interviews/scandiweb/scandiweb_task/server/src/db/db.sql


DROP
    DATABASE IF EXISTS scandiweb_products_tes;
CREATE DATABASE scandiweb_products_tes;
USE scandiweb_products_tes;

source //wsl$/Ubuntu/home/dev/ahmedashrafdevv/interviews/scandiweb/scandiweb_task/server/src/db/db.sql
