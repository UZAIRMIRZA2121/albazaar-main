<!DOCTYPE html>
<!-- <html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}" data-preline> -->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-preline>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{ csrf_token() }}">
    <meta name="robots" content="index, follow">
    <meta property="og:site_name" content="{{ $web_config['company_name'] }}" />

    <meta name="google-site-verification" content="{{ getWebConfig('google_search_console_code') }}">
    <meta name="msvalidate.01" content="{{ getWebConfig('bing_webmaster_code') }}">
    <meta name="baidu-site-verification" content="{{ getWebConfig('baidu_webmaster_code') }}">
    <meta name="yandex-verification" content="{{ getWebConfig('yandex_webmaster_code') }}">
    <!-- Bootstrap JS (v5) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <title>@yield('title', 'Albazar')</title>

    <link rel="apple-touch-icon" sizes="180x180" href="{{ $web_config['fav_icon']['path'] }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ $web_config['fav_icon']['path'] }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100..900&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Flowbite -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

    <!-- Material Tailwind -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.13/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://unpkg.com/@material-tailwind/html@3.0.0-beta.7/dist/material-tailwind.umd.min.js"></script>

    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <!-- Theme Assets -->
    <link rel="stylesheet" media="screen"
        href="{{ theme_asset(path: 'public/assets/front-end/vendor/simplebar/dist/simplebar.min.css') }}">
    <link rel="stylesheet" media="screen"
        href="{{ theme_asset(path: 'public/assets/front-end/vendor/tiny-slider/dist/tiny-slider.css') }}">
    <link rel="stylesheet" media="screen"
        href="{{ theme_asset(path: 'public/assets/front-end/vendor/drift-zoom/dist/drift-basic.min.css') }}">
    <link rel="stylesheet" media="screen"
        href="{{ theme_asset(path: 'public/assets/front-end/vendor/lightgallery.js/dist/css/lightgallery.min.css') }}">
    <link rel="stylesheet" media="screen"
        href="{{ theme_asset(path: 'public/assets/front-end/css/theme.css?v1.0.1') }}">
    <link rel="stylesheet" href="{{ theme_asset(path: 'public/assets/front-end/css/slick.css') }}">
    <link rel="stylesheet" href="{{ theme_asset(path: 'public/assets/front-end/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ theme_asset(path: 'public/assets/back-end/css/toastr.css') }}">
    <link rel="stylesheet" href="{{ theme_asset(path: 'public/assets/front-end/css/master.css') }}">
    <link rel="stylesheet" href="{{ theme_asset(path: 'public/assets/front-end/css/roboto-font.css') }}">
    <link rel="stylesheet" href="{{ theme_asset(path: 'public/css/lightbox.css') }}">
    <link rel="stylesheet" href="{{ theme_asset(path: 'public/assets/back-end/vendor/icon-set/style.css') }}">
    <link rel="stylesheet" href="{{ theme_asset(path: 'public/assets/front-end/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ theme_asset(path: 'public/assets/front-end/css/home.css') }}">
    <link rel="stylesheet" href="{{ theme_asset(path: 'public/assets/front-end/css/responsive1.css') }}">
    <link rel="stylesheet" href="{{ theme_asset(path: 'public/assets/front-end/css/style.css') }}">
    <link rel="stylesheet" href="{{ theme_asset(path: 'public/assets/front-end/css/custom.css?v1.0.1') }}">

    @stack('css_or_js')
    @include(VIEW_FILE_NAMES['robots_meta_content_partials'])

    <!-- jQuery & JS Libraries -->
    <script src="{{ theme_asset(path: 'public/assets/front-end/vendor/jquery/dist/jquery-2.2.4.min.js') }}"></script>
    <script src="{{ theme_asset(path: 'public/assets/front-end/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}">
    </script>
    <script
        src="{{ theme_asset(path: 'public/assets/front-end/vendor/bs-custom-file-input/dist/bs-custom-file-input.min.js') }}">
    </script>
    <script src="{{ theme_asset(path: 'public/assets/front-end/vendor/simplebar/dist/simplebar.min.js') }}"></script>
    <script src="{{ theme_asset(path: 'public/assets/front-end/vendor/tiny-slider/dist/min/tiny-slider.js') }}"></script>
    <script src="{{ theme_asset(path: 'public/assets/front-end/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js') }}">
    </script>
    <script src="{{ theme_asset(path: 'public/js/lightbox.min.js') }}"></script>
    <script src="{{ theme_asset(path: 'public/assets/front-end/vendor/drift-zoom/dist/Drift.min.js') }}"></script>
    <script src="{{ theme_asset(path: 'public/assets/front-end/vendor/lightgallery.js/dist/js/lightgallery.min.js') }}">
    </script>
    <script src="{{ theme_asset(path: 'public/assets/front-end/vendor/lg-video.js/dist/lg-video.min.js') }}"></script>
    <script src="{{ theme_asset(path: 'public/assets/front-end/js/owl.carousel.min.js') }}"></script>
    <script src="{{ theme_asset(path: 'public/assets/front-end/js/theme.js') }}"></script>
    <script src="{{ theme_asset(path: 'public/assets/front-end/js/slick.js') }}"></script>
    <script src="{{ theme_asset(path: 'public/assets/front-end/js/sweet_alert.js') }}"></script>
    <script src="{{ theme_asset(path: 'public/assets/back-end/js/toastr.js') }}"></script>
    <script src="{{ theme_asset(path: 'public/assets/front-end/js/custom.js') }}"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Inline Styles -->
    <style>
        body {
            background-color: white;
        }

        .owl-prev,
        .owl-next {
            position: absolute;
            top: 35%;
            transform: translateY(-50%);
            background: #C7C2C2 !important;
            color: #ffffff !important;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center !important;
            justify-content: center !important;
            cursor: pointer !important;
            font-size: 20px !important;
        }

        .owl-prev {
            left: -15px;
        }

        .owl-next {
            right: -15px;
        }

        @media (min-width: 768px),
        (max-width: 768px) {

            .owl-prev,
            .owl-next {
                display: none !important;
            }
        }

        .owl-carousel .owl-nav,
        .owl-carousel .owl-dots {
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
        }

        .menu_list_mobile {
            display: none;
        }

        .menu_list {
            display: block;
        }

        @media (max-width: 1460px) {
            .menu_list {
                display: none !important;
            }

            .menu_list_mobile {
                display: flex !important;
            }
        }

        #loading {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(255, 255, 255, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }

        .d--none {
            display: none !important;
        }

        :root {
            --base: {{ $web_config['primary_color'] }};
            --base-2: {{ $web_config['secondary_color'] }};
            --web-primary: {{ $web_config['primary_color'] }};
            --web-primary-10: {{ $web_config['primary_color'] }}10;
            --web-primary-20: {{ $web_config['primary_color'] }}20;
            --web-primary-40: {{ $web_config['primary_color'] }}40;
            --web-secondary: {{ $web_config['secondary_color'] }};
            --web-direction: {{ Session::get('direction') }};
            --text-align-direction: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};
            --text-align-direction-alt: {{ Session::get('direction') === 'rtl' ? 'left' : 'right' }};
        }

        .dropdown-menu:not(.m-0) {
            margin-{{ Session::get('direction') === 'rtl' ? 'right' : 'left' }}: -8px !important;
        }

        @media (max-width: 767px) {
            .navbar-expand-md .dropdown-menu>.dropdown>.dropdown-toggle {
                padding-{{ Session::get('direction') === 'rtl' ? 'left' : 'right' }}: 1.95rem;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 1s ease-in-out;
        }
    </style>

    <!-- Google Tag Manager -->
    @php($google_tag_manager_id = getWebConfig(name: 'google_tag_manager_id'))
    @if ($google_tag_manager_id)
        <script>
            try {
                (function(w, d, s, l, i) {
                    w[l] = w[l] || [];
                    w[l].push({
                        'gtm.start': new Date().getTime(),
                        event: 'gtm.js'
                    });
                    var f = d.getElementsByTagName(s)[0],
                        j = d.createElement(s),
                        dl = l != 'dataLayer' ? '&l=' + l : '';
                    j.async = true;
                    j.src = 'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
                    f.parentNode.insertBefore(j, f);
                })(window, document, 'script', 'dataLayer', '{{ $google_tag_manager_id }}');
            } catch (e) {
                console.log(e)
            }
        </script>
    @endif

    <!-- Facebook Pixel -->
    @php($pixel_analytics_user_code = getWebConfig(name: 'pixel_analytics'))
    @if ($pixel_analytics_user_code)
        <script>
            ! function(f, b, e, v, n, t, s) {
                if (f.fbq) return;
                n = f.fbq = function() {
                    n.callMethod ?
                        n.callMethod.apply(n, arguments) : n.queue.push(arguments)
                };
                if (!f._fbq) f._fbq = n;
                n.push = n;
                n.loaded = !0;
                n.version = '2.0';
                n.queue = [];
                t = b.createElement(e);
                t.async = !0;
                t.src = v;
                s = b.getElementsByTagName(e)[0];
                s.parentNode.insertBefore(t, s)
            }(window, document, 'script', 'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '{{ $pixel_analytics_user_code }}');
            fbq('track', 'PageView');
        </script>
        <noscript>
            <img height="1" width="1" style="display:none"
                src="https://www.facebook.com/tr?id={{ $pixel_analytics_user_code }}&ev=PageView&noscript=1" />
        </noscript>
    @endif
</head>


<body>
    <!-- Main Content -->
    @include('layouts.front-end.partials._header')
    {{-- @include('layouts.front-end.partials._alert-message') --}}

    <div id="loading" class="d--none">
        <div class="text-center">
            <img width="200" alt=""
                src="{{ getStorageImages(path: getWebConfig(name: 'loader_gif'), type: 'source', source: theme_asset(path: 'public/assets/front-end/img/loader.gif')) }}">
        </div>
    </div>



    <main>
        @yield('content')
    </main>
    <!-- footer -->





    <span id="message-otp-sent-again" data-text="{{ translate('OTP_has_been_sent_again.') }}"></span>
    <span id="message-wait-for-new-code" data-text="{{ translate('please_wait_for_new_code.') }}"></span>
    <span id="message-please-check-recaptcha" data-text="{{ translate('please_check_the_recaptcha.') }}"></span>
    <span id="message-please-retype-password" data-text="{{ translate('please_ReType_Password') }}"></span>
    <span id="message-password-not-match" data-text="{{ translate('password_do_not_match') }}"></span>
    <span id="message-password-match" data-text="{{ translate('password_match') }}"></span>
    <span id="message-password-need-longest" data-text="{{ translate('password_Must_Be_6_Character') }}"></span>
    <span id="message-send-successfully" data-text="{{ translate('send_successfully') }}"></span>
    <span id="message-update-successfully" data-text="{{ translate('update_successfully') }}"></span>
    <span id="message-successfully-copied" data-text="{{ translate('successfully_copied') }}"></span>
    <span id="message-copied-failed" data-text="{{ translate('copied_failed') }}"></span>
    <span id="message-select-payment-method" data-text="{{ translate('please_select_a_payment_Methods') }}"></span>
    <span id="message-please-choose-all-options" data-text="{{ translate('please_choose_all_the_options') }}"></span>
    <span id="message-cannot-input-minus-value" data-text="{{ translate('cannot_input_minus_value') }}"></span>
    <span id="message-all-input-field-required" data-text="{{ translate('all_input_field_required') }}"></span>
    <span id="message-no-data-found" data-text="{{ translate('no_data_found') }}"></span>
    <span id="message-minimum-order-quantity-cannot-less-than"
        data-text="{{ translate('minimum_order_quantity_cannot_be_less_than_') }}"></span>
    <span id="message-item-has-been-removed-from-cart"
        data-text="{{ translate('item_has_been_removed_from_cart') }}"></span>
    <span id="message-sorry-stock-limit-exceeded" data-text="{{ translate('sorry_stock_limit_exceeded') }}"></span>
    <span id="message-sorry-the-minimum-order-quantity-not-match"
        data-text="{{ translate('sorry_the_minimum_order_quantity_does_not_match') }}"></span>
    <span id="message-cart" data-text="{{ translate('cart') }}"></span>

    <span id="route-messages-store" data-url="{{ route('messages') }}"></span>
    <span id="route-address-update" data-url="{{ route('address-update') }}"></span>
    <span id="route-coupon-apply" data-url="{{ route('coupon.apply') }}"></span>
    <span id="route-cart-add" data-url="{{ route('cart.add') }}"></span>
    <span id="route-cart-remove" data-url="{{ route('cart.remove') }}"></span>
    <span id="route-cart-variant-price" data-url="{{ route('cart.variant_price') }}"></span>
    <span id="route-cart-nav-cart" data-url="{{ route('cart.nav-cart') }}"></span>
    <span id="route-cart-order-again" data-url="{{ route('cart.order-again') }}"></span>
    <span id="route-cart-updateQuantity" data-url="{{ route('cart.updateQuantity') }}"></span>
    <span id="route-cart-updateQuantity-guest" data-url="{{ route('cart.updateQuantity.guest') }}"></span>
    <span id="route-pay-offline-method-list" data-url="{{ route('pay-offline-method-list') }}"></span>
    <span id="route-customer-auth-sign-up" data-url="{{ route('customer.auth.sign-up') }}"></span>
    <span id="route-searched-products" data-url="{{ url('/searched-products') }}"></span>
    <span id="route-currency-change" data-url="{{ route('currency.change') }}"></span>
    <span id="route-store-wishlist" data-url="{{ route('store-wishlist') }}"></span>
    <span id="route-delete-wishlist" data-url="{{ route('delete-wishlist') }}"></span>
    <span id="route-wishlists" data-url="{{ route('wishlists') }}"></span>
    <span id="route-quick-view" data-url="{{ route('quick-view') }}"></span>
    <span id="route-checkout-details" data-url="{{ route('checkout-details') }}"></span>
    <span id="route-checkout-payment" data-url="{{ route('checkout-payment') }}"></span>
    <span id="route-set-shipping-id" data-url="{{ route('customer.set-shipping-method') }}"></span>
    <span id="route-order-note" data-url="{{ route('order_note') }}"></span>
    <span id="route-product-restock-request" data-url="{{ route('cart.product-restock-request') }}"></span>
    <span id="route-get-session-recaptcha-code" data-route="{{ route('get-session-recaptcha-code') }}"
        data-mode="{{ env('APP_MODE') }}"></span>
    <span id="password-error-message" data-max-character="{{ translate('at_least_8_characters') . '.' }}"
        data-uppercase-character="{{ translate('at_least_one_uppercase_letter_') . '(A...Z)' . '.' }}"
        data-lowercase-character="{{ translate('at_least_one_uppercase_letter_') . '(a...z)' . '.' }}"
        data-number="{{ translate('at_least_one_number') . '(0...9)' . '.' }}"
        data-symbol="{{ translate('at_least_one_symbol') . '(!...%)' . '.' }}"></span>
    <span class="system-default-country-code" data-value="{{ getWebConfig(name: 'country_code') ?? 'us' }}"></span>
    <span id="system-session-direction" data-value="{{ session()->get('direction') ?? 'ltr' }}"></span>

    <span id="is-request-customer-auth-sign-up"
        data-value="{{ Request::is('customer/auth/sign-up*') ? 1 : 0 }}"></span>
    <span id="is-customer-auth-active" data-value="{{ auth('customer')->check() ? 1 : 0 }}"></span>

    <span id="storage-flash-deals" data-value="{{ $web_config['flash_deals']['start_date'] ?? '' }}"></span>





    @include('layouts.front-end.partials._footer')



    <!--  jQuery UI CSS (for UI components like datepicker) -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <!--  jQuery (should be loaded first before any JS depending on it) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <!--  Flowbite JS (for Tailwind components like modals, tooltips) -->
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>

    <!--  Preline JS (for additional UI components like dropdowns, modals) -->
    <script src="https://cdn.jsdelivr.net/npm/preline@latest/dist/preline.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>


    <!--  Your Custom JS Files (Project-specific functionality) -->
    <script src="{{ asset('admin/js/javascript.js') }}"></script>
    <script src="{{ asset('intl-tel-input-master/build/js/intlTelInputWithUtils.js') }}"></script>



    {{-- AIpine.Js --}}
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    {{-- AIpine.Js --}}
    {{-- OwlCarousel2 --}}
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="{{ theme_asset(path: 'public/assets/front-end/vendor/jquery/dist/jquery-2.2.4.min.js') }}"></script>
    <script src="{{ theme_asset(path: 'public/assets/front-end/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}">
    </script>
    <script
        src="{{ theme_asset(path: 'public/assets/front-end/vendor/bs-custom-file-input/dist/bs-custom-file-input.min.js') }}">
    </script>
    <script src="{{ theme_asset(path: 'public/assets/front-end/vendor/simplebar/dist/simplebar.min.js') }}"></script>
    <script src="{{ theme_asset(path: 'public/assets/front-end/vendor/tiny-slider/dist/min/tiny-slider.js') }}"></script>
    <script
        src="{{ theme_asset(path: 'public/assets/front-end/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js') }}">
    </script>
    <script src="{{ theme_asset(path: 'public/js/lightbox.min.js') }}"></script>
    <script src="{{ theme_asset(path: 'public/assets/front-end/vendor/drift-zoom/dist/Drift.min.js') }}"></script>
    <script src="{{ theme_asset(path: 'public/assets/front-end/vendor/lightgallery.js/dist/js/lightgallery.min.js') }}">
    </script>
    <script src="{{ theme_asset(path: 'public/assets/front-end/vendor/lg-video.js/dist/lg-video.min.js') }}"></script>
    <script src="{{ theme_asset(path: 'public/assets/front-end/js/owl.carousel.min.js') }}"></script>
    <script src="{{ theme_asset(path: 'public/assets/back-end/js/toastr.js') }}"></script>
    <script src="{{ theme_asset(path: 'public/assets/front-end/js/theme.js') }}"></script>
    <script src="{{ theme_asset(path: 'public/assets/front-end/js/slick.js') }}"></script>
    <script src="{{ theme_asset(path: 'public/assets/front-end/js/sweet_alert.js') }}"></script>
    <script src="{{ theme_asset(path: 'public/assets/back-end/js/toastr.js') }}"></script>
    <script src="{{ theme_asset(path: 'public/assets/front-end/js/custom.js') }}"></script>
    {!! Toastr::message() !!}







    <script>
        $(document).ready(function() {
            // 7 items wale carousel ke liye
            $(".carousel-seven").owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                dots: false,
                navText: ["<", ">"],
                responsive: {
                    0: {
                        items: 1 // Mobile (0px - 600px) -> 2 items
                    },
                    600: {
                        items: 3 // Tablets (600px - 1000px) -> 3 items
                    },
                    1000: {
                        items: 5 // Desktop (1000px+) -> 6 items
                    }
                }
            });
            // 6 items wale carousel ke liye
            $(".carousel-five").owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                dots: false,
                navText: ["<", ">"],
                responsive: {
                    0: {
                        items: 1 // Mobile (0px - 600px) -> 2 items
                    },
                    600: {
                        items: 1 // Tablets (600px - 1000px) -> 3 items
                    },
                    1000: {
                        items: 1 // Desktop (1000px+) -> 6 items
                    }
                }
            });
            // 6 items wale carousel ke liye
            $(".carousel-nine").owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                dots: false,
                navText: ["<", ">"],
                responsive: {
                    0: {
                        items: 1 // Mobile (0px - 600px) -> 2 items
                    },
                    600: {
                        items: 3 // Tablets (600px - 1000px) -> 3 items
                    },
                    1000: {
                        items: 6 // Desktop (1000px+) -> 6 items
                    }
                }
            });

            // $('.carousel-five').owlCarousel({
            //     loop:true,
            //     margin:10,
            //     responsiveClass:true,
            //     responsive:{
            //         0:{
            //             items:1,
            //             nav:true
            //         },
            //         600:{
            //             items:3,
            //             nav:false
            //         },
            //         1000:{
            //             items:5,
            //             nav:true,
            //             loop:false
            //         }
            //     }
            // })


            // 3 items wale carousel ke liye
            $(".carousel-one").owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                dots: false,
                navText: ["<", ">"],
                responsive: {
                    0: {
                        items: 1 // Mobile (0px - 600px) -> 2 items
                    },
                    600: {
                        items: 1 // Tablets (600px - 1000px) -> 3 items
                    },
                    1000: {
                        items: 1 // Desktop (1000px+) -> 6 items
                    }
                }
            });

            // 2 items wale carousel ke liye
            // $(".carousel-two").owlCarousel({
            //     loop: true,
            //     margin: 10,
            //     nav: true,
            //     dots: false,
            //     navText: ["<", ">"],
            //     responsive: {
            //         0: {
            //             items: 1  // Mobile (0px - 600px) -> 2 items
            //         },
            //         600: {
            //             items: 2  // Tablets (600px - 1000px) -> 3 items
            //         },
            //         1000: {
            //             items: 2  // Desktop (1000px+) -> 6 items
            //         }
            //     }
            // });
        });
    </script>

    <script>
        $(document).ready(function() {
            $(".carousel-six").owlCarousel({
                loop: true,
                margin: 25,
                nav: false,
                dots: true,
                autoplay: true,
                autoplayTimeout: 3000,
                responsive: {
                    0: {
                        items: 1
                    },
                    640: {
                        items: 2
                    },
                    768: {
                        items: 3
                    },
                    1024: {
                        items: 4
                    }
                }
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            $(".carousel-six2").owlCarousel({
                loop: true,
                margin: 25,
                nav: false,
                dots: true,
                autoplay: true,
                autoplayTimeout: 3000,
                responsive: {
                    0: {
                        items: 1
                    },
                    640: {
                        items: 2
                    },
                    768: {
                        items: 3
                    },
                    1024: {
                        items: 4
                    }
                }
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            $(".carousel-six3").owlCarousel({
                loop: true,
                margin: 25,
                nav: false,
                dots: true,
                autoplay: true,
                autoplayTimeout: 3000,
                responsive: {
                    0: {
                        items: 1
                    },
                    640: {
                        items: 2
                    },
                    768: {
                        items: 3
                    },
                    1024: {
                        items: 4
                    }
                }
            });
        });
    </script>

    <script>
        "use strict";

        @if (Request::is('/') && \Illuminate\Support\Facades\Cookie::has('popup_banner') == false)
            $(document).ready(function() {
                $('#popup-modal').modal('show');
            });
            @php(\Illuminate\Support\Facades\Cookie::queue('popup_banner', 'off', 1))
        @endif

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error('{{ $error }}', Error, {
                    CloseButton: true,
                    ProgressBar: true
                });
            @endforeach
        @endif

        $(document).mouseup(function(e) {
            let container = $(".search-card");
            if (!container.is(e.target) && container.has(e.target).length === 0) {
                container.hide();
            }
        });

        function route_alert(route, message) {
            Swal.fire({
                title: '{{ translate('are_you_sure') }}?',
                text: message,
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: 'default',
                confirmButtonColor: '{{ $web_config['primary_color'] }}',
                cancelButtonText: '{{ translate('no') }}',
                confirmButtonText: '{{ translate('yes') }}',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    location.href = route;
                }
            })
        }

        @php($cookie = $web_config['cookie_setting'] ? json_decode($web_config['cookie_setting']['value'], true) : null)
        let cookie_content = `
        <div class="cookie-section">
            <div class="container">
                <div class="d-flex flex-wrap align-items-center justify-content-between column-gap-4 row-gap-3">
                    <div class="text-wrapper">
                        <h5 class="title">{{ translate('Your_Privacy_Matter') }}</h5>
                        <div>{{ $cookie ? $cookie['cookie_text'] : '' }}</div>
                    </div>
                    <div class="btn-wrapper">
                        <button class="btn bg-dark text-white cursor-pointer" id="cookie-reject">{{ translate('no_thanks') }}</button>
                        <button class="btn btn-success cookie-accept" id="cookie-accept">{{ translate('i_Accept') }}</button>
                    </div>
                </div>
            </div>
        </div>
    `;
        $(document).on('click', '#cookie-accept', function() {
            document.cookie = '6valley_cookie_consent=accepted; max-age=' + 60 * 60 * 24 * 30;
            $('#cookie-section').hide();
        });
        $(document).on('click', '#cookie-reject', function() {
            document.cookie = '6valley_cookie_consent=reject; max-age=' + 60 * 60 * 24;
            $('#cookie-section').hide();
        });

        $(document).ready(function() {
            if (document.cookie.indexOf("6valley_cookie_consent=accepted") !== -1) {
                $('#cookie-section').hide();
            } else {
                $('#cookie-section').html(cookie_content).show();
            }
        });
    </script>
    @if (env('APP_MODE') == 'demo')
        <script>
            'use strict'

            function checkDemoResetTime() {
                let currentMinute = new Date().getMinutes();
                if (currentMinute > 55 && currentMinute <= 60) {
                    $('#demo-reset-warning').addClass('active');
                } else {
                    $('#demo-reset-warning').removeClass('active');
                }
            }
            checkDemoResetTime();
            setInterval(checkDemoResetTime, 60000);
        </script>
    @endif
    <script>
        $(document).on('click', '.call-when-done', function() {
            $(this).closest('.modal').modal('hide');
        });
    </script>


    @stack('script')

    {{-- OwlCarousel2 --}}
</body>

</html>
