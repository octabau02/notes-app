#!/bin/sh
mkdir -p /var/www/html/storage/database
php artisan package:discover --ansi
php artisan migrate --force
chown -R www-data:www-data /var/www/html/storage/database
php artisan config:cache
php artisan route:cache
php artisan view:cache
apache2-foreground
