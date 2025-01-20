@if (count($bannerTypeMainBanner) > 0)
<section class="pb-4 rtl">
    <div class="">
        <div>
            <style>
                /* Set image width and height */
                .carousel-item img {
                    width: 100%;
                    height: 450px; /* Fixed height for large screens */
                    object-fit: cover;
                }

                /* Responsively manage height for smaller screens */
                @media (max-width: 767px) {
                    .carousel-item img {
                        height: auto; /* Adjust height for smaller screens */
                    }
                    #row {
                        flex-wrap: unset;
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
            <!-- Carousel Wrapper -->
            <div id="imageCarousel" class="carousel slide" data-bs-interval="false">
                <div class="carousel-inner">
                    <!-- Slide 1 -->
                    <div class="carousel-item active">
                        <div class="row " id="row">
                            @foreach ($bannerTypeMainBanner as $key => $banner)
                                <!-- Show only the first image on small screens (mobile), and all images on larger screens -->
                                <div class="col-12 col-md-3">
                                    @if ($key == 0)
                                        <a href="{{ $banner['url'] }}" class="d-block" target="_blank">
                                            <img src="{{ getStorageImages(path: $banner->photo_full_url, type: 'banner') }}"
                                                alt="Image 4" class="img-fluid">
                                        </a>
                                    @elseif ($key > 0) <!-- Show additional images only for larger screens -->
                                        <a href="{{ $banner['url'] }}" class="d-block" target="_blank">
                                            <img src="{{ getStorageImages(path: $banner->photo_full_url, type: 'banner') }}"
                                                alt="Image 4" class="img-fluid">
                                        </a>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



    {{-- <section class="bg-transparent py-3">
    <div class="container position-relative">
        <div class="row no-gutters position-relative rtl">
            @if ($categories->count() > 0)
                <div class="col-xl-3 position-static d-none d-xl-block __top-slider-cate">
                    <div class="category-menu-wrap position-static">
                        <ul class="category-menu mt-0">
                            @foreach ($categories as $key => $category)
                                <li>
                                    <a href="{{route('products',['category_id'=> $category['id'],'data_from'=>'category','page'=>1])}}">{{$category->name}}</a>
                                    @if ($category->childes->count() > 0)
                                        <div class="mega_menu z-2">
                                            @foreach ($category->childes as $sub_category)
                                                <div class="mega_menu_inner">
                                                    <h6><a href="{{route('products',['category_id'=> $sub_category['id'],'data_from'=>'category','page'=>1])}}">{{$sub_category->name}}</a></h6>
                                                    @if ($sub_category->childes->count() > 0)
                                                        @foreach ($sub_category->childes as $sub_sub_category)
                                                            <div><a href="{{route('products',['category_id'=> $sub_sub_category['id'],'data_from'=>'category','page'=>1])}}">{{$sub_sub_category->name}}</a></div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </li>
                            @endforeach
                            <li class="text-center">
                                <a href="{{route('categories')}}" class="text-primary font-weight-bold justify-content-center text-capitalize">
                                    {{translate('view_all')}}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            @endif

            <div class="col-12 col-xl-9 __top-slider-images">
                <div class="{{Session::get('direction') === "rtl" ? 'pr-xl-2' : 'pl-xl-2'}}">
                    <div class="owl-theme owl-carousel hero-slider">
                        @foreach ($bannerTypeMainBanner as $key => $banner)
                            <a href="{{$banner['url']}}" class="d-block" target="_blank">
                                <img class="w-100 __slide-img" alt=""
                                    src="{{ getStorageImages(path: $banner->photo_full_url, type: 'banner') }}">
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}
@endif
