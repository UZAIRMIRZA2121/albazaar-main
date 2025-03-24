@php($announcement = getWebConfig(name: 'announcement'))
@php($businessMode = getWebConfig(name: 'business_mode'))
@if (isset($announcement) && $announcement['status'] == 1)
    <div class="text-center position-relative px-4 py-1 d--none" id="announcement"
        style="background-color: {{ $announcement['color'] }};color:{{ $announcement['text_color'] }}">
        <span>{{ $announcement['announcement'] }} </span>
        <span class="__close-announcement web-announcement-slideUp">X</span>
    </div>
@endif
<!-- Custom CSS -->
<style>
    /* Custom Dropdown Styling */
    .category-dropdown {
        position: relative;
    }
    .custom-dropdown-menu {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        background: white;
        border: 1px solid #ddd;
        border-radius: 5px;
        width: 100%;
        max-height: 200px;
        overflow-y: auto;
        z-index: 1000;
        padding: 0;
        margin: 0;
        list-style: none;
    }
    .custom-dropdown-menu li {
        padding: 8px 15px;
        cursor: pointer;
    }
    .custom-dropdown-menu li:hover {
        background: #f1f1f1;
    }
</style>

<header class="rtl __inline-10">
    <div class="topbar" style="background-color: #fbf5f5; position: relative;">
        <button class="close-btn text-danger" style="position: absolute; left: 10px; top: 0px; background: none; border: none; font-size: 16px; cursor: pointer;">&times;</button>
        <p class="text-center d-block m-auto" style="color: #fc4d05"><b>Get 50% discount for specific products.</b></p>
    </div>
    <script>
        document.querySelector('.close-btn').addEventListener('click', function () {
            document.querySelector('.topbar').classList.add('d-none');
        });
    </script>
    
<!-- JavaScript to Handle Dropdown -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const categoryButton = document.getElementById("categoryDropdown");
        const dropdownMenu = document.getElementById("categoryDropdownMenu");
        const categoryItems = document.querySelectorAll(".category-select");
        const selectedCategoryInput = document.getElementById("selectedCategory");

        categoryItems.forEach(item => {
            item.addEventListener("click", function (event) {
                event.preventDefault();
                categoryButton.textContent = this.textContent; // Change button text
                selectedCategoryInput.value = this.getAttribute("data-value"); // Set hidden input value
            });
        });

        // Show/Hide dropdown on button click
        categoryButton.addEventListener("click", function () {
            dropdownMenu.classList.toggle("show");
        });

        // Close dropdown when clicking outside
        document.addEventListener("click", function (event) {
            if (!categoryButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.remove("show");
            }
        });
    });
</script>
    @php($categories = \App\Utils\CategoryManager::getCategoriesWithCountingAndPriorityWiseSorting(dataLimit: 11))

    <div class="navbar-sticky bg-light mobile-head">
        <div class="navbar navbar-expand-md navbar-light">
            <div class="container ">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand d-none d-sm-block mr-3 flex-shrink-0 __min-w-7rem" href="{{ route('home') }}">
                    <img class="__inline-11" src="{{ getStorageImages(path: $web_config['web_logo'], type: 'logo') }}"
                        alt="{{ $web_config['company_name'] }}">
                </a>
                <a class="navbar-brand d-sm-none" href="{{ route('home') }}">
                    <img class="mobile-logo-img __inline-12"
                        src="{{ getStorageImages(path: $web_config['mob_logo'], type: 'logo') }}"
                        alt="{{ $web_config['company_name'] }}" />
                </a>
               <!-- jQuery CDN -->
<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Search Bar with Category Dropdown -->
<div class="input-group-overlay mx-lg-4 search-form-mobile text-align-direction">
    <form action="{{ route('products') }}" method="GET" class="d-flex border rounded overflow-hidden">
        
        <!-- Custom Category Dropdown -->
        <div class="category-dropdown position-relative">
            <button type="button" class="btn btn-light border-0 px-3 d-flex align-items-center" id="categoryButton">
                <span id="selectedCategory">All Categories</span>
                <i class="czi-arrow-down ms-2"></i>
            </button>

         

            <input type="hidden" name="category_id" id="categoryInput" value="">
        </div>

        <!-- Search Input -->
        <input class="form-control border-0" type="search" autocomplete="off" placeholder="Search for items..." name="name" value="{{ request('name') }}">
        
        <!-- Search Button -->
        <button class="btn btn-primary px-4" type="submit">
            <i class="czi-search text-white"></i>
        </button>
    </form>
       <!-- Dropdown Menu Moved Inside -->
       <ul class="custom-dropdown-menu" id="categoryMenu">
        <li><a class="dropdown-item category-option" data-value="" href="#">All Categories</a></li>
        @foreach ($categories as $category)
            <li><a class="dropdown-item category-option" data-value="{{ $category['id'] }}" href="#">{{ $category['name'] }}</a></li>
        @endforeach
    </ul>
