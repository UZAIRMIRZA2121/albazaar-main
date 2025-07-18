@if (count($products) > 0)
    @php
        $decimal_point_settings = getWebConfig(name: 'decimal_point_settings');

        $searchCategory = request()->get('category');
        $searchProduct = request()->get('search');
    @endphp

 

    @php
        $filteredProducts = $products
            ->filter(function ($p) use ($searchCategory, $searchProduct) {
                $product = !empty($p['product_id']) ? $p->product : $p;

                if (!$product) {
                    return false;
                }

                $matchCategory = $searchCategory ? $product->category_id == $searchCategory : true;
                $matchName = $searchProduct ? stripos($product->name, $searchProduct) !== false : true;

                return $matchCategory && $matchName;
            })
            ->where('featured', 1)
            ->sortByDesc('featured_till');
    @endphp

    @if ($filteredProducts->count() > 0)
        @foreach ($filteredProducts as $product)
            @if (!empty($product['product_id']))
                @php($product = $product->product)
            @endif

            @if (!empty($product))
                <div
                    class="{{ Request::is('products*') ? 'col-lg-3 col-md-4 col-sm-4 col-6' : 'col-lg-2 col-md-3 col-sm-4 col-6' }} {{ Request::is('shopView*') ? 'col-lg-3 col-md-4 col-sm-4 col-6' : '' }} p-2">

                    @include('web-views.partials._filter-single-product', [
                        'product' => $product,
                        'decimal_point_settings' => $decimal_point_settings,
                    ])
                </div>
            @endif
        @endforeach

        <div class="col-12">
            <nav class="d-flex justify-content-between pt-2" aria-label="Page navigation" id="paginator-ajax">
                {!! $products->links() !!}
            </nav>
        </div>
    @else
        <div class="d-flex justify-content-center align-items-center w-100 py-5">
            <div>
                <img src="{{ theme_asset(path: 'public/assets/front-end/img/media/product.svg') }}" class="img-fluid"
                    alt="">
                <h6 class="text-muted">{{ translate('no_search_product_found') }}</h6>
            </div>
        </div>
        <br><br><br>
    @endif
@endif
