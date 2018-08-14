#!/bin/bash
Laravel_PATH="/var/www/laravel"
cd $Laravel_PATH
php artisan backup:clean
php artisan backup:run --only-db

