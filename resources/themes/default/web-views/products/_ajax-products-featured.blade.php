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
        
            ->sortByDesc('featured_till');
    @endphp

    @if ($filteredProducts->count() > 0)
        @foreach ($filteredProducts as $product)
            @if (!empty($product['product_id']))
                @php($product = $product->product)
            @endif

            @if (!empty($product))
                <div
                    class=" p-2">

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
        @if ($searchProduct || $searchCategory)
        
<script>
    Swal.fire({
        icon: 'info',
        title: '{{ translate('no_search_product_found') }}',
        text: '{{ translate('please_check_other_products') }}', // Optional additional text
        confirmButtonText: '{{ translate('ok') }}',
        showCloseButton: true,
        allowOutsideClick: true
    });
</script>

            {{-- Fallback: show all products --}}
            @foreach ($products as $product)
                @if (!empty($product['product_id']))
                    @php($product = $product->product)
                @endif

                @if (!empty($product))
                    <div class="p-2">
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
        @endif
  @endif
   
@endif
