@if (count($bannerTypeMainBanner) > 0)
    <section class="pb-4 rtl">
        <div class="">
            <div>
                <style>
                    /* Set image width and height */
                    .carousel-item img {
                        width: 100%;
                        height: auto;
                        min-height: 450px;
                        /* Fixed height for large screens */
                        object-fit: cover;
                    }

                    .desktop-view {
                        display: block;
                    }

                    .mobile-view {
                        display: none;
                    }

                    /* Responsively manage height for smaller screens */
                    @media (max-width: 767px) {
                        .carousel-item img {
                            height: auto;
                            /* Adjust height for smaller screens */
                            min-height: unset !important;
                        }

                        .mobile-view {
                            display: block;
                        }

                        .desktop-view {
                            display: none;
                        }
                    }

                    /* Carousel inner style */
                    .carousel-inner {
                        display: flex;
                    }

                    #imageCarousel {
                        background-color: #000000;
                    }
                </style>

                <!-- Bootstrap Carousel Wrapper -->
                <div id="imageCarousel" class="carousel slide desktop-view" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @php
                            $totalSlides = ceil(count($bannerTypeMainBanner) / 4); // Calculate total slides needed
                        @endphp

                        @foreach ($bannerTypeMainBanner->chunk(4) as $chunkIndex => $bannerChunk)
                            <div class="carousel-item {{ $chunkIndex == 0 ? 'active' : '' }}">
                                <div class="row">
                                    @foreach ($bannerChunk as $banner)
                                        <div class="col-3">
                                            <a href="{{ $banner['url'] }}" class="d-block" target="_blank">
                                                <img src="{{ getStorageImages(path: $banner->photo_full_url, type: 'banner') }}"
                                                    alt="Banner Image" class="img-fluid">
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>


                </div>
                <div id="imageCarousel" class="carousel slide mobile-view" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @php
                            $totalSlides = ceil(count($bannerTypeMainBanner) / 4); // Calculate total slides needed
                        @endphp

                        @foreach ($bannerTypeMainBanner->chunk(2) as $chunkIndex => $bannerChunk)
                            <div class="carousel-item {{ $chunkIndex == 0 ? 'active' : '' }}">
                                <div class="row">
                                    @foreach ($bannerChunk as $banner)
                                        <div class="col-6">
                                            <a href="{{ $banner['url'] }}" class="d-block" target="_blank">
                                                <img src="{{ getStorageImages(path: $banner->photo_full_url, type: 'banner') }}"
                                                    alt="Banner Image" class="img-fluid">
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>


                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS (Ensure it's included) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Manual Carousel Initialization (Optional but helpful) -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var myCarousel = new bootstrap.Carousel(document.getElementById('imageCarousel'), {
                interval: 5000, // Auto-slide every 5 seconds
                ride: 'carousel'
            });
        });
    </script>
@endif
