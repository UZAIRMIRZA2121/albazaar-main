@extends('layouts.front-end.app')

@section('title', translate($data['data_from']) . ' ' . translate('products'))
@php
    $searchCategory = request()->get('category'); // if you're handling selected category
    $searchProduct = request()->get('search'); // if you're handling selected product
@endphp
@push('css_or_js')
    <meta property="og:image" content="{{ $web_config['web_logo']['path'] }}" />
    <meta property="og:title" content="Products of {{ $web_config['company_name'] }} " />
    <meta property="og:url" content="{{ env('APP_URL') }}">
    <meta property="og:description"
        content="{{ substr(strip_tags(str_replace('&nbsp;', ' ', $web_config['about']->value)), 0, 160) }}">

    <meta property="twitter:card" content="{{ $web_config['web_logo']['path'] }}" />
    <meta property="twitter:title" content="Products of {{ $web_config['company_name'] }}" />
    <meta property="twitter:url" content="{{ env('APP_URL') }}">
    <meta property="twitter:description"
        content="{{ substr(strip_tags(str_replace('&nbsp;', ' ', $web_config['about']->value)), 0, 160) }}">
@endpush

@section('content')

    @php($decimal_point_settings = getWebConfig(name: 'decimal_point_settings'))


    <div class="container-fluid mx-4 md:mx-0  ">
        <div class="max-w-[100%] md:max-w-[100%] lg:md:max-w-[78%] mx-auto justify-between items-center  text-sm py-2 ">
            <!-- Breadcrumb -->
            <div class="px-1 py-4  text-[#FC4D03] font-semibold text-[16px] hidden md:block">
                <h5 class="font-semibold mb-1 text-capitalize">
                    <span class="current-product-type" data-all="{{ translate('all') }}"
                        data-digital="{{ translate('digital') }}" data-physical="{{ translate('physical') }}">
                        {{ translate(str_replace('_', ' ', $data['data_from'])) }}
                        {{ request('product_type') == 'digital' ? translate(request('product_type')) : '' }}
                    </span>
                    &gt; {{ translate('products') }} &gt;
                    {{ isset($data['brand_name']) ? '' . $data['brand_name'] . '' : '' }}
                    <span class="view-page-item-count">{{ $products->total() }}</span> {{ translate('items_found') }}
                </h5>

            </div>

            <!-- Main Layout -->
            <div class="grid grid-cols-12 gap-3">
                <!-- Sidebar Filters -->
                <div class="col-span-3 hidden md:block">
                    <aside class="w-full max-w-2xs bg-[#EFF0F2] p-3 rounded-lg space-y-6 text-sm font-medium  shadow-sm">
                        <div>
                            <h2 class="font-semibold mb-2 text-[14px]">{{ translate('filter') }}</h2>

                            <select
                                class="w-full p-3 rounded-lg border border-gray-300 bg-white text-gray-700 text-[12px] custom-select filter-on-product-filter-change">
                                <option>{{ translate('Choose') }}</option>
                                <option value="best-selling"
                                    {{ isset($data['data_from']) != null ? ($data['data_from'] == 'best-selling' ? 'selected' : '') : '' }}>
                                    {{ translate('Best_Selling_Product') }}</option>
                                <option value="top-rated"
                                    {{ isset($data['data_from']) != null ? ($data['data_from'] == 'top-rated' ? 'selected' : '') : '' }}>
                                    {{ translate('Top_Rated') }}</option>
                                <option value="most-favorite"
                                    {{ isset($data['data_from']) != null ? ($data['data_from'] == 'most-favorite' ? 'selected' : '') : '' }}>
                                    {{ translate('Most_Favorite') }}</option>
                                <option value="featured_deal"
                                    {{ isset($data['data_from']) != null ? ($data['data_from'] == 'featured_deal' ? 'selected' : '') : '' }}>
                                    {{ translate('Featured_Deal') }}</option>

                            </select>
                        </div>
                        {{-- <div>
                            <h2 class="font-semibold mb-2 text-[14px]">Product type</h2>
                            <select class="w-full p-3 rounded-lg border border-gray-300 bg-white text-gray-700 text-[12px]">
                                <option>Physical</option>
                                <option>Physical</option>
                                <option>Physical</option>
                            </select>
                        </div> --}}
                        <div>
                            <h2 class="font-semibold mb-2 text-[14px]">{{ translate('price') }}</h2>

                            <!-- Display Range Values -->
                            <div
                                class="flex justify-between items-start border border-gray-300 bg-white text-gray-700 text-xs px-3 py-3 rounded">
                                <div class="text-left leading-tight">
                                    <span class="text-[13px] font-medium block"
                                        id="price-min-display">{{ $data['min_price'] }}</span>
                                    <span class="text-[10px] text-gray-500">{{ translate('min') }}</span>
                                </div>
                                <div class="text-right leading-tight">
                                    <span class="text-[13px] font-medium block"
                                        id="price-max-display">{{ $data['max_price'] }}</span>
                                    <span class="text-[10px] text-gray-500">Max</span>
                                </div>
                            </div>

                            <!-- Range Slider -->
                            <div class="flex items-center gap-2 mt-2 rounded-lg">
                                <span class="text-gray-500 text-sm">-</span>
                                <input type="range" id="price-slider" min="5" max="1000"
                                    value="{{ $data['min_price'] }}"
                                    class="flex-1 accent-black h-1 [&::-webkit-slider-thumb]:h-2 [&::-webkit-slider-thumb]:w-2 [&::-webkit-slider-thumb]:rounded-full [&::-webkit-slider-thumb]:bg-black action-search-products-by-price">
                                <span class="text-gray-500 text-sm">+</span>
                            </div>

                            <!-- Number Inputs -->
                            <div class="flex gap-2 mt-2 d--none">
                                <div class="__w-35p">
                                    <input type="number" value="5" min="5" max="1000" id="min_price"
                                        class="bg-white cz-filter-search form-control form-control-sm appended-form-control"
                                        placeholder="{{ translate('min') }}">
                                </div>
                                <div class="__w-10p flex items-center justify-center">
                                    <p class="m-0">{{ translate('to') }}</p>
                                </div>
                                <div class="__w-35p">
                                    <input type="number" value="{{ $data['max_price'] }}" min="5" max="36"
                                        id="max_price"
                                        class="bg-white cz-filter-search form-control form-control-sm appended-form-control"
                                        placeholder="{{ translate('max') }}">
                                </div>
                            </div>
                        </div>
                        <script>
                            document.addEventListener('DOMContentLoaded', () => {
                                document.querySelectorAll('.get-view-by-onclick').forEach(el => {
                                    el.addEventListener('click', () => {
                                        const url = el.getAttribute('data-link');
                                        if (url) {
                                            window.location.href = url;
                                        }
                                    });
                                });
                            });
                        </script>

                        <!-- Other categories -->
                        <div x-data="{ openCategory: null }">
                            <h2 class="font-semibold mb-2 text-[14px]">{{ translate('categories') }}</h2>
                            <ul class="bg-white rounded-lg divide-y divide-gray-200 shadow-sm text-[12px]">

                                @foreach ($categories as $category)
                                    <li @click="openCategory === {{ $category->id }} ? openCategory = null : openCategory = {{ $category->id }}"
                                        class="cursor-pointer">
                                        <div class="flex justify-between items-center px-2 py-2 hover:bg-gray-50">
                                            {{ $category->name }}
                                            @if ($category->childes->count() > 0)
                                                <span>
                                                    <img src="{{ asset('footer/next.png') }}" class="w-3" />
                                                </span>
                                            @endif
                                        </div>

                                        <!-- First Level Children -->
                                        @if ($category->childes->count() > 0)
                                            <ul x-show="openCategory === {{ $category->id }}" x-collapse
                                                class="bg-gray-50 text-sm text-gray-600 pl-6 pr-4 py-2 space-y-2">
                                                @foreach ($category->childes as $child)
                                                    <li
                                                        @click.stop="openCategory === 'child-{{ $child->id }}' ? openCategory = null : openCategory = 'child-{{ $child->id }}'">
                                                        <div
                                                            class="flex justify-between items-center hover:bg-gray-100 px-1 py-1">
                                                            <label class="cursor-pointer get-view-by-onclick"
                                                                data-link="{{ route('products', ['sub_category_id' => $child->id, 'data_from' => 'category', 'page' => 1]) }}">
                                                                - {{ $child->name }}
                                                            </label>

                                                        </div>

                                                        <!-- Second Level Children -->
                                                        @if ($child->childes->count() > 0)
                                                            <ul x-show="openCategory === 'child-{{ $child->id }}'"
                                                                x-collapse
                                                                class="bg-white text-sm text-gray-600 pl-6 py-1 space-y-1">
                                                                @foreach ($child->childes as $ch)
                                                                    <li>
                                                                        <a href="{{ route('products', ['sub_sub_category_id' => $ch->id, 'data_from' => 'category', 'page' => 1]) }}"
                                                                            class="flex items-center hover:bg-gray-100 px-1 py-1">
                                                                            -- {{ $ch->name }}
                                                                        </a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                        @if ($web_config['brand_setting'])
                            <div x-data="{ brandSearch: '' }">
                                <h2 class="font-semibold mb-2 text-[14px]">{{ translate('brands') }}</h2>

                                <!-- Search Input -->
                                <div class="relative mb-2">
                                    <input type="text" placeholder="{{ translate('search_by_brands') }}"
                                        class="w-full p-2 rounded-lg border border-gray-300 pr-10 text-[12px] search-product-attribute"
                                        x-model="brandSearch">
                                    <div class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-xl">
                                        <img src="{{ asset('footer/icons8-search-30.png') }}" class="w-5" />
                                    </div>
                                </div>

                                <!-- Brands List -->
                                <ul class="max-h-60 overflow-y-auto pr-1" data-simplebar data-simplebar-auto-hide="false">
                                    @foreach ($activeBrands as $brand)
                                        <template
                                            x-if="'{{ strtolower($brand['name']) }}'.includes(brandSearch.toLowerCase())">
                                            <li class="flex justify-between items-center py-1 px-2 hover:bg-gray-50 rounded cursor-pointer get-view-by-onclick"
                                                data-link="{{ route('products', ['brand_id' => $brand['id'], 'data_from' => 'brand', 'page' => 1]) }}">
                                                <span class="text-sm text-gray-700">{{ $brand['name'] }}</span>
                                                <span class="text-xs text-gray-500 bg-gray-200 rounded-full px-2 py-0.5">
                                                    {{ $brand['brand_products_count'] }}
                                                </span>
                                            </li>
                                        </template>
                                    @endforeach
                                </ul>
                            </div>
                        @endif


                    </aside>
                </div>
                <div class="col-span-12 md:col-span-9">
                    <main class="w-full">
                        <div class="flex items-center justify-between mb-2  md:px-0 mt-3 md:mt-0">
                            <h1 class="text-3xl font-bold">
                                {{ isset($data['brand_name']) ? '' . $data['brand_name'] . '' : '' }}</h1>
                            <img src="{{ asset('footer/filter.png') }}" class="w-5 h-5 cursor-pointer md:hidden"
                                alt="Filter" @click="showFilter = true" data-drawer-target="drawer-right-example"
                                data-drawer-show="drawer-right-example" data-drawer-placement="right"
                                aria-controls="drawer-right-example">
                        </div>

                        <p class="text-[#505050]  mb-6 text-[16px] ">
                           
                        </p>

                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-5">
                            <div class="col-span-12 md:flex md:justify-end">
                                <div class="md:flex gap-4 space-y-2">
                                    <form id="search-form" method="GET" class="col-span-12 md:w-48 relative"
                                        action="{{ route('products') }}" x-data="{
                                            open: false,
                                            selected: '{{ request('sort_by') === 'low-high'
                                                ? 'Low to High'
                                                : (request('sort_by') === 'high-low'
                                                    ? 'High to Low'
                                                    : (request('sort_by') === 'a-z'
                                                        ? 'A to Z'
                                                        : (request('sort_by') === 'z-a'
                                                            ? 'Z to A'
                                                            : 'Latest'))) }}',
                                            selectedValue: '{{ request('sort_by') ?? 'latest' }}'
                                        }">

                                        <input type="hidden" name="sort_by" x-model="selectedValue">

                                        <div class="relative">

                                            <!-- Trigger Button -->
                                            <button type="button" @click="open = !open"
                                                class="flex items-center justify-between w-full bg-[#F6F7FA] px-4 py-2 rounded-lg text-sm text-gray-700">
                                                <div class="flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="w-4 h-4 mr-2 text-gray-500" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M3 4a1 1 0 011-1h5m10 0h-5m0 0h5a1 1 0 011 1v16a1 1 0 01-1 1h-5m0 0h-5m5 0H4a1 1 0 01-1-1V4z" />
                                                    </svg>
                                                    <span class="mr-1">Sort by</span>
                                                    <span class="font-semibold" x-text="selected"></span>
                                                </div>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-2 text-gray-500"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 9l-7 7-7-7" />
                                                </svg>
                                            </button>

                                            <!-- Options -->
                                            <ul x-show="open" @click.outside="open = false"
                                                class="absolute w-full mt-2 bg-white rounded-lg shadow text-sm text-gray-700 z-10">
                                                <li @click="selected = 'Latest'; selectedValue = 'latest'; open = false; $nextTick(() => $el.closest('form').submit())"
                                                    class="px-4 py-2 hover:bg-gray-100 cursor-pointer">Latest</li>
                                                <li @click="selected = 'Low to High'; selectedValue = 'low-high'; open = false; $nextTick(() => $el.closest('form').submit())"
                                                    class="px-4 py-2 hover:bg-gray-100 cursor-pointer">Low to High Price
                                                </li>
                                                <li @click="selected = 'High to Low'; selectedValue = 'high-low'; open = false; $nextTick(() => $el.closest('form').submit())"
                                                    class="px-4 py-2 hover:bg-gray-100 cursor-pointer">High to Low Price
                                                </li>
                                                <li @click="selected = 'A to Z'; selectedValue = 'a-z'; open = false; $nextTick(() => $el.closest('form').submit())"
                                                    class="px-4 py-2 hover:bg-gray-100 cursor-pointer">A to Z Order</li>
                                                <li @click="selected = 'Z to A'; selectedValue = 'z-a'; open = false; $nextTick(() => $el.closest('form').submit())"
                                                    class="px-4 py-2 hover:bg-gray-100 cursor-pointer">Z to A Order</li>
                                            </ul>
                                        </div>
                                    </form>

                                    <div x-data="{ open: false, selected: 'Latest' }" class="relative col-span-12 md:w-55">
                                        <button @click="open = !open"
                                            class="flex items-center justify-between w-full bg-[#F6F7FA] px-4 py-2 rounded-lg text-sm text-gray-700">
                                            <div class="flex items-center">
                                                <!-- Icon -->
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 text-gray-500"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M3 4a1 1 0 011-1h5m10 0h-5m0 0h5a1 1 0 011 1v16a1 1 0 01-1 1h-5m0 0h-5m5 0H4a1 1 0 01-1-1V4z" />
                                                </svg>
                                                <span class="mr-1">Show Products</span>
                                                <span class="font-semibold" x-text="selected"></span>
                                            </div>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-2 text-gray-500"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </button>
                                        <!-- Options -->
                                        <ul x-show="open" @click.outside="open = false"
                                            class="absolute w-full mt-2 bg-white rounded-lg shadow text-sm text-gray-700 z-10">
                                            <li @click="selected = 'Latest'; open = false"
                                                class="px-4 py-2 hover:bg-gray-100 cursor-pointer">Latest</li>
                                            <li @click="selected = 'Oldest'; open = false"
                                                class="px-4 py-2 hover:bg-gray-100 cursor-pointer">Oldest</li>
                                            <li @click="selected = 'Popular'; open = false"
                                                class="px-4 py-2 hover:bg-gray-100 cursor-pointer">Popular</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Product Grid -->
                        <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-6">
                            @include('web-views.products._ajax-products-featured', [
                                'products' => $products,
                                'decimal_point_settings' => $decimal_point_settings,
                            ])
                            @include('web-views.products._ajax-products', [
                                'products' => $products,
                                'decimal_point_settings' => $decimal_point_settings,
                            ])




                        </div>
                    </main>
                </div>
            </div>
        </div>
    </div>




    <!-- Drawer Component -->
    <div id="drawer-right-example"
        class="fixed top-0 right-0 z-40 h-screen p-4 overflow-y-auto transition-transform translate-x-full bg-white w-80 dark:bg-gray-800"
        tabindex="-1" aria-labelledby="drawer-right-label" x-data="{ openCategory: null }">

        <!-- Close Button -->
        <button type="button" data-drawer-hide="drawer-right-example" aria-controls="drawer-right-example"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close menu</span>
        </button>

        <!-- 🧾 Filter Content -->
        <aside class="mt-6 w-full space-y-6 text-sm font-medium">
            <!-- Filter Dropdown -->
            <div>
                <h2 class="font-semibold mb-2 text-[14px]">Filter</h2>
                <select class="w-full p-3 rounded-lg border border-gray-300 bg-white text-gray-700 text-[12px]">
                    <option>Choose</option>
                    <option>Choose</option>
                    <option>Choose</option>
                    <option>Choose</option>
                </select>
            </div>

            <!-- Product Type -->
            <div>
                <h2 class="font-semibold mb-2 text-[14px]">Product type</h2>
                <select class="w-full p-3 rounded-lg border border-gray-300 bg-white text-gray-700 text-[12px]">
                    <option>Physical</option>
                    <option>Physical</option>
                    <option>Physical</option>
                </select>
            </div>

            <!-- Price Range -->
            <div>
                <h2 class="font-semibold mb-2 text-[14px]">Price</h2>
                <div
                    class="flex justify-between items-start border border-gray-300 bg-white text-gray-700 text-xs px-3 py-3 rounded">
                    <div class="text-left leading-tight">
                        <span class="text-[13px] font-medium block">$13.00</span>
                        <span class="text-[10px] text-gray-500">Min</span>
                    </div>
                    <div class="text-right leading-tight">
                        <span class="text-[13px] font-medium block">$36.00</span>
                        <span class="text-[10px] text-gray-500">Max</span>
                    </div>
                </div>

                <div class="flex items-center gap-2 mt-2 rounded-lg">
                    <span class="text-gray-500 text-sm">-</span>
                    <input type="range" min="13" max="36"
                        class="flex-1 accent-black h-1 [&::-webkit-slider-thumb]:h-2 [&::-webkit-slider-thumb]:w-2 [&::-webkit-slider-thumb]:rounded-full [&::-webkit-slider-thumb]:bg-black">
                    <span class="text-gray-500 text-sm">+</span>
                </div>
            </div>

            <!-- 🧩 Other Categories (Accordion) -->
            <div>
                <h2 class="font-semibold mb-2 text-[14px]">Other categories</h2>
                <ul class="bg-white rounded-lg divide-y divide-gray-200 shadow-sm text-[12px]">
                    <!-- Category Item -->
                    <template
                        x-for="(item, index) in [
            { name: 'Raw materials', children: ['Cotton', 'Wool', 'Silk'] },
            { name: 'Bags', children: ['Handbags', 'Backpacks', 'Travel bags'] },
            { name: 'Perfume', children: ['Men', 'Women', 'Unisex'] },
            { name: 'Distribution', children: ['Wholesale', 'Retail'] },
            { name: 'Luxury', children: ['Watches', 'Jewelry', 'Designer'] },
            { name: 'Accessories', children: ['Sunglasses', 'Belts', 'Wallets'] }
          ]"
                        :key="index">
                        <li>
                            <div @click="openCategory === index ? openCategory = null : openCategory = index"
                                class="flex justify-between items-center px-2 py-2 hover:bg-gray-50 cursor-pointer">
                                <span x-text="item.name"></span>
                                <img src="{{ asset('footer/next.png') }}" class="w-4">
                            </div>
                            <ul x-show="openCategory === index" x-collapse
                                class="bg-gray-50 text-sm text-gray-600 pl-6 pr-4 py-2 space-y-2">
                                <template x-for="child in item.children" :key="child">
                                    <li x-text="'- ' + child"></li>
                                </template>
                            </ul>
                        </li>
                    </template>
                </ul>
            </div>

            <!-- Brands -->
            <div>
                <h2 class="font-semibold mb-2 text-[14px]">Brands</h2>
                <div class="relative">
                    <input type="text" placeholder="Search by brands"
                        class="w-full p-2 rounded-lg border border-gray-300 pr-10 text-[12px]">
                    <div class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-xl">
                        <img src="{{ asset('footer/icons8-search-30.png') }}" class="w-5" />
                    </div>
                </div>
                <div class="flex justify-between items-center mt-2">
                    <p class="font-semibold text-[14px]">Tv</p>
                    <p class="font-semibold text-[14px]">7</p>
                </div>
            </div>
        </aside>
    </div>

    {{ $data['data_from'] ?? $data['product_type'] }}
    {{ $data['search'] ?? '' }}
    <span id="products-search-data-backup" data-url="{{ route('products') }}"
        data-brand="{{ $data['brand_id'] ?? '' }}" data-category="{{ $data['category_id'] ?? '' }}"
        data-name="{{ $data['name'] }}" data-from="{{ $data['data_from'] ?? $data['product_type'] }}"
        data-sort="{{ $data['sort_by'] }}" data-product-type="{{ $data['product_type'] }}"
        data-min-price="{{ $data['min_price'] }}" data-max-price="{{ $data['max_price'] }}"
        data-message="{{ translate('items_found') }}" data-publishing-house-id="{{ request('publishing_house_id') }}"
        data-author-id="{{ request('author_id') }}">
    </span>


    <script src="{{ theme_asset(path: 'public/assets/front-end/js/product-view.js') }}"></script>


@endsection
