#!/bin/sh
[ ! -d "vendor" ] && composer install
mkdir -p storage/database
[ ! -f "storage/database/database.sqlite" ] && touch storage/database/database.sqlite
php artisan migrate --force
apache2-foreground
