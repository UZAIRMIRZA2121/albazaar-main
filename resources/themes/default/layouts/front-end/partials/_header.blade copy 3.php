      <div class="max-w-[100%] flex flex-wrap items-center justify-between  md:mx-5 md:mx-auto md:p-2">
                    <div class="site-header-item site-header-focus-item  flex space-x-3"
                        data-section="base_customizer_mobile_trigger">
                        <div class=" items-center w-[120px]  md:w-[180px] mx-auto m-1">
                            <a href="{{ url('/') }}" class="flex items-center space-x-3">
                                <img src="{{ asset('public/footer/LOGO/English/PNG/A4.png') }}" class=""
                                    alt="" width="100%" />
                            </a>
                        </div>
                    </div>


                    <div class="space-x-3 md:space-x-5 mr-3 items-center  menu_list_mobile">

                        <!-- data-section="header_search" -->
                        <div id="cart_items">
                            @include('layouts.front-end.partials._cart')
                        </div>
                        <div class="site-header-item site-header-focus-item"
                            data-section="base_customizer_header_mobile_account">
                            <div
                                class="header-mobile-account-wrap header-account-control-wrap header-account-action-link header-account-style-icon">

                                @if (auth('customer')->check())
                                    <!-- Bootstrap 5 dropdown for authenticated customer -->
                                    <div class="dropdown">
                                        <a class="header-account-button dropdown-toggle d-inline-block text-decoration-none text-dark"
                                            href="#" id="customerDropdown" role="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <small>{{ Str::limit(auth('customer')->user()->f_name, 10) }}</small>
                                        </a>

                                        <ul class="dropdown-menu dropdown-menu-{{ Session::get('direction') === 'rtl' ? 'start' : 'end' }}"
                                            aria-labelledby="customerDropdown">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('account-oder') }}">
                                                    <i class="fa fa-shopping-bag me-2"></i> {{ translate('my_Order') }}
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('user-account') }}">
                                                    <i class="fa fa-user me-2"></i> {{ translate('my_Profile') }}
                                                </a>
                                            </li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('customer.auth.logout') }}">
                                                    <i class="fa fa-sign-out me-2"></i> {{ translate('logout') }}
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                @else
                                    <div class="dropdown">
                                        <button
                                            class="btn border-0 bg-transparent dropdown-toggle d-flex align-items-center"
                                            type="button" id="guestDropdown" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <span class="base-svg-iconsets">
                                                <svg class="thebase-svg-icon thebase-account-svg" fill="#000000"
                                                    version="1.1" xmlns="http://www.w3.org/2000/svg" width="20"
                                                    height="20" viewBox="0 0 64 64">
                                                    <title>Account</title>
                                                    <path
                                                        d="M41.2452,33.0349a16,16,0,1,0-18.49,0A26.0412,26.0412,0,0,0,4,58a2,2,0,0,0,2,2H58a2,2,0,0,0,2-2A26.0412,26.0412,0,0,0,41.2452,33.0349ZM20,20A12,12,0,1,1,32,32,12.0137,12.0137,0,0,1,20,20ZM8.09,56A22.0293,22.0293,0,0,1,30,36h4A22.0293,22.0293,0,0,1,55.91,56Z">
                                                    </path>
                                                </svg>
                                            </span>
                                        </button>

                                        <ul class="dropdown-menu dropdown-menu-{{ Session::get('direction') === 'rtl' ? 'start' : 'end' }}"
                                            aria-labelledby="guestDropdown">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('customer.auth.login') }}">
                                                    <i class="fa fa-sign-in me-2"></i>
                                                    {{ translate('customer_login') }}
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('vendor.auth.login') }}">
                                                    <i class="fa fa-user-circle me-2"></i>
                                                    {{ translate('vendor_login') }}
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                @endif
                                

                                @if (auth()->guard('seller')->check())
                                    <small> {{ Str::limit(auth('seller')->user()->f_name, 10) }}
                                    </small>
                                @endif
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


                    <div class=" md:order-2   menu_list">
                        <div class="flex items-center gap-6 text-gray-800 text-base">
                            <!-- Wishlist -->
                            <div class="relative">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21.8 7.1a5.6 5.6 0 00-9.9-2.6A5.6 5.6 0 003 7.1c0 7.3 9 11.8 9 11.8s9-4.5 9-11.8z" />
                                </svg>
                                <span
                                    class="absolute -top-1 -right-2 bg-[#FC4D03] text-white text-xs font-bold w-4 h-4 rounded-full flex items-center justify-center">0</span>
                            </div>
                            <!-- Cart -->
                            <div id="cart_items">
                                @include('layouts.front-end.partials._cart')
                            </div>

                            <!-- User -->
                            @if (auth('customer')->check())
                                <!-- Bootstrap 5 dropdown for authenticated customer -->
                                <div class="dropdown">
                                    <a class="header-account-button dropdown-toggle d-inline-block text-decoration-none text-dark"
                                        href="#" id="customerDropdown" role="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <small>{{ Str::limit(auth('customer')->user()->f_name, 10) }}</small>
                                    </a>

                                    <ul class="dropdown-menu dropdown-menu-{{ Session::get('direction') === 'rtl' ? 'start' : 'end' }}"
                                        aria-labelledby="customerDropdown">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('account-oder') }}">
                                                <i class="fa fa-shopping-bag me-2"></i> {{ translate('my_Order') }}
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('user-account') }}">
                                                <i class="fa fa-user me-2"></i> {{ translate('my_Profile') }}
                                            </a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('customer.auth.logout') }}">
                                                <i class="fa fa-sign-out me-2"></i> {{ translate('logout') }}
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            @else
                                <div class="dropdown">
                                    <button
                                        class="btn border-0 bg-transparent dropdown-toggle d-flex align-items-center"
                                        type="button" id="guestDropdown" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <span class="base-svg-iconsets">
                                            <svg class="thebase-svg-icon thebase-account-svg" fill="#000000"
                                                version="1.1" xmlns="http://www.w3.org/2000/svg" width="20"
                                                height="20" viewBox="0 0 64 64">
                                                <title>Account</title>
                                                <path
                                                    d="M41.2452,33.0349a16,16,0,1,0-18.49,0A26.0412,26.0412,0,0,0,4,58a2,2,0,0,0,2,2H58a2,2,0,0,0,2-2A26.0412,26.0412,0,0,0,41.2452,33.0349ZM20,20A12,12,0,1,1,32,32,12.0137,12.0137,0,0,1,20,20ZM8.09,56A22.0293,22.0293,0,0,1,30,36h4A22.0293,22.0293,0,0,1,55.91,56Z">
                                                </path>
                                            </svg>
                                        </span>
                                    </button>

                                    <ul class="dropdown-menu dropdown-menu-{{ Session::get('direction') === 'rtl' ? 'start' : 'end' }}"
                                        aria-labelledby="guestDropdown">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('customer.auth.login') }}">
                                                <i class="fa fa-sign-in me-2"></i>
                                                {{ translate('customer_login') }}
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('vendor.auth.login') }}">
                                                <i class="fa fa-user-circle me-2"></i>
                                                {{ translate('vendor_login') }}
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            @endif


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
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 17 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
                            </svg>
                        </button>
                    </div>
                    <div class="  menu_list">
                        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1"
                            id="navbar-search">
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
                                    class="flex flex-col p-2 md:p-0 font-medium rounded-lg   rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 ">
                                    <li class="block py-2    rounded-sm md:bg-transparent">
                                        <a href="{{ route('home') }}" class="  b px-5">{{ translate('home') }}</a>
                                    </li>
                                    <li class="block py-2    rounded-sm md:bg-transparent">
                                        <a href="{{ route('home') }}#new-arrival-section"
                                            class=" px-5">{{ translate('New Arrivals') }}</a>
                                    </li>
                                    @if ($web_config['featured_deals'] && count($web_config['featured_deals']) > 0)
                                        <li class="block py-2    rounded-sm md:bg-transparent">
                                            <a href="{{ route('home') }}#featured_deal"
                                                class=" px-5">{{ translate('Featured Deal') }}</a>
                                        </li>
                                    @endif


                                </ul>
                            </div>
                            <div class="w-[350px]">

                                <form class="w-full" method="GET" action="{{ route('products') }}">
                                    <div class="flex border-2 shadow-sm rounded-lg relative">
                                        <!-- Dropdown Trigger -->
                                        <button id="dropdown-button" data-dropdown-toggle="dropdown"
                                            class="box_shadow_none shrink-0 z-30 inline-flex items-center py-2.5 px-4 text-[12px] font-medium text-center text-[#504444] bg-white border-r border-gray-300 rounded-s-lg focus:ring-4 focus:outline-none"
                                            type="button">
                                            All Categories
                                            <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" fill="none"
                                                viewBox="0 0 10 6">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"></path>
                                            </svg>
                                        </button>

                                        <!-- Hidden Dropdown List -->
                                        <div id="dropdown"
                                            class="z-40 bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 hidden absolute top-full mt-1 left-0"
                                            aria-labelledby="dropdown-button">
                                            <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdown-button">
                                                <li>
                                                    <button type="submit" name="category" value=""
                                                        class="inline-flex w-full px-4 py-2 hover:bg-gray-100">
                                                        All Categories
                                                    </button>
                                                </li>
                                                @foreach ($categories as $category)
                                                    <li>
                                                        <button type="submit" name="category"
                                                            value="{{ $category->id }}"
                                                            class="inline-flex w-full px-4 py-2 hover:bg-gray-100">
                                                            {{ $category->name }}
                                                        </button>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>

                                        <!-- Search Input -->
                                        <div class="relative w-full">
                                            <input type="search" name="search" id="search-dropdown"
                                                class="block p-2.5 w-full z-20 text-sm text-[#504444] bg-white rounded-e-lg border-none text-[12px]"
                                                placeholder="Search Item.." value="{{ request('search') }}">
                                            <button type="submit"
                                                class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
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