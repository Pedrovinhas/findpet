# Findpet

## Requirements
- PHP 8.2+
- Laravel 10.x
- PostgreSQL
- Web server (e.g., Apache or nginx)
- If you choose to use Docker, none of the above is required.

## Roadmap
- [] TODO

## Running with docker
```bash
# Clone the repository:
git clone https://github.com/Pedrovinhas/findpet.git

# Navigate to the project directory:
cd findpet

# Build containers images
docker-compose build

# Run container application
docker-compose up -d

# Install the dependencies:
composer install

# Copy the .env.example file to .env and configure the database information:
cp .env.example .env

# Generate the application key:
php artisan key:generate

# Generate the JWT key for the application:
php artisan jwt:secret

# Start the application
php artisan serve
```

This application uses PostgreSQL version 18 as its database. You can configure the database information in the ``.env`` file.