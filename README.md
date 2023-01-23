<p align="center">
<h1>categorize phone numbers asper country </h1>
</p>

## About Task

Create a single page application that uses the database provided (SQLite 3) to list and
categorize country phone numbers.
Phone numbers should be categorized by country, state (valid or not valid), country code and
number.
The page should render a list of all phone numbers available in the DB. It should be possible to
filter by country and state. Pagination is an extra.

## Postman Documentation 

https://documenter.getpostman.com/view/20870167/2s8ZDYYhDM

## What We Need To Run The Project 
- Clone the project 
- Run (composer install) 
- Run  (cp .env.example .env)  to generate .env
- Open .env and add setting of data base that in project in database folder 
- Run php artisan key:generate
- Run php artisan migrate
- Run php artisan serve
- Get the Server running on (IP or Domain)/api and add it to .env in BASE_API_URL kye which is like .env.example
