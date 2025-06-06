{{-- resources/views/payment/card_entry.blade.php --}}
@extends('layouts.front-end.app')

@section('content')
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Secure Payment</title>
    <style>
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
        }
        iframe {
            width: 100%;
            height: 100%;
            border: none;
        }
    </style>
</head>
<body>
    <iframe id="paytabs-frame" src="{{ $redirect_url }}" allowpaymentrequest></iframe>

    <script>
        window.addEventListener("message", function(event) {
            // Ensure the message comes from PayTabs
            if (event.origin !== "https://secure-global.paytabs.com") return;

            // Optionally inspect the message
            console.log("PayTabs Message:", event.data);

            // Now make a backend call to verify the transaction status
            fetch("/verify-payment", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ transaction_reference: event.data.tran_ref })
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    window.location.href = "/payment-success";
                } else {
                    window.location.href = "/payment-failure";
                }
            });
        });
    </script>
</body>
</html>

@endsection
