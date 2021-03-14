# UL EXERCISE #2

Create a single page mini event access ticket system so that it allows to create 3 different tickets via form: VIP, preference and general, limited to 15, 20 and 25 people. The form must register an assistant and once submitted, it sends a QR code with a dummy link.

Required: database migration. Please focus on software architecture, clean code... Automatic testing is a plus.
Recommended frameworks: Laravel, Symphony, Yii2.
Required components/libraries to add these functionalities (email and QR) can be added via composer.




## Tech stack

- PHP
- Laravel
- TailwindCSS
- MySQL
- PHPUnit



## Requirements

- PHP >= 7
- MySQL => 5
- npm



## Install

First of all, install dependencies:
```sh
composer install
npm install
```

Then, copy the example environment file and edit as necessary.
```sh
cp .env.example .env
```
> NOTE: Don't forget to setup the mail driver. In the .env.example file is set as sendmail, but you can choose any of the drivers available for Laravel (mailgun for example).

Generate encription key and database migrations:
```sh
php artisan key:generate
php artisan migrate
```

There are only two routes:
|METHOD|PATH|DESCRIPTION
|--|--|--|
|GET|/|Ticket creation form|
|POST|/|Ticket creation form result|




## Tests

To execute phpunit:
```sh
php artisan test
```

If you want to perform parallel execution:
```sh
php artisan test --parallel
```



## Screens

![Result screen](https://github.com/diegoalvarezb/ul_2/blob/master/resources/screens/readme_screen_1.png?raw=true)
![Result screen](https://github.com/diegoalvarezb/ul_2/blob/master/resources/screens/readme_screen_2.png?raw=true)
![Result screen](https://github.com/diegoalvarezb/ul_2/blob/master/resources/screens/readme_screen_3.png?raw=true)
![Result screen](https://github.com/diegoalvarezb/ul_2/blob/master/resources/screens/readme_screen_4.png?raw=true)
![Result screen](https://github.com/diegoalvarezb/ul_2/blob/master/resources/screens/readme_screen_5.png?raw=true)
![Result screen](https://github.com/diegoalvarezb/ul_2/blob/master/resources/screens/readme_screen_6.png?raw=true)







## Comments

The ticket limits are defined as constants inside the application (in the file `app/config/constants.php`). I thougth about setting them inside the database, but I choose the other way in order to avoid extra queries on the database. If these limits are susceptible of changing we can move them to the database, so they can be changed easily.
