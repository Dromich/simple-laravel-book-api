
## Simple Laravel books API

To start you need clone repo.

Next step make .env file. For reference use .env.example on root directory.
To final step run commands:
```sh
php artisan migrate
php artisan db:seed --class=BooksTableSeeder
```
To start locally work, run the command:

```sh
php artisan serve
```


## Launching with Docker

Before you start, make sure you have installed  docker and docker-compose!

To create and run a container, run the command

```sh
docker-compose up --build -d
```


After launching the container, migrate the database. To do this, run the command:

```sh
docker-compose exec app php artisan migrate
```

If you need to fill the database with test data, run the command:

```sh
docker-compose exec app php artisan db:seed --class=BooksTableSeeder
```

For local development, you can run 

```sh
docker-compose exec app php artisan serve --host=0.0.0.0 --port=8000
```
Your local server will be available at http://127.0.0.1:8000

## Testing 

To run the built-in tests, run the command

```sh
#Local
php artisan test 
```

```sh
#Docker
docker-compose exec app php artisan test 
```


## Troubleshooting 

If you encounter problems with dependencies after running the container, run the command:

```sh
docker-compose exec app composer dump-autoload
```

If you receive an error:

> ERROR Command "test" is not defined. Did you mean one of these?

Run command:

```sh
#Local
composer require nunomaduro/collision
```

```sh
#Docker
docker-compose exec app composer require nunomaduro/collision 
```
