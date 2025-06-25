<style>
    .category-circle {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        overflow: hidden;
        border: 2px solid #f0f0f0;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #fff;
        box-shadow: 0 0 5px rgba(0,0,0,0.1);
        transition: transform 0.3s;
        margin: auto;
    }

    .category-circle img {
        max-width: 100%;
        max-height: 100%;
        object-fit: cover;
    }

    .category-circle:hover {
        transform: scale(1.05);
    }
</style>

@if ($categories->count() > 0)
    <section class="pb-4 rtl container">
        <div class="card __shadow h-100 max-md-shadow-0">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="categories-title m-0">
                        <span class="font-semibold">{{ translate('Top categories') }}</span>
                    </div>
                    <div>
                        <a class="text-capitalize view-all-text web-text-primary"
                           href="{{ route('categories') }}">{{ translate('view_all') }}
                            <i class="czi-arrow-{{ Session::get('direction') === "rtl" ? 'left mr-1 ml-n1 mt-1 float-left' : 'right ml-1 mr-n1' }}"></i>
                        </a>
                    </div>
                </div>

                <div class="row mt-4">
                    @foreach($categories->take(12) as $key => $category)
                        <div class="col-md-2 col-6 text-center mb-4">
                            <a href="{{ route('products', ['category_id' => $category['id'], 'data_from' => 'category', 'page' => 1]) }}">
                                <div class="category-circle mb-2">
                                    <img src="{{ getStorageImages(path: $category->icon_full_url, type: 'category') }}"
                                         alt="{{ $category->name }}">
                                </div>
                                <div class="fw-bold small">{{ Str::limit($category->name, 15) }}</div>
                                <div class="text-muted small">{{ $category->product->count() ?? 0 }} Items</div>
                            </a>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </section>
@endif
