{{-- resources/views/payment/card_entry.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h3 class="mb-4">Secure Payment</h3>

        @if (!empty($redirect_url))
            <div id="loader" style="text-align:center;">
                <p>Loading Payment Page...</p>
            </div>

            <iframe src="{{ $redirect_url }}" width="100%" height="700px" frameborder="0" allow="payment *" allowfullscreen
                style="border: 1px solid #ccc; border-radius: 10px;"
                onload="document.getElementById('loader').style.display='none';">
            </iframe>
        @else
            <div class="alert alert-danger">
                Unable to load the payment page. Please try again later.
            </div>
        @endif
    </div>
@endsection
