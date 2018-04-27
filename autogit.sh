#!/bin/bash
Laravel_PATH="/var/www/laravel"
cd $Laravel_PATH
git add -A
Time=$(date +"%Y%m%d_%H%M")
git commit -m $Time
mysqldump --user=root --password=e8d.com support > /var/www/laravel/storage/backup/DB_$Time.sql


