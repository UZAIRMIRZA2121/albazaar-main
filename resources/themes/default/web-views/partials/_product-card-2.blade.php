@if (isset($product))
    @php($overallRating = getOverallRating($product->reviews))
    <div class="text-center">

        @if ($product->discount > 0)
            <span class="for-discount-value p-1 pl-2 pr-2 font-bold fs-13">
                <span class="direction-ltr d-block">
                    @if ($product->discount_type == 'percent')
                        -{{ round($product->discount, !empty($decimal_point_settings) ? $decimal_point_settings : 0) }}%
                    @elseif($product->discount_type == 'flat')
                        -{{ webCurrencyConverter(amount: $product->discount) }}
                    @endif
                </span>
            </span>
        @endif
        <div class=" overflow-hidden rounded-[15px]">
            <img src="{{ getStorageImages(path: $product->thumbnail_full_url, type: 'product') }}" alt="Gavriel Bag"
                class="w-full  object-cover object-center" />
        </div>
        <div class="pt-3">
            <h3 class="text-md font-medium mt-1"> <a href="{{ route('product', $product->slug) }}"
                    class="flash-product-title text-capitalize fw-semibold">
                    {{ Str::limit($product['name'], 80) }}
                </a></h3>
            @if ($product->discount > 0)
                <del class="category-single-product-price">
                    {{ webCurrencyConverter(amount: $product->unit_price) }}
                </del>
            @endif
            <p class="text-orange-500 font-semibold mt-2"> {{ webCurrencyConverter(amount: $product->unit_price - getProductDiscount(product: $product, price: $product->unit_price)) }}</p>
        </div>
    </div>

@endif
