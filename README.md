1) composer install
2) php artisan migrate
3) create a user using the postman saved session in folder->user titled: http://127.0.0.1:8000/api/create-user 
   use is_admin = 0 for common user and 1 for admin user
4) try out all other included postman queries
5) added one basic test. run it using ./vendor/bin/phpunit