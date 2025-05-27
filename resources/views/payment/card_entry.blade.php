@extends('layouts.front-end.app')

@section('title', translate('choose_Payment_Method'))

@push('css_or_js')
   <style>
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
        }

        iframe {
            width: 100%;
            height: 100vh;
            border: none;
        }
    </style>
@endpush

@section('content')

    <iframe src="{{ $redirectUrl }}" allowfullscreen></iframe>

@endsection

