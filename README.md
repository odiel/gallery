Installation
------------
Make sure you have PHP 7.0 installed before running this code; if not, use your OS package manager to install it.

Composer is required to install the dependencies and keep track of the required versions, make sure to have it installed, follow the instruccions here https://getcomposer.org/ if you dont have it.

Once composer is installed checkout the repo and from within the folder run:

composer install

this will download all the required dependencies.

Running
-----------
This code uses the Slim (https://www.slimframework.com/docs) framework as a dependency. 

The right way to run this code is by using a web server Apache or nginx and setting up a vhost.

To setup a web server follow the instructions here https://www.slimframework.com/docs/v3/start/web-servers.html
, the entry point (document root) of the project is ./public/index.php 

If you want to run the code in dev mode and for testing purposes use the following command to have PHP serving the file:

php -S 192.168.75.128:8888 -t public public/index.php


Testing
-----------
Use the file on db/file.json to add custom data and test the code with different tag set.
