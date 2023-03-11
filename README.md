# Invoice App

This is a simple invoice app that allows you to create invoices.

## Installation

1. Clone the repository
2. Run `composer install`
3. Run `npm install`
4. Create a copy of your .env.example file and name it .env
5. Change your VITE_APP_URL to `http://127.0.0.1:8000` in your .env file
5. Run `npm run dev`
6. Run `php artisan serve`
7. Visit `http://127.0.0.1:8000]` in your browser

## Usage

1. Run `php artisan serve`
2. Visit `localhost:8000` in your browser
3. Create an account
4. Create an invoice

## Todo

- [x] Choose GraphQL or REST API for the frontend
  - [ ] Create tests for API
  - [ ] Create a documentation for API
- [x] Create a frontend
  - [x] Choose a framework
- [ ] Add ESLint to the frontend
- [ ] Add Pint to the backend

## Testing

If you want to run the tests, you will need to create a copy of your .env.example file and name it .env.testing. Then, run the following command:

```
php artisan test
```

Note: Because of Laravel 10, i don't want to use PestPHP for now. Tests will be changed to PestPHP in the future.
[Click for details](https://pestphp.com/docs/installation#requirements)
