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

https://www.loom.com/share/d0ae1912dfc04e14aa87a93b98b0c3c8

## Postman Documentation 

https://documenter.getpostman.com/view/20870167/2s8ZDYYhDM

## What We Need To Run Task 
- Clone the project 
- Run (composer install) 
- Run npm install
- Run  (cp .env.example .env)  to generate .env
- Open .env and add setting of data base that in project in database folder 
- Run php artisan key:generate
- Run php artisan migrate
- Get the Server running on (IP or Domain)/api and add it to .env in VITE_BASE_URL kye which is like .env.example
- Run php artisan optimize:clear
- Run php artisan serve
- Run npm run watch
- Run php artisan test

## Describe task 
- model of customer which db layer that call customer table 
- helper which contain convertArrayToCollection function which is convert array to paginated collection 
- CountryController which contain index method which is return all countries with it's code 
- PhoneController which is contain filter with country and state  method 
- CountryService which contain all logic about countries in task
- phoneService which also contain logic about get phone numbers and make filtration on it 
- PhoneNumberService this service used when we need to make process on single phone number
- request validation for filter data 
- mapping data in response also added 
- functional test for country and phone filter
- add enum in common

## Technical Points
- This task could be make with more than way but i have made 2 ways but i have send the second way because the task asked about that on this line "The page should render a list of all phone numbers available in the DB. It should be possible to
    filter by country and state"  so it should render data direct from DB and to confirm about that i asked HR if i could to connect to any one to confirm about that but she couldn't reach to any one.

* First approach with normalization of DB which is better in performance with make 
    - Table for country with (id , code, name) columns of country .  .
    - Table of phone with (country_id , phone_number, state).
    - make script which is read all phone from customer table and categorize Data it in these tables after validate the phone number .
    - Then read data direct from DB .

* Second approach with get data from DB and make process on data on the fly and render the data on page like what is asked in the task and i try to handel performance in this way as i can like validate state i don't reader all phones and make validation for stat in the first if the filter with null i handel i on loaded data after pagination in resource and so on 

