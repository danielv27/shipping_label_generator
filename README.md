# Shipping Label Generator Backend

This project serves as an API for a Shipping Label Generator application and was implemented in **Laravel**. The API can be used to calculate shipping prices, manage carrier services and countries, and generate shipping labels as PDFs.

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

## API Endpoints
### 1. **Fetch Countries**
- **Endpoint:** `GET /api/countries`
- **Description:** Retrieves a list of countries with their corresponding codes.
- **Response:**
  ```json
  [
    {
      "name": "Netherlands",
      "code": "NL"
    },
    {
      "name": "United States",
      "code": "US"
    }
    ...
  ]
  ```
### 2. Fetch Carrier Services
- **Endpoint:** `GET /api/carrier_services`
- **Description:** Retrieves carrier services available for the provided sender and recipient countries. If both countries are set to the netherlands(`NL`), both domestic and international services are included. Otherwise, only international services are returned.
- **Parameters:**
  - `sender_country_code` (Required): The sender's country code
  - `recipient_country_code` (Required): The recipient's country code
- **Response:**
  ```json
  [
      {
        "id": 1,
        "name": "PostNL Parcel"
      },
      {
        "id": 2,
        "name": "DHL Express"
      }
  ]
  ```
### 3. Fetch Pricing Information
- **Endpoint:** `POST /api/pricing/calculate`
- **Description:** Calculates the shipping price based on the provided weight and scope (domestic or international).
- **Body:**
  - `carrier_service_id` (required): The ID of the selected carrier service.
  - `weight` (required): The shipment weight in kilograms (conversion from grams is done in the frontend).
  - `sender_country_code` (required): The sender's country code.
  - `recipient_country_code` (required): The recipient's country code.
- **Response:**
  ```json
  {  
      "price": 5.99
  }
  ```
### 4. Generate Shipping Label
- **Endpoint:** `POST /api/label/generate`
- **Description:** Generates a PDF shipping label containing the recipient's details, selected service name, and a machine-scannable barcode.
- **Body:**
  - `recipient_name` (required): The recipient's name.
  - `recipient_street` (required): The recipient's street address.
  - `recipient_postal_code` (required): The recipient's postal code.
  - `recipient_city` (required): The recipient's city.
  - `recipient_country` (required): The recipient's country code.
  - `carrier_service_id` (required): The ID of the selected carrier service.

- **Response:** A downloadable PDF file containing the shipping label. Example:
  ![image](https://github.com/user-attachments/assets/9eb62f34-8ce1-491b-8fcd-51be2f5bdee6)


## Testing
```bash
php artisan test
```

