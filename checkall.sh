#!/bin/bash
echo "Rollback all migrations"
echo "========================================================================="
php artisan migrate:reset
echo "==================== Composer dump autoload===================="
composer dump-autoload
echo "==================== Artisan migrate===================="
php artisan migrate
echo "==================== Artisan db:seed===================="
php artisan db:seed
echo "======================================================"
echo "git status"
git status
echo "======================================================"
composer dump-autoload
