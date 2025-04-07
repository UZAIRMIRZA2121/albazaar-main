<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <p>Hello {{ $orderDetail->product->seller->name }},</p>

    <p>You have a new order for your product: <strong>{{ $orderDetail->product->name }}</strong>.</p>

    <p>Order ID: {{ $orderDetail->order_id }}</p>
    <p>Quantity: {{ $orderDetail->quantity }}</p>
    <p>Price: {{ $orderDetail->price }}</p>

    <p>Thank you for selling with us!</p>
    <p>Best regards,</p>
    <p>The {{ config('app.name') }} Team</p>
    <p>Note: This is an automated message, please do not reply.</p>
</body>

</html>
