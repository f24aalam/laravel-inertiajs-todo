# Laravel InertiaJs TODO Demo

## Installation Steps

**1. Clone the project in local**

```sh
git clone https://github.com/f24aalam/laravel-inertiajs-todo.git
```

and switch to cloned project

```sh
cd laravel-inertiajs-todo
```

**2. Copy `.env.example` to `.env`**

```sh
cp .env.example .env
```

and generate the key `php artisan key:generate`

**3. Create database and update the `.env` file accordingly**

**4. Install dependencies**

```sh
composer install
```

```sh
npm install && npm run dev
```

**5. Serve the project**

```sh
php artisan serve
```

## GraphQL

We are using the `GraphQL` for exposing the application data to third party, more [here](https://graphql.org/) about GraphQL and we are using **`Lighthouse PHP`** framework for serving GraphQL from laravel, you can learn more about lighthouse [here](https://lighthouse-php.com/).
