# Laravel Vue Sample

A Laravel and Vue demo project

- [Clone](#clone)
- [Install](#install)
- [Database](#database)
- [Run tests](#run-tests)

## Clone

``` bash
git clone https://github.com/franc0rk/laravel-vue-sample.git
```
or
``` bash
git clone git@github.com:franc0rk/laravel-vue-sample.git
```

## Install

Install project dependencies
``` bash
composer install
```
Copy .env file
``` bash
cp .env.example .env
```
Generate your new app key
``` bash
php artisan key:generate
```


## Database
Set your database `DB_DATABASE` and database for tests `DB_DATABASE_TESTS` inside `.env`

Migrate and seed for interact with records
``` bash
php artisan migrate --seed
```

## Run tests
``` bash
vendor/bin/phpunit
```
