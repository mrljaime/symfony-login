Symfony's project to start applicaton, handle with user creation an login forms
===============================================================================

The project is just the started point to create a symfony's based application
that handle user creation and authentication.

All configurations about paths are stored in this both files: 
 * app/config/security.yml
 * src/AppBundle/Controllers/SecurityController.php
 
There's some TODO's that you need to replace, specially the one in roles configuration.


In order to start the project, you need at least:
 * [**Composer**][1]
 * [**MariaDB**][2] (To me, the better option today)
 

Installing the project 
----------------------

After clone or download and unzip this repository, placed on root project directory

 * > composer install
    * Set your database credentials when prompt ask for
 * > bin/console doctrine:schema:update -f --dump-sql
 * > bin/console server:run

Once you have done the three steps list before, you can access into 
 > http://localhost:8000/project/
  
(if you don't change paths after installation) and you will see how project makes a redirect into login form.
 
To create a new user to be authenticated, go into 
 > http://localhost:8000/project/register
 
All information about build this little config steps is here:
 [*Symfony Login Form*][3]

[1]:  https://getcomposer.org/download/
[2]:  https://mariadb.com/products/technology/server
[3]:  http://symfony.com/doc/current/security/form_login_setup.html