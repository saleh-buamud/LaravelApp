<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Order Confirmation</title>
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

        .header h2 {
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
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
            <h2>Order Confirmation</h2>
        </div>

        <p>Dear {{ Auth::user()->name }},</p>
        <p>Thank you for your order! Here are your order details:</p>

        <h3>Order Information:</h3>
        <p><strong>Order ID:</strong> {{ $order->id }}</p>
        <p><strong>Order Date:</strong> {{ $order->order_date->format('d M Y H:i') }}</p>
        <p><strong>Total Amount:</strong> ${{ number_format($order->total_amount, 2) }}</p>

        <h3>Order Details:</h3>
        <table>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orderDetails as $detail)
                    <tr>
                        <td>{{ $detail->product->name }}</td>
                        <td>{{ $detail->quantity }}</td>
                        <td>${{ number_format($detail->price, 2) }}</td>
                        <td>${{ number_format($detail->quantity * $detail->price, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="footer">
            <p>If you have any questions, feel free to contact us.</p>
            <p>Best regards,<br>Your Company Name</p>
        </div>
    </div>
</body>

</html>
