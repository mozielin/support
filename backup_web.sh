#!/bin/bash
Laravel_PATH="/var/www/laravel"
cd $Laravel_PATH
git add -A
Time=$(date +"%Y%m%d_%H%M")
git commit -m $Time
tar zcvf /var/www/laravel/storage/backup/Web_$Time.tar.gz /var/www/laravel/ --exclude=/var/www/laravel/storage

