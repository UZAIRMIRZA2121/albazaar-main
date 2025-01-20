@if (count($bannerTypeMainBanner) > 0)

<section class="pb-4 rtl">
    <div class="">
        <div>
            <style>
                .carousel-item img {
                    width: 100%;
                    height: 400px;
                    /* Set a consistent height */
                    object-fit: cover;
                }

                .carousel-inner {
                    display: flex;
                    flex-wrap: nowrap;
                }

                #imageCarousel {
                    background-color: #000000;
                }

                @media (max-width: 768px) {
                    .carousel-inner {
                        flex-direction: column;
                    }
                }
            </style>
            <!-- Carousel Wrapper -->
            <div id="imageCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($bannerTypeMainBanner as $key => $banner)
                        <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                            <a href="{{ $banner['url'] }}" class="d-block" target="_blank">
                                <img src="{{ getStorageImages(path: $banner->photo_full_url, type: 'banner') }}"
                                    alt="Image {{ $key + 1 }}" class="img-fluid">
                            </a>
                        </div>
                    @endforeach
                </div>
                {{-- <!-- Controls -->
                <a class="carousel-control-prev" href="#imageCarousel" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </a>
                <a class="carousel-control-next" href="#imageCarousel" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </a> --}}
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
