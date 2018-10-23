## Turtle

A travel blog and travel destination comparison website

## Used technologies in this project
- PHP
- MySQL
- Laravel
- React
- Sass
- Bootstrap 4
- Font Awesome

Create development environment
1. Run "npm install"
2. Run "composer install"
3. Run "npm run webpack"
4. Run "npm run sass"
5. Copy .env.example as .env and configure needed settings
6. Run "php artisan migrate" to setup database

## Testing

Running tests
- Run in command line when in root directory: "php phpunit.phar -c blog/phpunit.xml"

Creating new test cases or mocks
- Run in command line when in root directory: "composer dump-autoload"
  * This autoloads the new files so that they don't need to be included in the actual code files