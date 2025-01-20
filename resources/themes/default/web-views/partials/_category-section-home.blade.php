@if ($categories->count() > 0)

    <section class="pb-4 rtl">


        <div class="">
            <div>
                <div class="card __shadow h-100 max-md-shadow-0">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="categories-title m-0">
                                <span class="font-semibold">{{ translate('categories') }}</span>
                            </div>
                            <div>
                                <a class="text-capitalize view-all-text web-text-primary"
                                    href="{{ route('categories') }}">{{ translate('view_all') }}
                                    <i
                                        class="czi-arrow-{{ Session::get('direction') === 'rtl' ? 'left mr-1 ml-n1 mt-1 float-left' : 'right ml-1 mr-n1' }}"></i>
                                </a>
                            </div>
                        </div>

                        <div class="mt-3">
                            <div class="others-store-slider owl-theme owl-carousel">

                                @foreach ($categories as $key => $category)
                                    <div class="text-center __m-5px __cate-item">
                                        <a href="{{ route('products', ['category_id' => $category['id'], 'data_from' => 'category', 'page' => 1]) }}"
                                            class="d-flex flex-column align-items-center">
                                            <div class="__img">
                                                <img alt="{{ $category->name }}"
                                                    src="{{ getStorageImages(path: $category->icon_full_url, type: 'category') }}">
                                            </div>
                                            <p class="text-center fs-13 font-semibold mt-2">
                                                {{ Str::limit($category->name, 15) }}</p>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            $(".others-store-slider").owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 3
                    },
                    1000: {
                        items: 5
                    }
                }
            });
        });
    </script>
@endif
