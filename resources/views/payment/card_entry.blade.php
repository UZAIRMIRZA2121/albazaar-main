@extends('layouts.front-end.app')

@section('title', translate('choose_Payment_Method'))

@push('css_or_js')
<style>
    html, body {
        margin: 0;
        padding: 0;
        height: 100%;
    }

    .payment-options {
        display: flex;
        justify-content: center;
        margin: 20px 0;
        gap: 20px;
    }

    .payment-btn {
        border: 2px solid #ccc;
        padding: 10px 20px;
        border-radius: 8px;
        background-color: #f9f9f9;
        cursor: pointer;
        display: flex;
        align-items: center;
        transition: all 0.3s ease;
    }

    .payment-btn img {
        height: 30px;
        margin-right: 10px;
    }

    .payment-btn.active {
        border-color: #007bff;
        background-color: #e7f0ff;
    }

    iframe {
        width: 100%;
        height: 100vh;
        border: none;
        display: none;
        margin-top: 20px;
    }

    .nav {
        display: none !important;
    }
</style>
@endpush

@section('content')
    <div class="container">
        <h2 class="text-center">{{ translate('Choose Payment Method') }}</h2>

        <div class="payment-options">
            <div class="payment-btn " >
                <img src="{{ asset('images/visamaster.png') }}" alt="Visa/MasterCard">
          
            </div>

            <div class="payment-btn" >
                <img src="{{ asset('images/madacard.png') }}" alt="Mada">
              
            </div>
        </div>

        <iframe id="paymentIframe" src="{{ $redirectUrl }}" allowfullscreen></iframe>
    </div>
@endsection

@push('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const buttons = document.querySelectorAll('.payment-btn');
        const iframe = document.getElementById('paymentIframe');

        buttons.forEach(button => {
            button.addEventListener('click', function () {
                buttons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');

                iframe.style.display = 'block';
            });
        });
    });
</script>
@endpush
