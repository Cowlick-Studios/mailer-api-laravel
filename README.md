# Mailer API Laravel

The mailer application allows you to easily submit forms to an api which will in turn send them to a mailing address. Usually used for contact.

## Project setup

``` bash
# Clone the repo
git clone git@github.com:PrismLabsDev/mailer-api-laravel.git

# install dependencies
composer install

# Copy .env.example to .env
cp .env.example .env

# Generate application key and add it to .env (APP_KEY)
php artisan key:generate --show
```

## Run laravel sail (dev environment)

``` bash
# Start docker development environment
./vendor/bin/sail up -d

# Stop docker environment
./vendor/bin/sail down

# Stop docker environment and remove volume data
./vendor/bin/sail down -v

# Runs migrations on empty DB
./vendor/bin/sail artisan migrate

# Destroy database and regenerate migrations with seeding data
./vendor/bin/sail artisan migrate:fresh --seed
```

## Application commands

``` sh
# Generate new user
./vendor/bin/sail artisan app:create-new-user "User Nme" "user@example.com" "password"
```

## Connections

You can access the running application on port 80 of your local system, this can be done by simply going to [http://localhost/](http://localhost/)

The connection details for the docker environment is taken from the project .env file. Meaning whatever connections you set in your .env file will automatically be used in your docker container. By default the connections are set to the following:

|      **Key**      |    **Value**   |
|:-----------------:|:--------------:|
| MySQL Host        | localhost:3306 |
| MySQL Username    |     mailer     |
| MySQL Password    |    password    |
| MySQL DB          |     mailer     |
| Redis Host        | localhost:6379 |
| Mailpit SMTP      | localhost:1025 |
| Mailpit Dashboard | localhost:8025 |
|                   |                |