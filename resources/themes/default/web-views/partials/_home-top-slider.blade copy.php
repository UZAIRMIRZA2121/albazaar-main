@if (count($bannerTypeMainBanner) > 0)
<section class="py-5">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        .hero-carousel {
            background: linear-gradient(to right, #fff5f0, #fefaf6);
            border-radius: 20px;
            padding: 40px 20px;
            overflow: hidden;
        }

        .hero-text h1 {
            font-size: 2.5rem;
            font-weight: 700;
            line-height: 1.2;
        }

        .hero-text h1 span {
            color: #f54a05;
        }

        .hero-text p {
            font-size: 1.1rem;
            color: #555;
            margin-top: 15px;
        }

        .hero-button {
            margin-top: 25px;
        }

        .hero-button a {
            background-color: #f54a05;
            color: #fff;
            padding: 12px 28px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
        }

        .hero-images img {
            width: 100%;
            height: auto;
            border-radius: 20px;
            object-fit: cover;
        }

        @media (min-width: 768px) {
            .hero-text h1 {
                font-size: 3rem;
            }
        }
        .custom-carousel-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background-color: #d9d9d9;
    border: none;
    color: #333;
    font-size: 1.5rem;
    border-radius: 50%;
    width: 36px;
    height: 36px;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 5;
    transition: all 0.3s ease;
    box-shadow: 0 0 5px rgba(0,0,0,0.2);
}

.custom-carousel-btn:hover {
    background-color: #b5b5b5;
}

.custom-prev {
    left: 10px;
}

.custom-next {
    right: 10px;
}

.hero-carousel {
    margin: 0;
    padding-left: 3rem;
    padding-right: 3rem;
    width: 100% ;
}

    </style>

    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">

            @foreach ($bannerTypeMainBanner->chunk(2) as $index => $chunk)
              @php $firstBanner = $chunk->first(); @endphp
            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                <div class="hero-carousel d-flex align-items-center px-4">
                    <div class="row align-items-center px-5">
                        <!-- Text Column -->
                        <div class="col-md-6 hero-text ">
                            <h1>
                                Discover a Smarter<br>
                                Way to Shop with <span>Albazar</span>
                            </h1>
                            <p>
                                Explore a wide selection of electronics, fashion, perfumes, and more — handpicked for quality,
                                value, and everyday convenience.
                            </p>
                            <div class="hero-button">
                                <a href="{{ $firstBanner['url'] }}">SHOP NOW →</a>
                            </div>
                        </div>

                        <!-- Image Columns -->
                        <div class="col-md-6">
                            <div class="row g-3 hero-images">
                                @foreach ($chunk as $banner)
                                    <div class="col-6">
                                        <a href="{{ $banner['url'] }}" target="_blank">
                                            <img src="{{ getStorageImages(path: $banner->photo_full_url, type: 'banner') }}" alt="Banner Image">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>

        <!-- Controls -->
       <!-- Custom Arrows -->
<button class="custom-carousel-btn custom-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
    <i class="bi bi-chevron-left"></i>
</button>
<button class="custom-carousel-btn custom-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
    <i class="bi bi-chevron-right"></i>
</button>
    <style>
        .custom-badge {
            font-size: 14px;
            font-weight: 500;
            color: #333;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            padding: 8px 12px;
            border-radius: 4px;
            white-space: nowrap;
        }
        .badge-container {
            gap: 10px;
        }
    </style>
    </div>

   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</section>
@endif
