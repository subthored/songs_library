# Song Library API
This project is a Laravel-based RESTful API for managing a music catalog that includes **Artists**, **Albums**, and **Songs**. It provides endpoints to create, retrieve, update, and delete records for these entities. The API is documented with **Swagger UI**, making it easy to explore and test.

---
## Features
- Manage **Artists**, **Albums**, and **Songs**.
- Songs can belong to multiple albums with different track numbers.
- Fully documented with **Swagger UI** for easy testing.
- Supports relational data queries.

---
## Requirements
- PHP 8.1 or later
- Composer
- SQLite (pre-configured)

---
## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/subthored/songs_library.git
   cd songs_library
2. Install dependencies:
   ```bash
   composer install
3. Copy the environment configuration:
   ```bash
   cp .env.example .env
4. Generate the application key:
   ```bash
   php artisan key:generate
5. Run migrations to create and set up the database schema:
   ```bash
   php artisan migrate
6. Install Swagger for API documentation:
   ```bash
   php artisan l5-swagger:generate
---
## Local development
1. Start the Laravel development server:
   ```bash
   php artisan serve
2. View the Swagger documentation:
   ```bash
   http://127.0.0.1:8000/api/documentation
---
## Using Postman desktop app
1. Import the Swagger file from the URL:
    > http://127.0.0.1:8000/api/documentation
2. Use Postman to test each endpoint by sending requests.
