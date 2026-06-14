#!/bin/sh
[ ! -d "vendor" ] && composer install
[ ! -f "database/database.sqlite" ] && touch database/database.sqlite
php artisan migrate --force
apache2-foreground
