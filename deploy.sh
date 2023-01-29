#!/bin/sh

# create an alias for composer
shopt -s expand_aliases
alias composer=/opt/cpanel/composer/bin/composer
readonly HOME=~
export HOME

# activate maintenance mode
php artisan down

# update source code
git fetch origin
git reset --hard HEAD
git checkout origin/release/staging

# update PHP dependencies
composer install --no-interaction --prefer-dist
# --no-interaction Do not ask any interactive question
# --no-dev  Disables installation of require-dev packages.
# --prefer-dist  Forces installation from package dist even for dev versions.

# update database
php artisan migrate --force
# --force  Required to run when in production.

# stop maintenance mode
php artisan up
