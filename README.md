Studentenclub Kiste e.V.
========================
Symfony web application of the Studentenclub Kiste e.V. from Magdeburg, Germany.

## System Requirements
* PHP 7+
* MySQL 5.7+

## Setup for Development
Clone the repository from github
```
git clone git@github.com:gibso/club-kiste.git
```
Enter the new directory
```
cd club-kiste
```
Install the php dependencies with composer 
```
composer install
```
While installing, you have to configure the parameters for the database connection and the mailserver. The parameters `mailer_user` and `mailer_password` **must not** be empty. 

Now create the database
```
php bin/console doctrine:database:create
```
and the database tables
```
php bin/console doctrine:schema:create
```
At least you need to install the frontend dependencies with bower
```
bower install 
```
Now you can start the application with the built-in symfony web-server
```
php bin/console server:run
```

## Author
Developed by [Oliver Görtz](https://www.xing.com/profile/Oliver_Goertz9).

Reach me at [GitHub](https://github.com/gibso), [XING](https://www.xing.com/profile/Oliver_Goertz9) and [Facebook](https://www.facebook.com/ogoertz).
