# Shipping Label Generator Backend

This project serves as the backend for a Shipping Label Generator application. It provides APIs to calculate shipping prices, manage carrier services and countries, and generate shipping labels as PDFs. The system ensures accuracy and dynamic handling of shipping data while adhering to modern development standards.

## Installation

1. Clone the repository:
   ```bash
   git clone <repository-url>
   cd <repository-folder>
    ```
2. Install Dependencies:
    ```bash
    composer install
    ```
3. Run migrations and seed the database:
    ```bash
    php artisan migrate --seed
    ```

## Running
Start the server:
```bash
php artisan serve
```

The Server should be available at `http://127.0.0.1:8000`

NOTE: To install the application and gain access to it in the browser I used [Laravel Herd](https://herd.laravel.com). To make sure it is exposed to the browser I placed it under `~/Herd/<directory-name>`.

## Testing
```bash
php artisan serve
```

