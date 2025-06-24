<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Albazaar Header</title>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" /> --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .top-bar {
            background-color: #ed1c24;
            color: white;
            font-size: 14px;
            padding: 5px 20px;
        }



        .nav-link {
            color: black !important;
            font-weight: 400;
        }

        .search-input {
            border-radius: 12px;
        }

        .badge-custom {
            font-size: 10px;
            background-color: #ff4500;
            position: absolute;
            top: -5px;
            right: -5px;
        }

        a {
            text-decoration: none;
            color: inherit;
            color: black;
        }

        @media (max-width: 767.98px) {
            .search-bar {
                flex-direction: column;
            }

            .logo {
                height: 40px;
                width: auto;

            }
        }
    </style>
    <style>
        .category-dropdown {
            min-width: 160px;
        }

        .categoryMenu {
            display: none;
            background: white;
            border: 1px solid #ddd;
            max-height: 200px;
            overflow-y: auto;
            padding: 0;
            margin: 0;
        }

        .categoryMenu.show {
            display: block;
        }

        .categoryMenu li a {
            padding: 8px 12px;
            display: block;
        }

        .categoryMenu li a:hover {
            background-color: #f8f9fa;
        }
    </style>
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

</head>

@php($announcement = getWebConfig(name: 'announcement'))
@php($businessMode = getWebConfig(name: 'business_mode'))
@if (isset($announcement) && $announcement['status'] == 1)
    <!-- Top Bar -->
    <div class="top-bar text-center"
        style="background-color: {{ $announcement['color'] }};color:{{ $announcement['text_color'] }}">
        {{ $announcement['announcement'] }}
    </div>
@endif
@php($categories = App\Models\Category::all())



