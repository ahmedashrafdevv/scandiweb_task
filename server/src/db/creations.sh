#/bin/bash

sudo docker exec -it mysqldev_mysql-server_1 mysql -u root -p secret -e "
    DROP
        DATABASE IF EXISTS scandiweb_products;
    DROP
        DATABASE IF EXISTS scandiweb_products_test;
    CREATE 
        DATABASE scandiweb_products;
    DROP
        DATABASE IF EXISTS scandiweb_products;
    CREATE
        DATABASE scandiweb_products;
    CREATE 
        DATABASE scandiweb_products_test;"


sudo docker exec -it mysqldev_mysql-server_1 mysql -u root -p secret -e "USE scandiweb_products_test;"
sudo docker exec -it mysqldev_mysql-server_1 mysql -u root -p secret -e "source ($pwd)/db.sql;"


sudo docker exec -it mysqldev_mysql-server_1 mysql -u root -p secret -e "USE scandiweb_products;"
# mysql -u root -p secret -e "source ($pwd)/db.sql;"
