@extends('layouts.back-end.app-seller')
@section('title', translate('order_List'))

@push('css_or_js')
    <link href="{{ dynamicAsset(path: 'public/assets/back-end/vendor/datatables/dataTables.bootstrap4.min.css') }}"
        rel="stylesheet">
@endpush


@section('content')
    <div class="content container-fluid">
        <div class="d-flex justify-content-between align-items-center gap-3 mb-3">
            <h2 class="h1 mb-1 text-capitalize d-flex align-items-center gap-2">
                <img width="20" src="{{ dynamicAsset(path: 'public/assets/back-end/img/banner.png') }}" alt="">
                {{ translate('banner_Setup') }}
                <small>
                    <strong class="text--primary text-capitalize">
                        ({{ str_replace('_', ' ', theme_root_path() == 'theme_fashion' ? 'theme_lifestyle' : theme_root_path()) }})
                    </strong>
                </small>
            </h2>
            <div class="btn-group">
                <div class="ripple-animation" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none"
                        class="svg replaced-svg">
                        <path
                            d="M9.00033 9.83268C9.23644 9.83268 9.43449 9.75268 9.59449 9.59268C9.75449 9.43268 9.83421 9.2349 9.83366 8.99935V5.64518C9.83366 5.40907 9.75366 5.21463 9.59366 5.06185C9.43366 4.90907 9.23588 4.83268 9.00033 4.83268C8.76421 4.83268 8.56616 4.91268 8.40616 5.07268C8.24616 5.23268 8.16644 5.43046 8.16699 5.66602V9.02018C8.16699 9.25629 8.24699 9.45074 8.40699 9.60352C8.56699 9.75629 8.76477 9.83268 9.00033 9.83268ZM9.00033 13.166C9.23644 13.166 9.43449 13.086 9.59449 12.926C9.75449 12.766 9.83421 12.5682 9.83366 12.3327C9.83366 12.0966 9.75366 11.8985 9.59366 11.7385C9.43366 11.5785 9.23588 11.4988 9.00033 11.4993C8.76421 11.4993 8.56616 11.5793 8.40616 11.7393C8.24616 11.8993 8.16644 12.0971 8.16699 12.3327C8.16699 12.5688 8.24699 12.7668 8.40699 12.9268C8.56699 13.0868 8.76477 13.1666 9.00033 13.166ZM9.00033 17.3327C7.84755 17.3327 6.76421 17.1138 5.75033 16.676C4.73644 16.2382 3.85449 15.6446 3.10449 14.8952C2.35449 14.1452 1.76088 13.2632 1.32366 12.2493C0.886437 11.2355 0.667548 10.1521 0.666992 8.99935C0.666992 7.84657 0.885881 6.76324 1.32366 5.74935C1.76144 4.73546 2.35505 3.85352 3.10449 3.10352C3.85449 2.35352 4.73644 1.7599 5.75033 1.32268C6.76421 0.88546 7.84755 0.666571 9.00033 0.666016C10.1531 0.666016 11.2364 0.884905 12.2503 1.32268C13.2642 1.76046 14.1462 2.35407 14.8962 3.10352C15.6462 3.85352 16.24 4.73546 16.6778 5.74935C17.1156 6.76324 17.3342 7.84657 17.3337 8.99935C17.3337 10.1521 17.1148 11.2355 16.677 12.2493C16.2392 13.2632 15.6456 14.1452 14.8962 14.8952C14.1462 15.6452 13.2642 16.2391 12.2503 16.6768C11.2364 17.1146 10.1531 17.3332 9.00033 17.3327ZM9.00033 15.666C10.8475 15.666 12.4206 15.0168 13.7195 13.7185C15.0184 12.4202 15.6675 10.8471 15.667 8.99935C15.667 7.15213 15.0178 5.57907 13.7195 4.28018C12.4212 2.98129 10.8481 2.33213 9.00033 2.33268C7.1531 2.33268 5.58005 2.98185 4.28116 4.28018C2.98227 5.57852 2.3331 7.15157 2.33366 8.99935C2.33366 10.8466 2.98283 12.4196 4.28116 13.7185C5.57949 15.0174 7.15255 15.6666 9.00033 15.666Z"
                            fill="currentColor"></path>
                    </svg>
                </div>
                <div
                    class="dropdown-menu dropdown-menu-right bg-aliceblue border border-color-primary-light p-4 dropdown-w-lg-30">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <img width="20" src="{{ dynamicAsset(path: 'public/assets/back-end/img/note.png') }}"
                            alt="">
                        <h5 class="text-primary mb-0">{{ translate('note') }}</h5>
                    </div>
                    <p class="title-color font-weight-medium mb-0">{{ translate('currently_you_are_managing_banners_for') }}
                        {{ ucwords(str_replace('_', ' ', theme_root_path())) }}.{{ translate('these_saved_data_is_only_applicable_only_for_') }}{{ ucwords(str_replace('_', ' ', theme_root_path())) }}.{{ translate('if_you_change_theme_from_theme_setup_these_banners_will_not_be_shown_in_changed_theme._You_have_upload_all_the_banners_over_again _according_to_the_new_theme_ratio_and_sizes._If_you_switch_back_to_') }}{{ ucwords(str_replace('_', ' ', theme_root_path())) }}{{ translate('_again_,_you_will_see_the_saved_data.') }}
                    </p>
                </div>
            </div>
        </div>

      



        <div class="row" id="banner-table">
            <div class="col-md-12">
                <div class="card">
                    <div class="table-responsive">
                        <table id="columnSearchDatatable"
                               class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100">
                            <thead class="thead-light thead-50 text-capitalize">
                            <tr>
                                <th class="pl-xl-5">{{ translate('SL') }}</th>
                                <th>{{ translate('image') }}</th>
                                <th>{{ translate('banner_type') }}</th>
                                <th>{{ translate('published') }}</th>
                                <th>{{ translate('From / To ') }}</th>
                                <th>{{ translate('Payment Status') }}</th>
                                <th class="text-center">{{ translate('action') }}</th>
                            </tr>
                            </thead>
                            @foreach ($banners as $key => $banner)
                                <tbody>
                                <tr id="data-{{ $banner->id}}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img class="ratio-4-2 rounded" width="80" alt=""
                                             src="{{ getStorageImages(path: $banner->photo_full_url , type: 'backend-banner') }}">
                                    </td>
                                    <td>{{ translate(str_replace('_',' ',$banner->banner_type)) }}</td>
                                    <td>
                                        @if($banner->published == 1)
                                            <span class="badge badge-success">Published</span>
                                        @else
                                            <span class="badge badge-danger">Unpublished</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($banner->start_date)->format('d M, Y ') }} /  
                                        {{ \Carbon\Carbon::parse($banner->end_date)->format('d M, Y ') }}
                                    </td>
                                    <td>
                                        <span class="badge badge-success">Approved</span>
                                    </td>
                                    <td>
                                        @if($banner->published == 1)
                                        <div class="d-flex gap-10 justify-content-center">
                                          
                                                <i class="tio-edit"></i>
                                            
                                        </div>
                                    @else
                                    <div class="d-flex gap-10 justify-content-center">
                                        <a class="btn btn-outline--primary btn-sm cursor-pointer edit"
                                           title="{{ translate('edit') }}"
                                           href="{{ route('vendor.banner.edit',[$banner['id']]) }}">
                                            <i class="tio-edit"></i>
                                        </a>
                                    </div>
                                    @endif
                                     
                                    </td>
                                </tr>
                                </tbody>
                            @endforeach
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div> 

        <span id="route-admin-banner-store" data-url="{{ route('admin.banner.store') }}"></span>
        <span id="route-admin-banner-delete" data-url="{{ route('admin.banner.delete') }}"></span>
    @endsection
    <!-- Include jQuery (if not already included) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



    @push('script')
        <script src="{{ dynamicAsset(path: 'public/assets/back-end/js/banner.js') }}"></script>
        <script>
            "use strict";

            $(document).on('ready', function() {
                getThemeWiseRatio();
            });

            let elementBannerTypeSelect = $('#banner_type_select');

            function getThemeWiseRatio() {
                let banner_type = elementBannerTypeSelect.val();
                let theme = '{{ theme_root_path() }}';
                let theme_ratio = {!! json_encode(THEME_RATIO) !!};
                let get_ratio = theme_ratio[theme][banner_type];
                $('#theme_ratio').text(get_ratio);
            }

            elementBannerTypeSelect.on('change', function() {
                getThemeWiseRatio();
            });
        </script>
    @endpush
