# KP-Magang-Jogja

## Prerequisites
- [composer](https://getcomposer.org/)
- [NodeJS](https://nodejs.org/en/)
- [NPM](https://nodejs.org/en/) or [Yarn](https://yarnpkg.com/)


## Framework used
- Laravel 8.5.15
- Tailwindcss 2.10
## Getting started
- Clone the repository

```sh
git clone https://github.com/changeweb/Unifiedtransform
```
- Copy the contents of the `.env.example` file to create `.env` in the same directory

- Run `composer install` and then `yarn install` or `npm install` 
- for `developer` environment, run `composer install --optimize-autoloader --no-dev` then `yarn watch` or `npm watch`
- for `production` environment to install Laravel packages (Remove **Laravel Debugbar**, **Laravel Log viewer** packages from **composer.json** and  from `config/app.php` before running **`composer install`** in **Production Environment**) then run `yarn prod` or `npm prod`

```php
   //Provider
   Barryvdh\Debugbar\ServiceProvider,
   Logviewer Service provider,
   //Alias
   Debugbar' => Barryvdh...
```

- Generate `APP_KEY` using `php artisan key:generate`

- Edit the database connection configuration in .env file e.g.

```sh
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=magang_jogja
DB_USERNAME=root
DB_PASSWORD=
```
> Note that this is just an example, and the values may vary depending on your database environment.

- Set the `APP_ENV` variable in your `.env` file according to your application environment (e.g. local, production) in `.env` file

- Migrate your Database with `php artisan migrate`

- Seed your Database with `php artisan db:seed`

- On localhost, serve your application with `php artisan serve`

## License
![MIT](https://img.shields.io/badge/License-MIT-blue.svg)
