<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PayTabs Payment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        iframe {
            width: 100%;
            height: 100vh;
            border: none;
        }
    </style>
</head>
<body>

    <iframe id="paytabsIframe" src="" allowpaymentrequest></iframe>

    <script>
        async function loadIframe(paymentId) {
            try {
                const response = await fetch(`/api/paytabs/payment?payment_id=${paymentId}`);
                const data = await response.json();

                if (data.iframe_url) {
                    document.getElementById('paytabsIframe').src = data.iframe_url;
                } else {
                    document.body.innerHTML = '<h3>Failed to load PayTabs iframe</h3>';
                }
            } catch (err) {
                console.error(err);
                document.body.innerHTML = '<h3>Error loading payment</h3>';
            }
        }

        loadIframe("{{ $payment_id }}");
    </script>

</body>
</html>
