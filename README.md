# Logistics Platform Backend API

A modular monolith backend API for logistics management built with Laravel.

## Features

- User authentication with roles (admin/user)
- Shipment creation and tracking
- Geolocation integration
- System monitoring and logging
- Modular architecture following SOLID principles

## Prerequisites

- Docker and Docker Compose
- Composer (for local development without Docker)

## Installation

### With Docker (Recommended)

1. Clone the repository:
   ```bash
   git clone https://github.com/akindave/logistic-api.git
2. Start container:
   ```bash
   docker-compose up -d --build
3. Generate app key:
   ```bash
   docker-compose run app php artisan key:generate
4. Run migrations:
   ```bash
   docker-compose exec app php artisan migrate
## Visit this link in your Postman
    http://localhost:8000/api

### Without Docker

1. Clone the repository:
   ```bash
   git clone https://github.com/akindave/logistic-api.git
2. Start container:
   ```bash
   composer install
3. Copy the .env.example .env
    ```bash
    cp .env.example .env
4. Generate app key:
   ```bash
   php artisan key:generate
5. Run migrations:
   ```bash
   php artisan migrate
5. Serve your application:
   ```bash
   php artisan serve

## Visit this link in your Postman
    http://localhost:8000/api

## Postman Collection

You can find the Postman API collection for this project here:

👉 [Logistic API Postman Collection](https://github.com/akindave/logistic-api/blob/main/Haul247%20Logistic%20Api.postman_collection.json)