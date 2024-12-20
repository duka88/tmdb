#!/bin/bash
echo "Rollback all migrations"
echo "========================================================================="
rm database/database.sqlite
echo "==================== Artisan migrate===================="
php artisan migrate
echo "==================== Artisan db:seed===================="
php artisan db:seed
echo "===========================Git status==========================="
echo "git status"
git status
echo "==================== Composer dump autoload===================="
composer dump-autoload
