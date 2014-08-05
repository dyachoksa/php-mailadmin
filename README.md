PHP-MailAdmin
=============

Simple administrative interface for Postfix/Dovecot with PostgreSQL (or MySQL).

Postfix/Dovecot
---------------

Follow this tutorial [https://workaround.org/ispmail/wheezy](https://workaround.org/ispmail/wheezy).
Use files from **contrib** folder.

Requirements
------------
  + Apache/Nginx or any other web-server
  + PHP >= 5.3.0
  + Composer
  + PHP PDO adapter (PostgreSQL or MySQL)


Installation
------------
Clone or unpack source into separate directory.

Run:

    composer install

or

    php composer.phar install

Edit database connection settings in **app/config/database.php** and base url in **app/config/app.php**.
Then run:

    php artisan migrate

Point your virtual host's document root to **public** folder.

**IMPORTANT!!!** At this moment PHP-MailAdmin doesn't provide any of security restrictions.
