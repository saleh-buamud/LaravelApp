<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Low Stock Alert</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f1f1f1;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Low Stock Alert</h1>
        </div>

        <p>The following products are running low on stock:</p>
        <ul>
            @foreach ($lowStockProducts as $product)
                <li>
                    <strong>{{ $product->name }}</strong> - Only {{ $product->quantity }} left in stock.
                </li>
            @endforeach
        </ul>

        <div class="footer">
            <p>متجر قطع غيار سيارات,<br> </p>
        </div>
    </div>
</body>

</html>
