Studentenclub Kiste e.V.
========================
Symfony web application of the Studentenclub Kiste e.V. from Magdeburg, Germany.

## System Requirements
* PHP 7+
* MySQL 5.7+

## Setup
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
At least you need to install the frontend dependencies with bower
```
bower install 
```
