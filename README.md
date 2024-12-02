# Shipping Label Generator Backend

This project serves as an API for a Shipping Label Generator application. The API can be used to calculate shipping prices, manage carrier services and countries, and generate shipping labels as PDFs.

The frontend application that interacts with this API can be found [here](https://github.com/danielv27/shipping_label_generator_frontend)

This project adheres to the PCR-12 compliance standard and incorpates both feature and unit tests.

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

NOTE: To install the application I used [Laravel Herd](https://herd.laravel.com). To make sure it is exposed to the browser I placed it under `~/Herd/<directory-name>` (predefined path made by Herd).

## Running
Start the server:
```bash
php artisan serve
```

The Server should be available at `http://127.0.0.1:8000`



## Testing
```bash
php artisan test
```

