    <div class="container-fluid mx-auto bg-[#ffffff]">
        <div class=" max-w-[100%] md:max-w-[100%] lg:md:max-w-[80%]   mx-auto justify-between items-center  text-sm py-2 border-b">

           <nav class="w-full">
            <div class="max-w-[100%] flex flex-wrap items-center justify-between mx-3 md:mx-5 md:mx-auto md:p-2">
                <div class="site-header-item site-header-focus-item  flex space-x-3"
                    data-section="base_customizer_mobile_trigger">
                    <div class=" items-center w-[120px]  md:w-[180px] mx-auto m-1">
                        <a href="{{ url('/') }}" class="flex items-center space-x-3">
                            <img src="{{ asset('public/footer/LOGO/English/PNG/A4.png') }}" class="" alt=""
                                width="100%" />
                        </a>
                    </div>
                </div>

                <div class="space-x-3 md:space-x-5 mr-3 items-center  menu_list_mobile">
                    {{-- <div class="site-header-item site-header-focus-item" data-section="base_customizer_header_search"
                        data-modal-target="default-modal" data-modal-toggle="default-modal">
                        <div class="search-toggle-open-container">
                            <button class="search-toggle-open drawer-toggle search-toggle-style-default"
                                aria-label="View Search Form" data-toggle-target="#search-drawer"
                                data-toggle-body-class="showing-popup-drawer-from-full" aria-expanded="false"
                                data-set-focus="#search-drawer .search-field">
                                <span class="search-toggle-icon">
                                    <span class="base-svg-iconsets">
                                        <svg aria-hidden="true" class="base-svg-icon base-search-svg " fill="#000000"
                                            version="1.1" xmlns="http://www.w3.org/2000/svg" width="20"
                                            height="20" viewBox="0 0 24 24">
                                            <title>Search</title>
                                            <path
                                                d="M16.041 15.856c-0.034 0.026-0.067 0.055-0.099 0.087s-0.060 0.064-0.087 0.099c-1.258 1.213-2.969 1.958-4.855 1.958-1.933 0-3.682-0.782-4.95-2.050s-2.050-3.017-2.050-4.95 0.782-3.682 2.050-4.95 3.017-2.050 4.95-2.050 3.682 0.782 4.95 2.050 2.050 3.017 2.050 4.95c0 1.886-0.745 3.597-1.959 4.856zM21.707 20.293l-3.675-3.675c1.231-1.54 1.968-3.493 1.968-5.618 0-2.485-1.008-4.736-2.636-6.364s-3.879-2.636-6.364-2.636-4.736 1.008-6.364 2.636-2.636 3.879-2.636 6.364 1.008 4.736 2.636 6.364 3.879 2.636 6.364 2.636c2.125 0 4.078-0.737 5.618-1.968l3.675 3.675c0.391 0.391 1.024 0.391 1.414 0s0.391-1.024 0-1.414z">
                                            </path>
                                        </svg>
                                    </span>
                                </span>
                            </button>
                        </div>
                    </div> --}}
                    <!-- data-section="header_search" -->
                    <div class="site-header-item site-header-focus-item"
                        data-section="base_customizer_header_mobile_account">
                        <div
                            class="header-mobile-account-wrap header-account-control-wrap header-account-action-link header-account-style-icon">
                            <a href="#" class="header-account-button">
                                <span class="base-svg-iconsets">
                                    <svg class="thebase-svg-icon thebase-account-svg " fill="#000000" version="1.1"
                                        xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 64 64">
                                        <title>Account</title>
                                        <path
                                            d="M41.2452,33.0349a16,16,0,1,0-18.49,0A26.0412,26.0412,0,0,0,4,58a2,2,0,0,0,2,2H58a2,2,0,0,0,2-2A26.0412,26.0412,0,0,0,41.2452,33.0349ZM20,20A12,12,0,1,1,32,32,12.0137,12.0137,0,0,1,20,20ZM8.09,56A22.0293,22.0293,0,0,1,30,36h4A22.0293,22.0293,0,0,1,55.91,56Z">
                                        </path>
                                    </svg>
                                </span>
                            </a>
                        </div>
                    </div>
                    <!-- data-section="header_mobile_account" -->
                    <div class="site-header-item site-header-focus-item mt-2" data-section="base_customizer_mobile_cart"
                        data-drawer-target="drawer-right-example" data-drawer-show="drawer-right-example"
                        data-drawer-placement="right" aria-controls="drawer-right-example">
                        <div class="header-mobile-cart-wrap base-header-cart">
                            <span class="header-cart-empty-check header-cart-is-empty-true"></span>
                            <div class="relative">
                                <button data-toggle-target="#cart-drawer" aria-label="Shopping Cart"
                                    class="drawer-toggle header-cart-button"
                                    data-toggle-body-class="showing-popup-drawer-from-right" aria-expanded="false"
                                    data-set-focus=".cart-toggle-close">
                                    <span class="base-svg-iconsets">
                                        <svg class="thebase-svg-icon thebase-shopping-cart-svg " id="Layer_1"
                                            data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" width="20"
                                            height="20" fill="#000000" viewBox="0 0 762.47 673.5">
                                            <path
                                                d="M600.86,489.86a91.82,91.82,0,1,0,91.82,91.82A91.81,91.81,0,0,0,600.86,489.86Zm0,142.93a51.12,51.12,0,1,1,51.11-51.11A51.12,51.12,0,0,1,600.82,632.79Z"
                                                transform="translate(0 0)"></path>
                                            <path
                                                d="M458.62,561.33H393.3a91.82,91.82,0,1,0-.05,40.92h65.37a20.46,20.46,0,0,0,0-40.92ZM303.7,632.79a51.12,51.12,0,1,1,51.12-51.11A51.11,51.11,0,0,1,303.7,632.79Z"
                                                transform="translate(0 0)"></path>
                                            <path
                                                d="M762.47,129.41a17.26,17.26,0,0,0-17.26-17.26H260.87a17.18,17.18,0,0,0-13.26,6.23,20.47,20.47,0,0,0-7.22,19.22l31.16,208a20.46,20.46,0,0,0,40.34-6.86L284.18,153.79H718.89l-37,256.4H221.59L166.75,15.06A17.26,17.26,0,0,0,147.42.14L123.7.12l0,.13H20.26a20.26,20.26,0,0,0,0,40.52H129.34l52.32,376.91,1,8.87c.1.85.15,1.71.19,2.57a23,23,0,0,0,1.35,6.76l.05.39a17.25,17.25,0,0,0,19.33,14.89l23.74.25,0-.27H698.19a24.33,24.33,0,0,0,3.44-.25,17.25,17.25,0,0,0,18.43-14.66l.18-1.27A22.94,22.94,0,0,0,721.3,428l.8-6.5,40.06-288.46a16.23,16.23,0,0,0,.16-2.59Z"
                                                transform="translate(0 0)"></path>
                                        </svg>
                                    </span>
                                    <span
                                        class="rounded-full absolute flex justify-center items-center bg-[#FC4D03] text-white w-4 h-4 -top-1 -right-2">0</span>
                                    <div class="header-cart-content"></div>
                                </button>
                            </div>
                        </div>
                    </div>
                     <div class="flex items-center md:gap-1 cursor-pointer">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 3c4.97 0 9 4.03 9 9s-4.03 9-9 9-9-4.03-9-9 4.03-9 9-9zm0 0c2.5 0 4.5 4 4.5 9s-2 9-4.5 9-4.5-4-4.5-9 2-9 4.5-9z" />
                            </svg>
                            <span class="text-sm">Eng</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                      {{-- <div class="mobile-toggle-open-container menu_list_mobile" data-drawer-target="drawer-example" data-drawer-show="drawer-example" aria-controls="drawer-example">
                        <button id="mobile-toggle" class="menu-toggle-open drawer-toggle menu-toggle-style-default"
                            aria-label="Open menu" data-toggle-target="#mobile-drawer"
                            data-toggle-body-class="showing-popup-drawer-from-left" aria-expanded="false"
                            data-set-focus=".menu-toggle-close">
                            <span class="menu-toggle-icon">
                                <span class="base-svg-iconsets">
                                    <svg aria-hidden="true" class="base-svg-icon base-menu-svg " fill="#000000"
                                        version="1.1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24">
                                        <title>Toggle Menu</title>
                                        <path
                                            d="M3 13h18c0.552 0 1-0.448 1-1s-0.448-1-1-1h-18c-0.552 0-1 0.448-1 1s0.448 1 1 1zM3 7h18c0.552 0 1-0.448 1-1s-0.448-1-1-1h-18c-0.552 0-1 0.448-1 1s0.448 1 1 1zM3 19h18c0.552 0 1-0.448 1-1s-0.448-1-1-1h-18c-0.552 0-1 0.448-1 1s0.448 1 1 1z">
                                        </path>
                                    </svg>
                                </span>
                            </span>
                        </button>
                     </div> --}}
                    </div>
                    <div class="w-full mt-4 menu_list_mobile">
                        <form class="w-full">
                            <div class="flex border-2 shadow-sm rounded-lg">
                                <label for="search-dropdown"
                                    class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Your
                                    Email</label>
                                <button id="dropdown-button1" data-dropdown-toggle="dropdown1"
                                    class="box_shadow_none shrink-0 z-30 inline-flex items-center py-2.5 px-4 text-[12px] font-medium text-center text-[#504444] bg-white border-r border-gray-300 rounded-s-lg focus:ring-4 focus:outline-none"
                                    type="button">

                                    All Categories
                                    <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"></path>
                                    </svg>
                                </button>

                                <div id="dropdown1"
                                    class="z-40 bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 hidden "
                                    style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(346.4px, 110.4px, 0px);"
                                    aria-hidden="true" data-popper-placement="bottom">
                                    <ul class="py-2 text-sm text-gray-700 " aria-labelledby="dropdown-button1">
                                        <li>
                                            <button type="button"
                                                class="inline-flex w-full px-4 py-2 hover:bg-gray-100">Our
                                                Store</button>
                                        </li>
                                        <li>
                                            <button type="button"
                                                class="inline-flex w-full px-4 py-2 hover:bg-gray-100">Groceries</button>
                                        </li>
                                        <li>
                                            <button type="button"
                                                class="inline-flex w-full px-4 py-2 hover:bg-gray-100">Premium
                                                Fruits</button>
                                        </li>
                                        <li>
                                            <button type="button"
                                                class="inline-flex w-full px-4 py-2 hover:bg-gray-100">Vegetables</button>
                                        </li>
                                        <li>
                                            <button type="button"
                                                class="inline-flex w-full px-4 py-2 hover:bg-gray-100">Dairy &
                                                Eggs</button>
                                        </li>
                                        <li>
                                            <button type="button"
                                                class="inline-flex w-full px-4 py-2 hover:bg-gray-100">Bakery</button>
                                        </li>
                                        <li>
                                            <button type="button"
                                                class="inline-flex w-full px-4 py-2 hover:bg-gray-100">Beverages</button>
                                        </li>
                                        <li>
                                            <button type="button"
                                                class="inline-flex w-full px-4 py-2 hover:bg-gray-100">Snacks &
                                                Munchies</button>
                                        </li>
                                        <li>
                                            <button type="button"
                                                class="inline-flex w-full px-4 py-2 hover:bg-gray-100">Household
                                                Essentials</button>
                                        </li>
                                        <li>
                                            <button type="button"
                                                class="inline-flex w-full px-4 py-2 hover:bg-gray-100">Personal
                                                Care</button>
                                        </li>
                                    </ul>
                                </div>
                                <div class="relative w-full">
                                    <input type="search" id="search-dropdown"
                                        class="block p-2.5 w-full z-20 text-sm text-[#504444] bg-white rounded-e-lg   text-[12px] border-none"
                                        placeholder="Search Item.." required="">
                                    <button type="submit"
                                        class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full ">
                                        <svg class="w-4 h-4" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2"
                                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"></path>
                                        </svg>
                                        <span class="sr-only">Search</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                <div class=" md:order-2   menu_list">
                    <div class="flex items-center gap-6 text-gray-800 text-base">
                        <!-- Wishlist -->
                        <div class="relative">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21.8 7.1a5.6 5.6 0 00-9.9-2.6A5.6 5.6 0 003 7.1c0 7.3 9 11.8 9 11.8s9-4.5 9-11.8z" />
                            </svg>
                            <span class="absolute -top-1 -right-2 bg-[#FC4D03] text-white text-xs font-bold w-4 h-4 rounded-full flex items-center justify-center">0</span>
                        </div>
                        <!-- Cart -->
                        <div class="header-mobile-cart-wrap base-header-cart relative">
                            <span class="header-cart-empty-check header-cart-is-empty-true"></span>
                            <div class="relative">
                                <button data-toggle-target="#cart-drawer" aria-label="Shopping Cart"
                                    class="drawer-toggle header-cart-button relative"
                                    data-toggle-body-class="showing-popup-drawer-from-right" aria-expanded="false"
                                    data-set-focus=".cart-toggle-close">
                                    <!-- SVG Cart Icon -->
                                    <span class="base-svg-iconsets">
                                        <svg class="thebase-svg-icon thebase-shopping-cart-svg w-6 h-6 text-black"
                                            xmlns="http://www.w3.org/2000/svg" fill="#000000"
                                            viewBox="0 0 762.47 673.5">
                                            <path
                                                d="M600.86,489.86a91.82,91.82,0,1,0,91.82,91.82A91.81,91.81,0,0,0,600.86,489.86Zm0,142.93a51.12,51.12,0,1,1,51.11-51.11A51.12,51.12,0,0,1,600.82,632.79Z">
                                            </path>
                                            <path
                                                d="M458.62,561.33H393.3a91.82,91.82,0,1,0-.05,40.92h65.37a20.46,20.46,0,0,0,0-40.92ZM303.7,632.79a51.12,51.12,0,1,1,51.12-51.11A51.11,51.11,0,0,1,303.7,632.79Z">
                                            </path>
                                            <path
                                                d="M762.47,129.41a17.26,17.26,0,0,0-17.26-17.26H260.87a17.18,17.18,0,0,0-13.26,6.23,20.47,20.47,0,0,0-7.22,19.22l31.16,208a20.46,20.46,0,0,0,40.34-6.86L284.18,153.79H718.89l-37,256.4H221.59L166.75,15.06A17.26,17.26,0,0,0,147.42.14L123.7.12l0,.13H20.26a20.26,20.26,0,0,0,0,40.52H129.34l52.32,376.91,1,8.87c.1.85.15,1.71.19,2.57a23,23,0,0,0,1.35,6.76l.05.39a17.25,17.25,0,0,0,19.33,14.89l23.74.25,0-.27H698.19a24.33,24.33,0,0,0,3.44-.25,17.25,17.25,0,0,0,18.43-14.66l.18-1.27A22.94,22.94,0,0,0,721.3,428l.8-6.5,40.06-288.46a16.23,16.23,0,0,0,.16-2.59Z">
                                            </path>
                                        </svg>
                                    </span>
                                    <!-- Badge -->
                                    <span
                                        class="rounded-full absolute flex justify-center items-center bg-[#FC4D03] text-white w-4 h-4 -top-1 -right-2">0</span>
                                    <div class="header-cart-content"></div>
                                </button>
                            </div>
                        </div>
                        <!-- User -->
                        <div class="header-mobile-account-wrap header-account-control-wrap header-account-action-link header-account-style-icon">
                            <a href="#" class="header-account-button">
                                <span class="base-svg-iconsets">
                                    <svg class="thebase-svg-icon thebase-account-svg " fill="#000000"
                                        version="1.1" xmlns="http://www.w3.org/2000/svg" width="20"
                                        height="20" viewBox="0 0 64 64">
                                        <title>Account</title>
                                        <path
                                            d="M41.2452,33.0349a16,16,0,1,0-18.49,0A26.0412,26.0412,0,0,0,4,58a2,2,0,0,0,2,2H58a2,2,0,0,0,2-2A26.0412,26.0412,0,0,0,41.2452,33.0349ZM20,20A12,12,0,1,1,32,32,12.0137,12.0137,0,0,1,20,20ZM8.09,56A22.0293,22.0293,0,0,1,30,36h4A22.0293,22.0293,0,0,1,55.91,56Z">
                                        </path>
                                    </svg>
                                </span>
                            </a>
                        </div>
                        <!-- Language Dropdown -->
                        <div class="flex items-center gap-1 cursor-pointer">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 3c4.97 0 9 4.03 9 9s-4.03 9-9 9-9-4.03-9-9 4.03-9 9-9zm0 0c2.5 0 4.5 4 4.5 9s-2 9-4.5 9-4.5-4-4.5-9 2-9 4.5-9z" />
                            </svg>
                            <span class="text-sm">Eng</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                    <button data-collapse-toggle="navbar-search" type="button"
                        class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                        aria-controls="navbar-search" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 17 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
                        </svg>
                    </button>
                </div>
                <div class="  menu_list">
                    <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-search">
                        <div class="relative mt-3 md:hidden">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            <input type="text" id="search-navbar"
                                class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500  dark:border-gray-600 dark:placeholder-gray-400 dark: dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Search...">
                        </div>
                        <div class="flex ">
                            <ul
                                class="flex flex-col p-2 md:p-0 mt-4 font-medium rounded-lg   rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 ">
                                    <li class="block py-2    rounded-sm md:bg-transparent">
                                        <a href="{{ url("/")}}"  class="  b px-5">Home</a>
                                    </li>
                                    <li class="block py-2    rounded-sm md:bg-transparent">
                                        <a href="{{ url("product-filter")}}"  class=" px-5">Product Filter</a>
                                    </li>
                                    <li class="block py-2    rounded-sm md:bg-transparent">
                                        <a href="{{ url("product-details")}}"  class=" px-5">Product Detail</a>
                                    </li>
                                    <li class="block py-2    rounded-sm md:bg-transparent">
                                        <a class=" px-5"></a>
                                    </li>
                                    <li class="block py-2    rounded-sm md:bg-transparent">
                                        <a class=" px-5"></a>
                                    </li>

                            </ul>
                        </div>
                        <div class="w-[350px]">
                            <form class="w-full">
                                <div class="flex border-2 shadow-sm rounded-lg">
                                    <label for="search-dropdown"
                                        class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Your
                                        Email</label>
                                    <button id="dropdown-button" data-dropdown-toggle="dropdown"
                                        class="box_shadow_none shrink-0 z-30 inline-flex items-center py-2.5 px-4 text-[12px] font-medium text-center text-[#504444] bg-white border-r border-gray-300 rounded-s-lg focus:ring-4 focus:outline-none"
                                        type="button">

                                        All Categories
                                        <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                            <path stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"></path>
                                        </svg>
                                    </button>

                                    <div id="dropdown"
                                        class="z-40 bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 hidden "
                                        style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(346.4px, 110.4px, 0px);"
                                        aria-hidden="true" data-popper-placement="bottom">
                                        <ul class="py-2 text-sm text-gray-700 " aria-labelledby="dropdown-button">
                                            <li>
                                                <button type="button"
                                                    class="inline-flex w-full px-4 py-2 hover:bg-gray-100">Our
                                                    Store</button>
                                            </li>
                                            <li>
                                                <button type="button"
                                                    class="inline-flex w-full px-4 py-2 hover:bg-gray-100">Groceries</button>
                                            </li>
                                            <li>
                                                <button type="button"
                                                    class="inline-flex w-full px-4 py-2 hover:bg-gray-100">Premium
                                                    Fruits</button>
                                            </li>
                                            <li>
                                                <button type="button"
                                                    class="inline-flex w-full px-4 py-2 hover:bg-gray-100">Vegetables</button>
                                            </li>
                                            <li>
                                                <button type="button"
                                                    class="inline-flex w-full px-4 py-2 hover:bg-gray-100">Dairy &
                                                    Eggs</button>
                                            </li>
                                            <li>
                                                <button type="button"
                                                    class="inline-flex w-full px-4 py-2 hover:bg-gray-100">Bakery</button>
                                            </li>
                                            <li>
                                                <button type="button"
                                                    class="inline-flex w-full px-4 py-2 hover:bg-gray-100">Beverages</button>
                                            </li>
                                            <li>
                                                <button type="button"
                                                    class="inline-flex w-full px-4 py-2 hover:bg-gray-100">Snacks &
                                                    Munchies</button>
                                            </li>
                                            <li>
                                                <button type="button"
                                                    class="inline-flex w-full px-4 py-2 hover:bg-gray-100">Household
                                                    Essentials</button>
                                            </li>
                                            <li>
                                                <button type="button"
                                                    class="inline-flex w-full px-4 py-2 hover:bg-gray-100">Personal
                                                    Care</button>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="relative w-full">
                                        <input type="search" id="search-dropdown"
                                            class="block p-2.5 w-full z-20 text-sm text-[#504444] bg-white rounded-e-lg   text-[12px] border-none"
                                            placeholder="Search Item.." required="">
                                        <button type="submit"
                                            class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full ">
                                            <svg class="w-4 h-4" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 20 20">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"></path>
                                            </svg>
                                            <span class="sr-only">Search</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


            </div>
            </nav>
        </div>
    </div>

    <!-- drawer component -->
    <div id="drawer-example"
        class="fixed top-0 left-0 z-40 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-[#ffffff]  w-80 dark:bg-gray-800"
        tabindex="-1" aria-labelledby="drawer-label">
        <div class="flex items-center w-[180px]">
            <a href="{{ url('/') }}" class="flex items-center space-x-3">
                <img src="{{ asset('public/footer/footer_logo.png') }}" class="" alt="" width="100%" />
            </a>
        </div>

        <button type="button" data-drawer-hide="drawer-example" aria-controls="drawer-example"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 flex items-center justify-center dark:hover:bg-gray-600 dark:hover:">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close menu</span>
        </button>

        <div class=" ">
            <ul
                class=" md:p-0 mt-4 font-medium rounded-lg   rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 ">
                <li class="block py-2  border-b  rounded-sm md:bg-transparent">
                    <a href="{{ url("/")}}"  class="  b px-5">Home</a>
                </li>
                <li class="block py-2  border-b  rounded-sm md:bg-transparent">
                    <a href="{{ url("product-filter")}}"  class=" px-5">Product Filter</a>
                </li>
                <li class="block py-2  border-b  rounded-sm md:bg-transparent">
                    <a href="{{ url("product-details")}}"  class=" px-5">Product Detail</a>
                </li>
                <li class="block py-2  border-b  rounded-sm md:bg-transparent">
                    <a href="#" class=" px-5"> Brand</a>
                </li>
                <li class="block py-2  border-b  rounded-sm md:bg-transparent">
                    <a href="#" class=" px-5"> categories</a>
                </li>
                <li class="block py-2  border-b  rounded-sm md:bg-transparent">
                    <a href="#" class=" px-5"> Sellers</a>
                </li>
                <li class="block py-2  border-b  rounded-sm md:bg-transparent">
                    <a href="#" class=" px-5">Contact Us</a>
                </li>

            </ul>
        </div>

    </div>
    <!-- Navbar -->
