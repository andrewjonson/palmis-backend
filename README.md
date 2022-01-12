# Project Installation

composer install

cp .env.example .env

change database credentials in .env file

php artisan migrate --seed

php artisan passport:install

copy client id and client secret to .env file

## Install Redis

1. Run Redis.msi located in project folder

Note: Make sure you added redis to your environment variables

2. If you want to use php_redis

Copy php_redis.dll file to PHP extension \xampp\php\ext
Edit the php.ini file and add extension=php_redis.dll
Restart xampp

3. If you want to use predis

Replace the following line in config/database.php:

'client' => env('REDIS_CLIENT', 'phpredis')

to:

'client' => env('REDIS_CLIENT', 'predis')
then, add the predis dependency with composer:

composer require predis/predis

4. Try and test by typing 'ping' in your CLI. When 'pong' shows. The redis server successfully installed.

5. Done !!!