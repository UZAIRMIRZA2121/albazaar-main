<div class="__inline-9 rtl">
    <div class="text-center pb-4">
        <div class="max-w-860px mx-auto footer-slider-container">
            <div class="container">
                <div class="footer-slider owl-theme owl-carousel">
                    <div class="footer-slide-item">
                        <div>
                            <a href="{{ route('about-us') }}">
                                <div class="text-center text-primary">
                                    <img class="object-contain svg" width="36" height="36"
                                        src="{{ theme_asset(path: 'public/assets/front-end/img/icons/about-us.svg') }}"
                                        alt="">
                                </div>
                                <div class="text-center">
                                    <p class="m-0 mt-2">
                                        {{ translate('about_us') }}
                                    </p>
                                    <small
                                        class="d-none d-sm-block">{{ translate('Know_about_our_company_more.') }}</small>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="footer-slide-item">
                        <div>
                            <a href="{{ route('contacts') }}">
                                <div class="text-center text-primary">
                                    <img class="object-contain svg" width="36" height="36"
                                        src="{{ theme_asset(path: 'public/assets/front-end/img/icons/contact-us.svg') }}"
                                        alt="">
                                </div>
                                <div class="text-center">
                                    <p class="m-0 mt-2">
                                        {{ translate('contact_Us') }}
                                    </p>
                                    <small class="d-none d-sm-block">{{ translate('We_are_Here_to_Help') }}</small>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="footer-slide-item">
                        <div>
                            <a href="{{ route('helpTopic') }}">
                                <div class="text-center text-primary">
                                    <img class="object-contain svg" width="36" height="36"
                                        src="{{ theme_asset(path: 'public/assets/front-end/img/icons/faq-icon.svg') }}"
                                        alt="">
                                </div>
                                <div class="text-center">
                                    <p class="m-0 mt-2">
                                        {{ translate('FAQ') }}
                                    </p>
                                    <small class="d-none d-sm-block">{{ translate('Get_all_Answers') }}</small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="page-footer" style="background-color: white; color: black;">
        <div class="container pt-4 pb-2">
            <div class="row">
                <!-- Brand Column -->
                <div class="col-md-3 mb-4 text-center">

                    <!-- Logo (optional to keep above) -->
                    <a class="navbar-brand d-none d-sm-block me-3 flex-shrink-0" href="{{ route('home') }}">
                        <img src="{{ asset('public/images/albazar-logo.png') }}" class="img-fluid mb-3"
                            style="max-height:70px;" alt="logo">
                    </a>

                    <!-- Follow Us -->
                    <h6 class="mb-3">Follow us</h6>

                    <div class="social-icons d-flex justify-content-center">
                        <a href="#" class="social-icon facebook mx-2">
                            <i class="bi bi-facebook fs-5"></i>
                        </a>
                        <a href="#" class="social-icon twitter mx-2">
                            <i class="bi bi-twitter fs-5"></i>
                        </a>
                        <a href="#" class="social-icon instagram mx-2">
                            <i class="bi bi-instagram fs-5"></i>
                        </a>
                        <a href="#" class="social-icon linkedin mx-2">
                            <i class="bi bi-linkedin fs-5"></i>
                        </a>
                    </div>

                </div>

                <!-- Add this in your head section if not already present -->
                <link rel="stylesheet"
                    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

                <style>
                    /* Updated Social Icons Styles */
                    .social-icons {
                        display: flex;
                        align-items: center;
                        flex-wrap: wrap;
                        gap: 8px;

                    }

                    .social-icon {
                        display: inline-flex;
                        align-items: center;
                        justify-content: center;
                        width: 36px;
                        height: 36px;
                        border-radius: 50%;
                        color: white;
                        font-size: 16px;
                        transition: all 0.3s;

                    }



                    .social-icon:hover {
                        transform: translateY(-3px);
                        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                        opacity: 0.9;
                    }
                </style>

                <!-- Rest of your footer columns remain the same -->
                <!-- Customers Care Column -->
                <div class="col-md-2 mb-4">
                    <h6 class="text-uppercase font-weight-bold">Customers Care</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-dark">Contact Us</a></li>
                        <li class="mb-2"><a href="#" class="text-dark">Customers FAQ</a></li>
                        <li class="mb-2"><a href="#" class="text-dark">Customer Terms and Conditions</a></li>
                        <li class="mb-2"><a href="#" class="text-dark">Privacy Policy</a></li>
                        <li><a href="#" class="text-dark">Return Policy</a></li>
                    </ul>
                </div>

                <!-- Sell on Albazar Column -->
                <div class="col-md-2 mb-4">
                    <h6 class="text-uppercase font-weight-bold">Sell on Albazar</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-dark">Join albazar</a></li>
                        <li class="mb-2"><a href="#" class="text-dark">Seller FAQ</a></li>
                        <li class="mb-2"><a href="#" class="text-dark">Seller Terms and Conditions</a></li>
                        <li><a href="#" class="text-dark">What to sell on albazar?</a></li>
                    </ul>
                </div>

                <!-- Contact Us Column -->
                <div class="col-md-2 mb-4">
                    <h6 class="text-uppercase font-weight-bold">Contact Us</h6>
                    <address class="text-dark">
                        <p class="mb-2">8086 Green Lake Drive</p>
                        <p class="mb-2">Chewy Chore, MD 20815</p>
                        <p class="mb-2">+391 (0)35 2568 4583</p>
                        <p><a href="mailto:support@albazar.sa" class="text-dark">support@albazar.sa</a></p>
                    </address>
                </div>

                <!-- Developed By Column -->
                <div class="col-md-2 mb-4">
                    <h6 class="text-uppercase font-weight-bold">Developed by</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2">TRANSCHID</li>
                        <li class="mb-2">DESIGNED BY</li>
                        <li class="mb-2">YAM Creative</li>
                        <li class="mb-2">Alther AlShamdi</li>
                        <li class="mb-2">Harry Saggai</li>
                        <li>Erico Design</li>
                    </ul>
                </div>
            </div>

            <!-- Copyright and App/Payment Section -->
            <div class="row pt-3 border-top">
                <div class="col-md-4 text-center text-md-start mb-3 mb-md-0">
                    <p class="mb-0">Copyright © {{ date('Y') }} Albazar. All Rights Reserved.</p>
                </div>
                <div class="col-md-4 text-center mb-3 mb-md-0">
                    <div class="d-flex justify-content-center align-items-center gap-2">
                        <a href="#" class="app-download-btn">
                            <img src="{{ asset('images/app-store.png') }}" alt="App Store" class="img-fluid"
                                style="height: 40px;">
                        </a>
                        <a href="#" class="app-download-btn">
                            <img src="{{ asset('images/google-play.png') }}" alt="Google Play" class="img-fluid"
                                style="height: 40px;">
                        </a>
                    </div>
                </div>

                <style>
                    .app-download-btn {
                        display: inline-block;
                        transition: all 0.3s ease;
                        border-radius: 8px;
                        padding: 0;
                        border: none;
                        background: transparent;
                    }

                    .app-download-btn:hover {
                        transform: translateY(-2px);
                        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                    }

                    .app-download-btn img {
                        border-radius: 8px;
                    }
                </style>

                <div class="col-md-4 text-center text-md-end">
                    <img src="{{ asset('images/payment-methods.png') }}" alt="Payment Methods" class="img-fluid"
                        style="max-height: 30px;">
                </div>
            </div>
        </div>
    </footer>

    <style>
        /* Footer Styles */
        .page-footer {
            padding: 2rem 0;
            font-family: 'Arial', sans-serif;
        }

        .page-footer h6 {
            font-size: 1rem;
            margin-bottom: 1rem;
            letter-spacing: 0.5px;
        }

        .page-footer a {
            text-decoration: none;
            transition: color 0.3s;
        }

        .page-footer a:hover {
            color: #007bff !important;
        }

        /* Social Icons */
        .social-icons {
            display: flex;
            align-items: center;
        }

        .social-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            color: white;
            font-size: 16px;
            transition: all 0.3s;
        }

        .social-icon.facebook {
            background-color: #3b5998;
        }

        .social-icon.twitter {
            background-color: #1da1f2;
        }

        .social-icon.instagram {
            background-color: #e1306c;
        }

        .social-icon.linkedin {
            background-color: #0077b5;
        }

        .social-icon:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* App Buttons */
        .btn-outline-dark {
            border-color: #333;
            color: #333;
        }

        .btn-outline-dark:hover {
            background-color: #333;
            color: white;
        }
    </style>
</div>
