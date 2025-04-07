<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Notification</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .email-footer {
            margin-top: 20px;
            font-size: 12px;
            color: #888;
        }
    </style>
</head>

<body>
    <p>Hello {{ $orderDetail->product->seller->name }},</p>

    <p>You have a new order for your products:</p>

    <!-- Start Table -->
    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Order ID</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orderDetail->order->orderDetails as $detail)
                <tr>
                    <td>{{ $detail->product->name }}</td>
                    <td>{{ $detail->order_id }}</td>
                    <td>{{ $detail->quantity }}</td>
                    <td>{{ number_format($detail->price, 2) }} USD</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <!-- End Table -->

    <p>Total Products in this Order: {{ count($orderDetail->order->orderDetails) }}</p>

    <p>Thank you for selling with us!</p>
    <p>Best regards,</p>
    <p>The {{ config('app.name') }} Team</p>

    <div class="email-footer">
        <p>Note: This is an automated message, please do not reply.</p>
    </div>
</body>

</html>
