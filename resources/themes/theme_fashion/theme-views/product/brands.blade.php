@extends('theme-views.layouts.app')

@section('title', translate('all_brands_page').' | '.$web_config['company_name'].' '.translate('ecommerce'))

@section('content')

    <section class="breadcrumb-section pt-20px">
        <div class="container">
            <div class="section-title mb-4">
                <div
                    class="d-flex flex-wrap justify-content-between row-gap-3 column-gap-2 align-items-center search-page-title">
                    <ul class="breadcrumb">
                        <li>
                            <a href="{{ route('home') }}">{{ translate('home') }}</a>
                        </li>
                        <li>
                            <a href="javascript:" class="text-base">{{ translate('brand_List') }}</a>
                        </li>
                    </ul>
                    <div class="ms-auto ms-md-0">
                        <div class="position-relative select2-prev-icon filter_select_input_div select2-max-width-100">
                            <i class="bi bi-sort-up"></i>
                            <select class="select2-init form-control size-40px text-capitalize goToPageBasedSelectValue"
                                    name="order_by" id="filter_select_input">
                                <option value="{{route('brands', ['search'=>request('search')])}}" {{ request('order_by') == '' ? 'selected':''}}>
                                    {{translate('sort_by')}} : {{translate('Default')}}
                                </option>
                                <option
                                    value="{{route('brands',['order_by'=>'asc','search'=>request('search')])}}" {{ request('order_by')=='asc'?'selected':''}}>
                                    {{translate('sort_by')}} : {{translate('a_to_z_order')}}
                                </option>
                                <option
                                    value="{{route('brands',['order_by'=>'desc','search'=>request('search')])}}" {{ request('order_by')=='desc'?'selected':''}}>
                                    {{translate('sort_by')}} : {{translate('z_to_a_order')}}
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="search-form-section py-24px">
        <div class="container">
            <form action="{{route('brands')}}" method="GET">
                <div class="search-form-2 search-form-mobile">
                <span class="icon d-flex">
                    <i class="bi bi-search"></i>
                </span>
                    <input type="text" name="search" value="{{request('search')}}" class="form-control text-title"
                           placeholder="{{ translate('search_brand') }}" autocomplete="off" required>

                        @if (request('search') != null)
                            <a data-link="{{route('brands')}}" class="clear get-view-by-onclick cursor-pointer">{{translate('clear')}}</a>
                        @else
                        <button type="submit" class="clear border-0 text-title">
                            <span>{{translate('search')}}</span>
                        </button>
                        @endif

                </div>
            </form>
        </div>
    </section>

    <section class="others-section section-gap py-5">
        <div class="container">
            <div class="row g-4">

                @foreach($brands as $brand)
                    <div class="col-6 col-sm-4 col-md-3 col-xl-brands">
                        <a href="{{ route('products', ['brand_id' => $brand['id'], 'data_from' => 'brand', 'brand_name' => str_replace(' ', '_', $brand->name), 'page' => 1]) }}"
                           class="brands-item flex-column gap-3 overflow-hidden" title="{{ $brand->name }}">
                            <img loading="lazy" src="{{ getStorageImages(path: $brand->image_full_url, type: 'brand') }}" class="img-fluid badge-soft-base aspect-1 object-fit-cover" alt="{{ $brand->image_alt_text ?? $brand->name }}">
                            <h5 class="m-0 px-3 text-center line-limit-1 fs-16">{{ $brand->name }}</h5>
                        </a>
                    </div>
                @endforeach

                @if($brands->count()==0)
                    <div class="col-12 py-5">
                        <div class="text-center w-100">
                            <div class="text-center mb-5">
                                <img loading="lazy" src="{{ theme_asset('assets/img/icons/brand.svg') }}" alt="{{ translate('brand') }}">
                                <h5 class="my-3 pt-2 text-muted">{{translate('brand_Not_Found')}}!</h5>
                                <p class="text-center text-muted">{{ translate('sorry_no_data_found_related_to_your_search') }}</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="d-flex justify-content-end w-100 overflow-auto mt-3" id="paginator-ajax">
                {{ $brands->links() }}
            </div>
        </div>
    </section>

    @include('theme-views.partials._how-to-section')

@endsection
