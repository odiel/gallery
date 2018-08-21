Installation
------------
Make sure to have composer installed, follow the instruccions here https://getcomposer.org/ if not.

Running
-----------
This code uses the Slim (https://www.slimframework.com/docs) PHP framework as a dependency. 

The right way to run this code is by using a web server Apache or nginx and setting up a vhost.

To setup a web server follow the instructions here https://www.slimframework.com/docs/v3/start/web-servers.html
the entry point (document root) of the project is ./public/index.php 

If you want to run the code in dev mode and for testing purposes use the following command to have PHP serving the file:

php -S 192.168.75.128:8888 -t public public/index.php


Testing
-----------
Use the file on db/file.json to add custom data and test the code with different tag set.
