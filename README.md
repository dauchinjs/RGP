# RGP

## Table of contents
* [General info](#general-info)
* [Demonstration](#demonstration)
* [Technologies](#technologies)
* [Setup](#setup)

## General info
This project allows to register a person or company in land registry. Each person can contain land ownership with at least one plot of land. A person or company has name and surname or title, personal code (for person code format is [6digits - 5digits], company - 11 digits), type (physical or legal). For land ownership each has a title, cadastre number and status, but for plot of land - cadastre number, total area in hectares, date of survey and land usage. <br>
This project allows you to insert the necessary information for a land owner and then see all the details added. See all the mentioned objects in an overview where you can filter it by persons without properties, properties without plots of land, plots of land without land uses.

## Demonstration

### Home page (person list)
![home page](https://github.com/dauchinjs/RGP/blob/main/rgp-demonst/home-page.png)

## Technologies

* PHP version: 8.0
* Laravel version: 9
* MySQL version: 8.0.31-0ubuntu0.20.04.2 for Linux on x86_64 ((Ubuntu))
* Composer version: 2.4.4

## Setup

1. Clone this repository `https://github.com/dauchinjs/RGP.git`
2. Install all dependencies: `composer install` and `npm install`
3. Create a database and rename the `.env.example` file to `.env` and add your credentials
4. Run laravel database migrations using `php artisan migrate`
5. To get 10 autofilled objects for each database you can use laravel database seeder `php artisan db:seed` <br>
5.1 Keep in mind that this won't put all the necessary information for each object
6. To run the project use `npm run dev` and open up a second terminal and use `php artisan serve` to run a development server
