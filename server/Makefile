install:
	sudo apt install php libapache2-mod-php && composer install

migrate:
	mysql -u root -p asd@asd@ -e "SOURCE $(pwd)src/db/cretions.sh"

run:
	php -S 127.0.0.1:8001

test:
	vendor/bin/phpunit tests