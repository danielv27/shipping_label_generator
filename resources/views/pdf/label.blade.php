<!DOCTYPE html>
<html>

<head>
    <title>Shipping Label</title>
</head>

<body>
    <div class="label">
        <div class="section">
            <h1>{{ $carrier_service_name }}</h1>
            <p>{{ $recipient['name'] }}</p>
            <p>{{ $recipient['street'] }}</p>
            <p>{{ $recipient['postal_code'] }}, {{ $recipient['city'] }}</p>
            <p>{{ $recipient['country'] }}</p>
        </div>

        <div class="barcode">
            <img src="data:image/png;base64,{{ $barcode_image }}" alt="Barcode" />
            <p>{{ $barcode }}</p>
        </div>
    </div>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            /* Center horizontally */
            align-items: center;
            /* Center vertically, optional */
            height: 100vh;
            /* Full height for centering */
            background-color: #f9f9f9;
            /* Optional: light background color */
        }

        .label {
            border: 1px solid #000;
            padding: 20px;
            padding-bottom: 3px;
            width: 400px;
            height: auto;
            background-color: #fff;
            /* White background for label */
        }

        .section {
            margin-bottom: 15px;
        }

        .section h1 {
            font-size: 20px;
            margin-bottom: 15px;
        }

        .section p {
            margin: 0;
            font-size: 12px;
        }

        .barcode {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }

        .barcode img {
            display: block;
            width: 240px;
            height: auto;
        }
    </style>
</body>

</html>