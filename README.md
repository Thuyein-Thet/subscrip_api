Fist change config in .env migration, then mail setting also. Then run migrate,

$ php artisan migrate

There are 4 tables. Need to make db:seed for two tables User and Websites.
$ php artisan db:seed --class=UserSeeder
$ php artisan db:seed --class=WebsiteSeeder

Then you can able to use apis. There are two apis, one for create post and another is to subscribe websites.

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
