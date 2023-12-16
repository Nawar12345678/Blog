# Blog

The Blog project is a web application for publishing Posts and engaging with them.

## Features

- Create new posts
- Display and read posts
- User interaction with posts (like and dislike)
- Add comments to posts
-management the users in the project by Admin 


## How to Run the Project

1. Install dependencies:

    ```bash
    composer install
    ```

2. Copy the `.env.example` file to `.env` and configure the database and other settings.

3. Generate the application key:

    ```bash
    php artisan 1key:generate
    ```

4. Run the migration to create database tables:

    ```bash
    php artisan migrate
    ```

5. Start the development server:

    ```bash
    php artisan serve
    ```

## Contribution

We welcome contributions! Open a pull request to submit improvements or fixes to the project.

## Licenses

The project is distributed under the [license name]. Refer to `LICENSE` for details
