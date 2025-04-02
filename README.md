# Crypto School Challenge 🚀🚀

A simple Laravel 12 + Vue 3 (Inertia + TypeScript + Tailwind) application for managing and displaying video lessons.

## Requirements

- PHP 8.3+
- Composer
- Node.js & npm
- MySQL
- Laravel valet (optional, for local `.test` domains)

## Installation

1. Clone the repository:  
   `git clone git@github.com:andreipredafl/crypto-school.git`  
   `cd crypto-school`

2. Install php dependencies:  
   `composer install`

3. Install javascript dependencies:  
   `npm install`

4. Copy the environment file and set up your environment:  
   `cp .env.example .env`

5. Generate the application key: ss
   `php artisan key:generate`

6. Set up your database:

    - Create a local database
    - Update `.env` with your database credentials

7. Run migrations:  
   `php artisan migrate`

8. Start the development servers:  
   `npm run dev`  
   `php artisan serve`

## Optional: run with laravel valet

`valet link`  
`valet secure`

Then access the project at: https://crypto-school.test
