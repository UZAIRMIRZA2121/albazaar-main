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
        <div class="d-flex justify-content-between align-items-center gap-3 mb-3">
            <h2 class="h1 mb-1 text-capitalize d-flex align-items-center gap-2">
                <img width="20" src="{{ dynamicAsset(path: 'public/assets/back-end/img/banner.png') }}" alt="">
                {{ translate('Complete Your Payment') }}
                {{-- <small>
                    <strong class="text--primary text-capitalize">
                        ({{ str_replace('_', ' ', theme_root_path() == 'theme_fashion' ? 'theme_lifestyle' : theme_root_path()) }})
                    </strong>
                </small> --}}
            </h2>
        </div>
        <div class="row" id="banner-table">
            <div class="col-md-12">
                <div class="card">
                    <div class="table-responsive">
                          <iframe src="{{ $iframeUrl }}"  width="100%" height="600">
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
