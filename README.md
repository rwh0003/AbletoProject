# AbletoProject
Test App for Roger Harris's Ableto application. Basic date-based questionnaire with a dashboard for review.


## Local Installation

1. Clone repo
2. Run `composer install` and `npm install`
3. Create and configure .env file
4. Generate key with `php artisan key:generate`
5. Run migrations and seed database with `php artisan migrate --seed`
6. Compile assets with `npm run dev`
7. Run `php artisan serve` to start a local server at 127.0.0.1:8000


## Libraries utilized

- Laravel 5.5
- Vue 2.1
- Bootstrap 3
- Highcharts 6.6
- Vue-Highcharts 0.0.10
