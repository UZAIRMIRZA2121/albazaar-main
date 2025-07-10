@extends('layouts.back-end.app-seller')
@section('title', translate('PayTabs Payment'))

@push('css_or_js')
    <link href="{{ dynamicAsset(path: 'public/assets/back-end/vendor/datatables/dataTables.bootstrap4.min.css') }}"
        rel="stylesheet">
    <style>
        iframe {
            width: 100%;
            height: 600px;
            border: none;
        }
    </style>
@endpush


@section('content')
<div class="content container-fluid">
    <div class="row" id="banner-table">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Complete Your Payment</h4>
                </div>
                <div class="card-body">
                    <div id="loading" style="text-align:center; padding: 10px;">
                        <strong>Loading payment gateway...</strong>
                    </div>
                    <iframe
                        src="{{ $iframeUrl }}"
                        frameborder="0"
                        width="100%"
                        height="600"
                        onload="document.getElementById('loading').style.display='none';"
                        allow="payment *"
                        allowfullscreen>
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
<!-- Include jQuery (if not already included) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



@push('script')
@endpush
