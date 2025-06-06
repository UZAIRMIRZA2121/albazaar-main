<!DOCTYPE html>
<html>
<head>
    <title>Secure Payment</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
        }
        iframe {
            width: 100%;
            height: 100vh;
            border: none;
        }
    </style>
</head>
<body>
    <iframe src="{{ $redirect_url }}" allow="payment *"></iframe>
</body>
</html>
