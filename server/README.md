# scandiweb junior developer test task (api)

    this is the api part of a simple product managment project tasked by scandiweb


## installation
    1 - clone repo
    2 - and then run 
        ``` make install

## endpoints
    GET: "/" get all products from db
    POST: "/addnewe" insert ne product to db
    DELETE: "/delete" delete array of products from db


## database design
    ### schema
        #### types :
            ##### structure 
                id INT
                name VARCHAR()
                prop_name VARCHAR()
                prop_unit VARCHAR()
            ##### relations
                every type belongs to many products
        #### products :
            ##### structure 
                sku VARCHAR(36)
                name VARCHAR
                price FLOAT
                typeId INT (REFERENCES types.id)
            ##### relations
                every product has one type
    

    ### procedures
        #### GetProducts
            ##### params
                takes no parameters

            ##### responsibility
                perform a simple select from products with join to types to load the property name and unit from types table
        #### CreateProduct 
            ##### params
                 productName varchar(250) ,
                 productPrice FLOAT , 
                 productTypeId t , 
                 propContent varchar(100)
            ##### responsibility
                perform insert into our db 
        #### GetTypes
            ##### params
                takes no parameters

            ##### responsibility
                perform a simple select from types
        #### DeleteProducts
            ##### params
                productSku VARCHAR(36)
            ##### responsibility
                Delete product from db by its sku
            

##folder tree

    --src
        --controllers
            --Controller.php
            --ProductController.php
        --db
            --creations.sql
            --db.sql
            --Db.php
        --models
            --ModelInterface.php
            --Product.php
            --Type.php
        --repositores
            --db
                --ProductRepository.php
        --router
            --traits
                --RouteTrait.php
            
            --Api.php
            --Route.php
            --Router.php
            --RouterInterface.php
            --UrlGenerator.php


        --utils
            --Env.php
            --Validation.php
            --ValidationInterface.php

    --tests
        .env.test 
        ProductRepositoryTest.php
        ValidationTest.php



## simple technical description
    Api.php is the entry point of our application it defines routes and map the request to the proper function from Controllers the Controller Class will class a function from the Repository to perform db logic then return the respone to user
## Request Lifecycle
    Api.php
        Will define routes  and map the request to the proper function from Controller (in this application we only have ProductController which extends Controller)

    ProductController.php
        Will recieve the request and call the proper function from the repository (in this application we only have ProductRepository)

    ProductRepository.php
        will peroform the proper db query and return response to the controller


