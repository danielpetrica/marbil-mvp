# Project install

## Requirements:
- docker
-
## Initial installation
Execute this command in the repository folder


    docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
Now let's generate a .env file  by running `cp .env.example .env`

Please set a value for DB_PASSWORD

Then please execute    `./vendor/bin/sail up -d`  to start the docker containers. This may take a while.
Now let's generate a new key with `./vendor/bin/sail artisan key:generate`.

Now let's migrate the database, to do so please execute `./vendor/bin/sail artisan migrate:fresh`  (this will also delete any existing data in the db)

### Worker and Cron start
To start the jobs worker and the cron listener we need to run two commands in two terminals

For the cron (which takes care of mail scheduling),     `./vendor/bin/sail artisan schedule:work`
for the queue I recommend  using      `./vendor/bin/sail artisan queue:listen ` to also handle code changes.

To generate the first user use  `./vendor/bin/sail artisan make:filament-user `  follow the wizard to provide the required details.

Now you're ready to go.
