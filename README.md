Simple Task Management

A lightweight task management system built with CodeIgniter 4. This project uses migrations for database setup, seeders for generating initial user login details, and a clean dashboard interface for managing tasks.

Features

    User Authentication: Login functionality to authenticate users.
    Task Management:
        View a list of tasks.
        Double-click on a task to view details and edit specific fields.

    Database Integration:
        Uses migrations to define the tasks table schema.
        Seeder to pre-populate user login data.

    Responsive UI: User-friendly interface for task management.


Installation
    > Prerequisites
        PHP >= 7.4
        Composer
        A database (MySQL, PostgreSQL, etc.)
        CodeIgniter 4 framework


Setup Instructions

Clone the repository:
    > git clone https://github.com/akanni6767/task-management.git
    > cd task-management


Set your database credentials in the .env file:

    database.default.hostname = localhost
    database.default.database = tasks
    database.default.username = your_username
    database.default.password = your_password
    database.default.DBDriver = MySQLi

    JWT_SECRET='your_secret'


Run migrations to create the tasks table:
    php spark migrate

Seed the database with user login data:
    php spark db:seed UserSeeder

Start the development server:
    php spark serve


