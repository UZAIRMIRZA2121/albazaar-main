<!DOCTYPE html>
<!-- <html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}" data-preline> -->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-preline>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Albazar') </title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Flowbite CSS & JS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <!-- Preline JS -->
    <script src="https://cdn.jsdelivr.net/npm/preline@latest/dist/preline.js"></script>
    <!-- flowbite Plugin -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <!-- Material Tailwind -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.13/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://unpkg.com/@material-tailwind/html@3.0.0-beta.7/dist/material-tailwind.umd.min.js"></script>
    <!-- Custom Css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <!-- Alpine.js include (add this in your <head> if not already) -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <style>
        body {
            background-color: white;
        }
    </style>

    <style>
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

        @media (min-width: 768px) {
            .owl-prev {
                left: -50px;
                display: none !important;
            }

            .owl-next {
                right: -50px;
                display: none !important;
            }

        }

        @media (max-width: 768px) {
            .owl-prev {
                display: none !important;
            }

            .owl-next {
                display: none !important;
            }

        }

        .carousel-five .owl-nav .owl-prev {
            position: absolute;
            top: 51%;
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

        .carousel-five .owl-nav .owl-next {
            position: absolute;
            top: 51%;
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


        .carousel-nine .owl-nav .owl-prev {
            position: absolute;
            top: 51%;
            /* transform: translateY(-50%); */
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

        .carousel-nine .owl-nav .owl-next {
            position: absolute;
            top: 51%;
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




        .carousel-one .owl-nav .owl-prev {
            position: absolute;
            top: 51%;
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

        .carousel-one .owl-nav .owl-next {
            position: absolute;
            top: 51%;
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






        /* Always show arrows and dots */
        .owl-carousel .owl-nav,
        .owl-carousel .owl-dots {
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
        }
    </style>
    <!-- Tailwind Animations slider -->
    <style>
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
                /* or block */
            }
        }
    </style>

</head>

<body>
    <!-- Main Content -->
    @include('layouts.front-end.partials._header')
    {{-- @include('layouts.front-end.partials._alert-message') --}}
    <main>
        @yield('content')
    </main>
    <!-- footer -->
 

    @include('layouts.front-end.partials._footer')

</body>

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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
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

{{-- OwlCarousel2 --}}


</html>
