# Food-Facts-Laravel
Sample laravel app that scrapes and stores food facts.

### Installation steps;

1. Run `composer install`.
2. Run `cp .env.example .env` and update it.
4. Run `php artisan jwt:secret`.
3. Run `php artisan migrate`.
5. (Local) Run `php artisan db:seed`.
6. Set up (cron) Laravel scheduler that will run  `php artisan service:food`
    * Check `App\Console\Kernel.php` and `App\Console\Commands\FoodServiceCommand.php` for examples.