<!-- Header -->
<header class="container py-3 rtl __inline-10">
    <div class="row align-items-center">

        <!-- Logo -->
        <div class="col-md-2 col-6 d-flex align-items-center">
            <a class="navbar-brand d-none d-sm-block me-3 flex-shrink-0" href="{{ route('home') }}">
                <img src="{{ asset('public/images/albazar-logo.png') }}" class="img-fluid" style="max-height:60px;"
                    alt="logo" class="me-2 ">

            </a>
            <!-- Desktop Logo -->
            <a class="navbar-brand d-none d-sm-block me-3 flex-shrink-0" href="{{ route('home') }}">
                <img class="img-fluid" style="max-height: 40px;"
                    src="{{ !empty($web_config['web_logo']) ? getStorageImages(path: $web_config['web_logo'], type: 'logo') : asset('public/images/albazar-logo.png') }}"
                    alt="{{ $web_config['company_name'] ?? 'Albazaar' }}">
            </a>

            <!-- Mobile Logo -->
            <a class="navbar-brand d-sm-none" href="{{ route('home') }}">
                <img class="img-fluid" style="max-height: 30px;"
                    src="{{ !empty($web_config['mob_logo']) ? getStorageImages(path: $web_config['mob_logo'], type: 'logo') : asset('public/images/albazar-logo.png') }}"
                    alt="{{ $web_config['company_name'] ?? 'Albazaar' }}">
            </a>
        </div>



        <!-- Search (mobile version) -->
        <div class="col-12 d-md-none mb-3">
            <div class="d-flex flex-column gap-2">
                <select class="form-select">
                    <option selected>All Categories</option>
                    <option>Kids</option>
                    <option>Electronics</option>
                </select>
                <div class="input-group">
                    <input type="text" class="form-control search-input" placeholder="Search items">
                    <span class="input-group-text bg-white border-start-0"><i class="bi bi-search"></i></span>
                </div>
            </div>
        </div>


        <!-- Nav Links -->
        <div class="col-md-4 d-none d-md-flex">
            <nav class="nav">
                <a class="nav-link" href="{{ route('home') }}">Home</a>
                <a class="nav-link" href="{{ route('home') }}#new-arrival-section">New Arrivals</a>
                <a class="nav-link" href="{{ route('vendors') }}">All Vendors</a>
            </nav>
        </div>

        <!-- Search Bar Desktop -->
        <div class="col-md-4">
            <form action="{{ route('products') }}" method="GET"
                class="d-flex border rounded align-items-center position-relative bg-white">

                <!-- Category Dropdown (Inside the form) -->
                <div class="dropdown category-dropdown">
                    <button class="btn btn-light border-0 px-3 d-flex align-items-center dropdown-toggle" type="button"
                        id="categoryDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="selectedCategory">All Categories</span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="categoryDropdown"
                        style="max-height: 200px; overflow-y: auto;">
                        <li><a class="dropdown-item category-option" data-value="" href="#">All
                                Categories</a></li>
                        @foreach ($categories as $category)
                            <li>
                                <a class="dropdown-item category-option" data-value="{{ $category->id }}"
                                    href="#">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <input type="hidden" name="category_id" class="categoryInput" value="">
                </div>

                <!-- Search Input -->
                <input type="text" class="form-control border-0 px-2" placeholder="Search for items..."
                    name="name">

                <!-- Submit Trigger -->
                <span class="px-4 search-trigger" style="cursor: pointer;">
                    <i class="bi bi-search text-dark"></i>
                </span>
            </form>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Submit form when search icon is clicked
                const searchTriggers = document.querySelectorAll('.search-trigger');
                searchTriggers.forEach(function(trigger) {
                    trigger.addEventListener('click', function() {
                        const form = trigger.closest('form');
                        if (form) form.submit();
                    });
                });

                // Handle category selection
                const categoryOptions = document.querySelectorAll('.category-option');
                categoryOptions.forEach(function(option) {
                    option.addEventListener('click', function(e) {
                        e.preventDefault();

                        const value = this.getAttribute('data-value');
                        const text = this.textContent;

                        const dropdown = this.closest('.category-dropdown');
                        const selectedSpan = dropdown.querySelector('.selectedCategory');
                        const hiddenInput = dropdown.querySelector('.categoryInput');

                        if (selectedSpan) selectedSpan.textContent = text;
                        if (hiddenInput) hiddenInput.value = value;
                    });
                });
            });
        </script>


        <!-- Icons -->
        <div class="col-6 col-md-2">
            <div class="d-flex align-items-center gap-3 justify-content-end">

                <span class="position-relative">
                    <a href="{{ route('wishlists') }}">
                        <i class="bi bi-heart fs-5 text-dark"></i>
                        <span
                            class="badge rounded-pill badge-custom">{{ session()->has('wish_list') ? count(session('wish_list')) : 0 }}</span>
                    </a>

                </span>
                {{-- @include('layouts.front-end.partials._cart') --}}
                <span class="position-relative">
                    <a href="{{ asset('shop-cart') }}" class="text-dark">

                        <i class="bi bi-cart fs-5"></i>
                        <span class="badge rounded-pill badge-custom">0</span>
                    </a>
                </span>
                <i class="bi bi-person fs-5"></i>

                {{-- <span class="d-none d-md-inline">Eng <i class="bi bi-caret-down-fill"></i></span> --}}
                <!-- Language Dropdown (Desktop) -->

                <div class="dropdown ms-3">
                    <span class=" dropdown-toggle d-none d-md-inline" type="button" id="languageDropdown"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-globe fs-5"></i> Eng
                    </span>
                    <ul class="dropdown-menu" aria-labelledby="languageDropdown">
                        @foreach ($web_config['language'] as $key => $data)
                            @if ($data['status'] == 1)
                                <li class="change-language" data-action="{{ route('change-language') }}"
                                    data-language-code="{{ $data['code'] }}">
                                    <a class="dropdown-item pb-1" href="javascript:void(0);">
                                        <img class="me-2" width="20"
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
        </div>
    </div>
</header>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".category-option").forEach(function(item) {
            item.addEventListener("click", function(e) {
                e.preventDefault();
                const dropdown = item.closest(".category-dropdown");
                dropdown.querySelector(".selectedCategory").textContent = item.textContent
                    .trim();
                dropdown.querySelector(".categoryInput").value = item.getAttribute(
                    "data-value");
            });
        });
    });
</script>



<script>
    "use strict";

    $(".category-menu").find(".mega_menu").parents("li")
        .addClass("has-sub-item").find("> a")
        .append("<i class='czi-arrow-{{ Session::get('direction') === 'rtl' ? 'left' : 'right' }}'></i>");
</script>