</div>


                <div class="navbar-toolbar d-flex flex-shrink-0 align-items-center">
                    <a class="navbar-tool navbar-stuck-toggler" href="#">
                        <span class="navbar-tool-tooltip">{{ translate('expand_Menu') }}</span>
                        <div class="navbar-tool-icon-box">
                            <i class="navbar-tool-icon czi-menu open-icon"></i>
                            <i class="navbar-tool-icon czi-close close-icon"></i>
                        </div>
                    </a>
                    <div
                        class="navbar-tool open-search-form-mobile d-lg-none {{ Session::get('direction') === 'rtl' ? 'mr-md-3' : 'ml-md-3' }}">
                        <a class="navbar-tool-icon-box bg-secondary" href="javascript:">
                            <i class="tio-search"></i>
                        </a>
                    </div>

                    <div>
                        @php($currency_model = getWebConfig(name: 'currency_model'))
                        @if ($currency_model == 'multi_currency')
                            <div class="topbar-text dropdown disable-autohide mr-4">
                                <a class="topbar-link dropdown-toggle" href="#" data-toggle="dropdown">
                                    <span>{{ session('currency_code') }} {{ session('currency_symbol') }}</span>
                                </a>
                                <ul
                                    class="text-align-direction dropdown-menu dropdown-menu-{{ Session::get('direction') === 'rtl' ? 'right' : 'left' }} min-width-160px">
                                    @foreach (\App\Models\Currency::where('status', 1)->get() as $key => $currency)
                                        <li class="dropdown-item cursor-pointer get-currency-change-function"
                                            data-code="{{ $currency['code'] }}">
                                            {{ $currency->name }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
        
                        <div class="topbar-text dropdown disable-autohide  __language-bar text-capitalize">
                            <a class="topbar-link dropdown-toggle" href="#" data-toggle="dropdown">
                                @foreach ($web_config['language'] as $data)
                                    @if ($data['code'] == getDefaultLanguage())
                                    <span class="mr-2 text-capitalize">{{ strtoupper(substr($data['name'], 0, 2)) }}</span>
                                        <img class="" width="20"
                                            src="{{ theme_asset(path: 'public/assets/front-end/img/flags/' . $data['code'] . '.png') }}"
                                            alt="{{ $data['name'] }}">
                                       
                                    @endif
                                @endforeach
                            </a>
                            <ul
                                class="text-align-direction dropdown-menu dropdown-menu-{{ Session::get('direction') === 'rtl' ? 'right' : 'left' }}">
                                @foreach ($web_config['language'] as $key => $data)
                                    @if ($data['status'] == 1)
                                        <li class="change-language" data-action="{{ route('change-language') }}"
                                            data-language-code="{{ $data['code'] }}">
                                           
                                            <a class="dropdown-item pb-1" href="javascript:">
                                                <img class="mr-2 " width="20"
                                                    src="{{ theme_asset(path: 'public/assets/front-end/img/flags/' . $data['code'] . '.png') }}"
                                                    alt="{{ $data['name'] }}" />
                                                    <span class="text-capitalize">{{ $data['name'] }}</span>
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div
                        class="navbar-tool dropdown d-none d-md-block {{ Session::get('direction') === 'rtl' ? 'mr-md-3' : 'ml-md-3' }}">
                        <a class="navbar-tool-icon-box bg-secondary dropdown-toggle" href="{{ route('wishlists') }}">
                            <span class="navbar-tool-label">
                                <span class="countWishlist">
                                    {{ session()->has('wish_list') ? count(session('wish_list')) : 0 }}
                                </span>
                            </span>
                            <i class="navbar-tool-icon czi-heart"></i>
                        </a>
                    </div>

                    <div id="cart_items">
                        @include('layouts.front-end.partials._cart')
                    </div>
                    @if (auth('customer')->check())
                        <div class="dropdown">
                            <a class="navbar-tool ml-3" type="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <div class="navbar-tool-icon-box bg-secondary">
                                    <div class="navbar-tool-icon-box bg-secondary">
                                        <img class="img-profile rounded-circle __inline-14" alt=""
                                            src="{{ getStorageImages(path: auth('customer')->user()->image_full_url, type: 'avatar') }}">
                                    </div>
                                </div>
                                <div class="navbar-tool-text">
                                    <small>
                                        {{ translate('hello') }},
                                        {{ Str::limit(auth('customer')->user()->f_name, 10) }}
                                    </small>
                                    {{ translate('dashboard') }}
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-{{ Session::get('direction') === 'rtl' ? 'left' : 'right' }}"
                                aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{ route('account-oder') }}">
                                    {{ translate('my_Order') }} </a>
                                <a class="dropdown-item" href="{{ route('user-account') }}">
                                    {{ translate('my_Profile') }}</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"
                                    href="{{ route('customer.auth.logout') }}">{{ translate('logout') }}</a>
                            </div>
                        </div>
                    @else
                        <div class="dropdown">
                            <a class="navbar-tool {{ Session::get('direction') === 'rtl' ? 'mr-md-3' : 'ml-md-3' }}"
                                type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="navbar-tool-icon-box bg-secondary">
                                    <div class="navbar-tool-icon-box bg-secondary">
                                        <svg width="16" height="17" viewBox="0 0 16 17" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M4.25 4.41675C4.25 6.48425 5.9325 8.16675 8 8.16675C10.0675 8.16675 11.75 6.48425 11.75 4.41675C11.75 2.34925 10.0675 0.666748 8 0.666748C5.9325 0.666748 4.25 2.34925 4.25 4.41675ZM14.6667 16.5001H15.5V15.6667C15.5 12.4509 12.8825 9.83341 9.66667 9.83341H6.33333C3.11667 9.83341 0.5 12.4509 0.5 15.6667V16.5001H14.6667Z"
                                                fill="#1B7FED" />
                                        </svg>

                                    </div>
                                </div>
                            </a>
                            <div class="text-align-direction dropdown-menu __auth-dropdown dropdown-menu-{{ Session::get('direction') === 'rtl' ? 'left' : 'right' }}"
                                aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{ route('customer.auth.login') }}">
                                    <i class="fa fa-sign-in mr-2"></i> {{ translate('sign_in') }}
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('customer.auth.sign-up') }}">
                                    <i class="fa fa-user-circle mr-2"></i>{{ translate('sign_up') }}
                                </a>
                            </div>
                        </div>

                        <div class=" d-none d-lg-block">
                            @if ($businessMode == 'multi')
                                @if (getWebConfig(name: 'seller_registration'))
                                    <div class="dropdown show mx-2 ">
                                        <a class="btn  bg-light dropdown-toggle" href="#" role="button"
                                            id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            Vendor
                                        </a>

                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item"
                                                href="{{ route('vendor.auth.registration.index') }}">
                                                {{ translate('become_a_vendor') }}</a>
                                            <a class="dropdown-item" href="{{ route('vendor.auth.login') }}">
                                                {{ translate('vendor_login') }}</a>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="navbar navbar-expand-md navbar-stuck-menu">
            <div class="container px-10px">
                <div class="collapse navbar-collapse text-align-direction" id="navbarCollapse">
                    <div class="w-100 d-md-none text-align-direction">
                        <button class="navbar-toggler p-0" type="button" data-toggle="collapse"
                            data-target="#navbarCollapse">
                            <i class="tio-clear __text-26px"></i>
                        </button>
                    </div>
                    <ul class="navbar-nav d-block d-md-none">
                        <li class="nav-item dropdown {{ request()->is('/') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('home') }}">{{ translate('home') }}</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown d-none d-md-block {{ request()->is('/') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('home') }}">{{ translate('home') }}</a>
                        </li>

                        @if (getWebConfig(name: 'product_brand'))
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#"
                                    data-toggle="dropdown">{{ translate('brand') }}</a>
                                <ul
                                    class="text-align-direction dropdown-menu __dropdown-menu-sizing dropdown-menu-{{ Session::get('direction') === 'rtl' ? 'right' : 'left' }} scroll-bar">
                                    @php($brandIndex = 0)
                                    @foreach (\App\Utils\BrandManager::getActiveBrandWithCountingAndPriorityWiseSorting() as $brand)
                                        @php($brandIndex++)
                                        @if ($brandIndex < 10)
                                            <li class="__inline-17">
                                                <div>
                                                    <a class="dropdown-item"
                                                        href="{{ route('products', ['brand_id' => $brand['id'], 'data_from' => 'brand', 'page' => 1]) }}">
                                                        {{ $brand['name'] }}
                                                    </a>
                                                </div>
                                                <div class="align-baseline">
                                                    @if ($brand['brand_products_count'] > 0)
                                                        <span class="count-value px-2">(
                                                            {{ $brand['brand_products_count'] }} )</span>
                                                    @endif
                                                </div>
                                            </li>
                                        @endif
                                    @endforeach
                                    <li class="__inline-17">
                                        <div>
                                            <a class="dropdown-item web-text-primary" href="{{ route('brands') }}">
                                                {{ translate('view_more') }}
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        @endif

                        @if ($web_config['discount_product'] > 0)
                            <li class="nav-item dropdown {{ request()->is('/') ? 'active' : '' }}">
                                <a class="nav-link text-capitalize"
                                    href="{{ route('products', ['data_from' => 'discounted', 'page' => 1]) }}">
                                    {{ translate('discounted_products') }}
                                </a>
                            </li>
                        @endif

                        @if ($web_config['digital_product_setting'] && count($web_config['publishing_houses']) == 1)
                            <li class="nav-item dropdown d-none d-md-block {{ request()->is('/') ? 'active' : '' }}">
                                <a class="nav-link"
                                    href="{{ route('products', ['publishing_house_id' => 0, 'product_type' => 'digital', 'page' => 1]) }}">
                                    {{ translate('Publication_House') }}
                                </a>
                            </li>
                        @elseif ($web_config['digital_product_setting'] && count($web_config['publishing_houses']) > 1)
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                                    {{ translate('Publication_House') }}
                                </a>
                                <ul
                                    class="text-align-direction dropdown-menu __dropdown-menu-sizing dropdown-menu-{{ Session::get('direction') === 'rtl' ? 'right' : 'left' }} scroll-bar">
                                    @php($publishingHousesIndex = 0)
                                    @foreach ($web_config['publishing_houses'] as $publishingHouseItem)
                                        @if ($publishingHousesIndex < 10 && $publishingHouseItem['name'] != 'Unknown')
                                            @php($publishingHousesIndex++)
                                            <li class="__inline-17">
                                                <div>
                                                    <a class="dropdown-item"
                                                        href="{{ route('products', ['publishing_house_id' => $publishingHouseItem['id'], 'product_type' => 'digital', 'page' => 1]) }}">
                                                        {{ $publishingHouseItem['name'] }}
                                                    </a>
                                                </div>
                                                <div class="align-baseline">
                                                    @if ($publishingHouseItem['publishing_house_products_count'] > 0)
                                                        <span class="count-value px-2">(
                                                            {{ $publishingHouseItem['publishing_house_products_count'] }}
                                                            )</span>
                                                    @endif
                                                </div>
                                            </li>
                                        @endif
                                    @endforeach
                                    <li class="__inline-17">
                                        <div>
                                            <a class="dropdown-item web-text-primary"
                                                href="{{ route('products', ['product_type' => 'digital', 'page' => 1]) }}">
                                                {{ translate('view_more') }}
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        @endif

                        @php($businessMode = getWebConfig(name: 'business_mode'))
                        @if ($businessMode == 'multi')
                            <li class="nav-item dropdown {{ request()->is('/') ? 'active' : '' }}">
                                <a class="nav-link text-capitalize"
                                    href="{{ route('vendors') }}">{{ translate('all_vendors') }}</a>
                            </li>
                        @endif

                        @if (auth('customer')->check())
                            <li class="nav-item d-md-none">
                                <a href="{{ route('user-account') }}" class="nav-link text-capitalize">
                                    {{ translate('user_profile') }}
                                </a>
                            </li>
                            <li class="nav-item d-md-none">
                                <a href="{{ route('wishlists') }}" class="nav-link">
                                    {{ translate('Wishlist') }}
                                </a>
                            </li>
                        @else
                            <li class="nav-item d-md-none">
                                <a class="dropdown-item pl-2" href="{{ route('customer.auth.login') }}">
                                    <i class="fa fa-sign-in mr-2"></i> {{ translate('sign_in') }}
                                </a>
                                <div class="dropdown-divider"></div>
                            </li>
                            <li class="nav-item d-md-none">
                                <a class="dropdown-item pl-2" href="{{ route('customer.auth.sign-up') }}">
                                    <i class="fa fa-user-circle mr-2"></i>{{ translate('sign_up') }}
                                </a>
                            </li>
                        @endif





                        @if ($businessMode == 'multi')
                            @if (getWebConfig(name: 'seller_registration'))
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#"
                                        data-toggle="dropdown">{{ translate('Vendor') }}</a>
                                    <ul
                                        class="text-align-direction dropdown-menu __dropdown-menu-sizing dropdown-menu-{{ Session::get('direction') === 'rtl' ? 'right' : 'left' }} scroll-bar">


                                        <li class="__inline-17">
                                            <div>
                                                <a class="dropdown-item"
                                                    href="{{ route('vendor.auth.registration.index') }}">
                                                    {{ translate('become_a_vendor') }}
                                                </a>
                                                <a class="dropdown-item" href="{{ route('vendor.auth.login') }}">
                                                    {{ translate('vendor_login') }}
                                                </a>
                                            </div>

                                        </li>
                                    </ul>
                                </li>
                            @endif
                        @endif


                    </ul>

                    @if (auth('customer')->check())
                        <div class="logout-btn mt-auto d-md-none">
                            <hr>
                            <a href="{{ route('customer.auth.logout') }}" class="nav-link">
                                <strong class="text-base">{{ translate('logout') }}</strong>
                            </a>
                        </div>
                    @endif

                </div>
                <div>
                    <ul class="navbar-nav d-flex justify-content-end w-100">
                        <li class="nav-item dropdown d-none d-md-block {{ request()->is('/') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('home') }}">
                                <i class="fas fa-sun"></i> Light
                            </a>
                        </li>
                        <li class="nav-item dropdown d-none d-md-block {{ request()->is('/') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('home') }}">
                                <i class="fas fa-phone-alt"></i> Support
                            </a>
                        </li>
                    </ul>
                </div>


            </div>
        </div>

        <div class="megamenu-wrap">
            <div class="container">
                <div class="category-menu-wrap">
                    <ul class="category-menu">
                        @foreach ($categories as $key => $category)
                            <li>
                                <a
                                    href="{{ route('products', ['category_id' => $category['id'], 'data_from' => 'category', 'page' => 1]) }}">{{ $category->name }}</a>
                                @if ($category->childes->count() > 0)
                                    <div class="mega_menu z-2">
                                        @foreach ($category->childes as $sub_category)
                                            <div class="mega_menu_inner">
                                                <h6>
                                                    <a
                                                        href="{{ route('products', ['category_id' => $sub_category['id'], 'data_from' => 'category', 'page' => 1]) }}">{{ $sub_category->name }}</a>
                                                </h6>
                                                @if ($sub_category->childes->count() > 0)
                                                    @foreach ($sub_category->childes as $sub_sub_category)
                                                        <div>
                                                            <a
                                                                href="{{ route('products', ['category_id' => $sub_sub_category['id'], 'data_from' => 'category', 'page' => 1]) }}">{{ $sub_sub_category->name }}</a>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </li>
                        @endforeach
                        <li class="text-center">
                            <a href="{{ route('categories') }}"
                                class="text-primary font-weight-bold justify-content-center">
                                {{ translate('View_All') }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>

@push('script')
    <script>
        "use strict";

        $(".category-menu").find(".mega_menu").parents("li")
            .addClass("has-sub-item").find("> a")
            .append("<i class='czi-arrow-{{ Session::get('direction') === 'rtl' ? 'left' : 'right' }}'></i>");
    </script>
    
<!-- jQuery Script -->
<script>
    $(document).ready(function () {
        // Toggle dropdown on button click
        $("#categoryButton").click(function (event) {
            event.stopPropagation(); // Prevents click from closing immediately
            $("#categoryMenu").toggle(); // Show/hide dropdown
        });

        // Close dropdown when clicking outside
        $(document).click(function (event) {
            if (!$(event.target).closest(".category-dropdown").length) {
                $("#categoryMenu").hide();
            }
        });

        // Update button text and hidden input when selecting a category
        $(".category-option").click(function (event) {
            event.preventDefault();
            var selectedText = $(this).text();
            var selectedValue = $(this).data("value");

            $("#selectedCategory").text(selectedText); // Update button text
            $("#categoryInput").val(selectedValue); // Update hidden input
            $("#categoryMenu").hide(); // Close dropdown
        });
    });
</script>

@endpush
