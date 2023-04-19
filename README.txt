Fist change config in .env for migration and also for mail setting also.
For example, I use mysql for db and gmail for mail sender.

mysql Config
------------
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=dbname
DB_USERNAME=dbUsrName
DB_PASSWORD=password

Mail Config
-----------
MAIL_DRIVER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=mailaddress@gmail.com
MAIL_PASSWORD=fdsfdsfsdfds   #this is app key from gmail
MAIL_FROM=Subscription Noti App
MAIL_ENCRYPTION=tls

Then composer install and run migrate,

$ php artisan migrate

There are 4 tables. Need to make db:seed for two tables Users and Websites.
$ php artisan db:seed --class=UserSeeder
$ php artisan db:seed --class=WebsiteSeeder

Then you can able to use API. There are two APIs, one for create post and another is to subscribe websites.

To create Post
--------------
http://localhost:ur_port/api/create_post

Json_data
---------
{
    "title":"Bagan",
    "description":"About Bagan",
    "website_id":"3"
}

Method => POST



To subscribe websites
---------------------
http://localhost:8000/api/subscribe

Json_data
---------
{
    "website_id":"3",
    "user_id":"5"
}

Method => POST

**Note** Need to manipulate user and website datas first before create Posts and Subscribe Websites.

Then, send noti about new posts to subscribers with command.
$ php artisan send

If you want to run command with schedule , need to add config in your server's cron tab.
