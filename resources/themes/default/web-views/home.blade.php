@extends('layouts.front-end.app')
@section('title', 'Welcome to Albazar')
@section('content')
    @php($decimalPointSettings = !empty(getWebConfig(name: 'decimal_point_settings')) ? getWebConfig(name: 'decimal_point_settings') : 0)


    {{-- hero section --}}
    @include('web-views.partials._home-top-slider', ['bannerTypeMainBanner' => $bannerTypeMainBanner])
    {{-- hero section --}}


    <div class="container-fluid mx-2 md:mx-4 bg-[#ffffff] border-b">
        <div class="max-w-[100%] md:max-w-[100%] lg:md:max-w-[80%] mx-auto justify-between items-center  text-sm py-2 ">
            <div class="w-full bg-white py-6">
                <div class="flex flex-wrap justify-between items-center  sm:px-6 lg:px-8">
                    <!-- Feature 1 -->
                    <div class="flex items-center md:justify-end gap-2 flex-1 min-w-[100px]">
                        <div class="bg-orange-100 text-orange-600 p-1 rounded-full flex justify-center items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 md:w-5 md:h-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 1l3 5h6l-5 4 2 6-6-3-6 3 2-6-5-4h6l3-5z" />
                            </svg>
                        </div>
                        <p class="text-[10px] md:text-[20px] font-medium text-gray-800">100% Authentic</p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="flex items-center gap-2 md:justify-center flex-1 min-w-[100px]">
                        <div class="bg-orange-100 text-orange-600 p-1 rounded-full flex justify-center items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 md:w-5 md:h-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 5l4 4H8l4-4zm-2 6h4v9h-4v-9z" />
                            </svg>
                        </div>
                        <p class="text-[10px] md:text-[20px] font-medium text-gray-800">Made with Love</p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="flex items-center gap-2 md:justify-start flex-1 min-w-[100px]">
                        <div class="bg-orange-100 text-orange-600 p-1 rounded-full flex justify-center items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 md:w-5 md:h-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 1a7 7 0 100 14 7 7 0 000-14zm0 0v14m0 0l-3 3m3-3l3 3" />
                            </svg>
                        </div>
                        <p class="text-[10px] md:text-[20px] font-medium text-gray-800">High Quality</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Categories -->
    @include('web-views.partials._category-section-home')

    @if (isset($bannerTypeMainSectionBanner) && $bannerTypeMainSectionBanner->count())
        <div class="container rtl pt-4 px-0">
            <div class="owl-carousel main-banner-slider">
                @foreach ($bannerTypeMainSectionBanner as $banner)
                    <div class="item">
                        <a href="{{ $banner->url }}" target="_blank" class="d-block">
                            <img class="d-block footer_banner_img __inline-63 w-100" alt="Banner Image"
                                src="{{ asset('public/storage/banner/' . $banner->photo) }}">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Big Sale -->
        <div
            class="container-fluid mx-4 bg-[#ffffff] md:mt-[50px] mt-[20px] md:pb-[30px]pb-[10px]  md:pt-[50px] pt-[20px]  md:block">
            <div
                class="max-w-[100%] md:max-w-[100%] lg:md:max-w-[78%]  mx-auto justify-between items-center  text-sm py-2 ">
                <div class="grid grid-cols-12 owl-carousel  carousel-five gap-2">
                    @foreach ($bannerTypeMainSectionBanner as $banner)
                        <div class="col-span-12 item">
                            <div
                                class="relative bg-[url('{{ asset('public/storage/banner/' . $banner->photo) }}')] bg-cover bg-center rounded-2xl overflow-hidden p-6 flex  justify-center min-h-[300px]">
                                <div class="relative z-10 text-center mt-3">
                                    <h1 class="text-4xl font-bold">
                                        <span class="text-black">Big Sale </span>
                                        <span class="text-white">Big Sale</span>
                                    </h1>
                                    <p class="mt-8 text-sm text-black max-w-md mx-auto">
                                        Loram ipsum dolor sit amet, con- sectetur adipisicing elit, seo do
                                        eiusmod tempor incididunt
                                    </p>
                                    <div
                                        class="mt-6 inline-block bg-[#FC4D03] text-white px-9 py-6 rounded-md text-3xl font-bold">
                                        <span class="text-[50px]"> 30</span><span class="text-[20px] align-super">%</span>
                                        <span class="text-[20px]">
                                            OFF</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>

            </div>
        </div>
    @endif

    @if ($featuredProductsList->count() > 0)
        <div class="container-fluid mx-4 md:mx-0 bg-[#EFF0F2] mt-[20px] md:mt-[50px] pb-[10px] md:pb-[30px] pt-[20px] md:pt-[50px]"
            id="featured_deal">
            <div class="max-w-full lg:max-w-[78%] mx-auto text-sm py-2">
                <div class="md:py-10 px-2">
                    <div class="max-w-7xl mx-auto">

                        <!-- Header -->
                        <div class="flex justify-between items-center mb-6 mx-3">
                            <h2 class="text-2xl font-bold">{{ translate('Featured Deal') }}</h2>
                            <a href="#"
                                class="hidden md:inline-block text-orange-600 font-medium text-sm hover:underline">View
                                all</a>
                        </div>

                        <!-- Product Grid -->
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                            @foreach ($featuredProductsList as $product)
                                <a href="{{ route('product', $product->slug) }}" class="block">
                                    <div class="rounded-xl overflow-hidden text-center p-1 bg-white group relative">
                                        <div class="text-center p-2 rounded-[10px] overflow-hidden">
                                            <img src="{{ getStorageImages(path: $product->thumbnail_full_url, type: 'product') }}"
                                                alt="{{ $product->name ?? 'Product' }}"
                                                class="w-full rounded-[10px] object-cover">
                                        </div>

                                        <div
                                            class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-200 z-10">
                                            <button
                                                class="bg-[#FC4D03] text-white text-[10px] font-semibold px-4 py-2 rounded-lg shadow-lg flex items-center gap-1">
                                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none">
                                                    <path
                                                        d="M11.25 18.75C11.25 19.58 10.58 20.25 9.75 20.25C8.92 20.25 8.25 19.58 8.25 18.75C8.25 17.92 8.92 17.25 9.75 17.25C10.58 17.25 11.25 17.92 11.25 18.75ZM16.25 17.25C15.42 17.25 14.75 17.92 14.75 18.75C14.75 19.58 15.42 20.25 16.25 20.25C17.08 20.25 17.75 19.58 17.75 18.75C17.75 17.92 17.08 17.25 16.25 17.25ZM20.73 7.68L18.73 15.68C18.65 16.01 18.35 16.25 18 16.25H8C7.64 16.25 7.33 15.99 7.26 15.63L5.37 5.25H4C3.59 5.25 3.25 4.91 3.25 4.5C3.25 4.09 3.59 3.75 4 3.75H6C6.36 3.75 6.67 4.01 6.74 4.37L7.17 6.75H20C20.23 6.75 20.45 6.86 20.59 7.04C20.73 7.22 20.78 7.46 20.73 7.68ZM19.04 8.25H7.44L8.62 14.75H17.41L19.04 8.25Z"
                                                        fill="#ffffff" />
                                                </svg>
                                                <span>QUICK ADD</span>
                                            </button>
                                        </div>

                                        <div class="px-4 py-3">
                                            <h3 class="text-md font-medium">{{ $product->name ?? 'Product Name' }}</h3>
                                            <p class="text-orange-500 font-semibold mt-2">
                                                @if ($product->discount > 0)
                                                    <del class="category-single-product-price">
                                                        {{ webCurrencyConverter(amount: $product->unit_price) }}
                                                    </del>
                                                @endif
                                                {{ webCurrencyConverter(amount: $product->unit_price - getProductDiscount(product: $product, price: $product->unit_price)) }}
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>

                        <!-- Mobile View All Link -->
                        <a href="#"
                            class="md:hidden text-orange-600 text-[16px] underline hover:text-orange-700 transition duration-200 text-center block my-5">
                            View all
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif


    <!-- Deal Of The Day -->
    @include('web-views.partials._deal-of-the-day', [
        'decimal_point_settings' => $decimalPointSettings,
    ])
    <!-- Deal Of The Day -->

    @if ($newArrivalProducts->count() > 0)
        <div class="container-fluid mx-4 md:mx-0 bg-[#FFF1EB] md:mt-[50px] mt-[20px] md:py-[100px] py-[50px]  md:block"
            id="new-arrival-section">
            <div class="max-w-[100%] md:max-w-[100%] lg:md:max-w-[78%] mx-auto text-sm py-2">
                <!-- Section Title -->
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold"> {{ translate('new_arrivals') }}</h2>
                </div>
                <!-- Owl Carousel -->
                <div class="owl-carousel owl-theme carousel-six">
                    @foreach ($newArrivalProducts as $key => $product)
                        @include('web-views.partials._product-card-2', [
                            'product' => $product,
                            'decimal_point_settings' => $decimalPointSettings,
                        ])
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    @if ($bestSellProduct->count() > 0)
        @include('web-views.partials._best-selling')
    @endif

    @if ($topRatedProducts->count() > 0)
        @include('web-views.partials._top-rated')
    @endif

    @if (count($bannerTypeFooterBanner) > 1)
        <div class="container-fluid mx-4 bg-[#ffffff] mt-[50px]">
            <div class="max-w-[100%] md:max-w-[100%] lg:md:max-w-[78%] mx-auto justify-between items-center text-sm py-2">
                <div class="mx-auto grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach ($bannerTypeFooterBanner as $banner)
                        <a href="{{ $banner['url'] }}" class="d-block" target="_blank">
                            <div
                                class="relative rounded-[20px] p-6 flex items-center justify-between overflow-hidden bg-white h-[300px]">
                                <div
                                    class="absolute inset-0 bg-[url('{{ getStorageImages(path: $banner->photo_full_url, type: 'banner') }}')] bg-no-repeat bg-cover bg-left z-0">
                                </div>

                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    @else
        <div class="container-fluid mx-4 bg-[#ffffff] mt-[50px]">
            <div class="max-w-[100%] md:max-w-[100%] lg:md:max-w-[78%] mx-auto justify-between items-center text-sm py-2">
                <div class="mx-auto grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div
                        class="relative rounded-[20px] p-6 flex items-center justify-between overflow-hidden bg-white h-[300px]">
                        <div
                            class="absolute inset-0 bg-[url('{{ asset('footer/06.07.2025_03.30.18_REC.png') }}')] bg-no-repeat bg-cover bg-left z-0">
                        </div>
                        <div class=" space-y-4 z-10 relative ml-[50px]">
                            <h2 class="text-[35px] font-bold text-black text-center">Big Sale</h2>
                            <h2 class="text-[35px] font-bold text-white text-center">Big Sale</h2>
                            <div class="text-black text-center">
                                <p>Lorem ipsum dolor sit amet,</p>
                                <p>consectetur adipisicing elit,</p>
                                <p>sed do eiusmod tempor incididunt</p>
                            </div>
                        </div>
                    </div>
                    <div class="relative rounded-[20px] overflow-hidden h-[300px] bg-white">
                        <div
                            class="absolute inset-0 bg-[url('{{ asset('footer/06.07.2025_03.30.28_REC.png') }}')] bg-no-repeat bg-cover bg-center z-0">
                        </div>
                        <div
                            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2  bg-[#FC4D03] text-white px-10 py-8 rounded-lg flex items-center space-x-1 z-10">
                            <span class="text-[50px] md:text-[70px] font-bold">30</span>
                            <div class="flex flex-col  font-semibold">
                                <span class="text-[20px] mb-3">%</span>
                                <span class="text-[20px]">OFF</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endif



    @if ($web_config['brand_setting'] && $brands->count() > 0)
        <div class="container-fluid mx-4 bg-[#ffffff] md:mt-[50px] mt-[20px]">
            <div class="max-w-full md:max-w-full lg:max-w-[78%] mx-auto text-sm py-2">
                <div class="md:py-10 px-4">
                    <div class="max-w-7xl mx-auto">
                        <!-- Header -->
                        <div class="flex justify-between items-center md:mb-6">
                            <h2 class="text-2xl mb-3 font-bold">{{ translate('brands') }}</h2>
                            <a href="{{ route('brands') }}"
                                class="text-orange-500 hover:underline">{{ translate('view_all') }}</a>
                        </div>

                        <!-- Scrollable Wrapper -->
                        <div class="w-full overflow-x-auto lg:overflow-x-visible">
                            <div class="flex gap-4">

                                @php($brandCount = 0)
                                @foreach ($brands as $brand)
                                    @if ($brandCount < 15)
                                        <div
                                            class="min-w-[220px] max-w-[220px] bg-white border rounded-xl shadow-sm text-center p-2 shrink-0">
                                            <a
                                                href="{{ route('products', ['brand_id' => $brand['id'], 'data_from' => 'brand', 'page' => 1]) }}">
                                                <div class="p-2 rounded-[10px] overflow-hidden">
                                                    <img src="{{ getStorageImages(path: $brand->image_full_url, type: 'brand') }}"
                                                        alt="{{ $brand->image_alt_text }}"
                                                        class="w-full object-cover rounded-[10px]">
                                                </div>
                                            </a>
                                            <div class="p-4">
                                                <h3 class="text-md font-medium">{{ $product['title'] }}</h3>
                                                <p class="text-orange-500 font-semibold mt-2">{{ $product['price'] }}</p>
                                            </div>
                                        </div>
                                    @endif
                                    @php($brandCount++)
                                @endforeach






                            </div>
                        </div>
                        <!-- End Scrollable Wrapper -->
                    </div>
                </div>
            </div>
        </div>
    @endif




@endsection
