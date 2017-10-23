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


## Pages

- /login - Laravel basic auth login page
- /register - Laravel basic auth registration page
- /questionnaire - Displays a survey of 3 questions to answer, and controls for switching dates
- /home - Dashboard that displays results of each question by date, and a chart that tallies all answers


## Testing

On the command line, navigate to the root of the application directory and run the command `./vendor/bin/phpunit` in order to initialize and run the test suite. The tests can be found in the Test directory.


## Libraries Utilized

- Laravel 5.5
- Vue 2.1
- Bootstrap 3
- Highcharts 6.6
- Vue-Highcharts 0.0.10
