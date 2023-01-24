<p align="center">
<h1>categorize phone numbers asper country Code </h1>
</p>

## About Task

Create a single page application that uses the database provided (SQLite 3) to list and
categorize country phone numbers.
Phone numbers should be categorized by country, state (valid or not valid), country code and
number.
The page should render a list of all phone numbers available in the DB. It should be possible to
filter by country and state. Pagination is an extra.

## quick test task video

https://www.loom.com/share/4ff39feaeac44db9922f83db4fb0bd2a

## Postman Documentation 

https://documenter.getpostman.com/view/20870167/2s8ZDYYhDM

## What We Need To Run Task 
- Clone the project 
- Run (composer install) 
- Run  (cp .env.example .env)  to generate .env
- Open .env and add setting of data base that in project in database folder 
- Run php artisan key:generate
- Run php artisan migrate
- Run php artisan serve
- Get the Server running on (IP or Domain)/api and add it to .env in BASE_API_URL kye which is like .env.example
- Run npm install
- Run npm run watch
- Run php artisan test

## Describe task 
- model of customer which db layer that call customers table 
- helper which contain convertArrayToCollection function which is convert array to paginated collection 
- CountryController which contain index method which is return all countries with it's code 
- PhoneController which is contain filter with country and stat  method 
- CountryService which contain all logic about countries in task
- phoneService which also contain logic about get get phone numbers and make filtration on it 
- PhoneNumberService this service used when we need to make process on single phone number
- request validation for filter data 
- mapping data in response also added 
- functional test for country and phone filter
- add enum in common
