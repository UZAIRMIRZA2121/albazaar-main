@php($overallRating = getOverallRating($product->reviews))
<div
    class="group border border-gray-200 p-3 rounded-[15px] relative transition-all duration-300 hover:shadow hover:border-[#FC4D03] cursor-pointer">
    @if ($product->featured == 1)
        <span class="absolute -top-3 left-4 bg-[#FC4D03] text-white text-xs px-2 py-1 rounded shadow">
            Promotion
        </span>
     
    @endif

    @if ($product->discount > 0)
    <span class="absolute -top-3 left-4 bg-[#FC4D03] text-white text-xs px-2 py-1 rounded shadow">
                @if ($product->discount_type == 'percent')
                    -{{ round($product->discount, !empty($decimal_point_settings) ? $decimal_point_settings : 0) }}%
                @elseif($product->discount_type == 'flat')
                    -{{ webCurrencyConverter(amount: $product->discount) }}
                @endif
                     
        </span>
        
         
    @else
        <div class="d-flex justify-content-end">
            <span class="for-discount-value-null"></span>
        </div>
    @endif


    <div class="h-30 mb-3 overflow-hidden rounded">
        <a href="{{ route('product', $product->slug) }}" class="w-100">
            <img src="{{ getStorageImages(path: $product->thumbnail_full_url, type: 'product') }}"
                class="w-full h-full object-cover rounded">
        </a>
    </div>
    {{-- <div class="quick-view">
        <a class="btn-circle stopPropagation action-product-quick-view" href="javascript:"
            data-product-id="{{ $product->id }}">
            <i class="czi-eye align-middle"></i>
        </a>
    </div> --}}

    <h3 class="text-sm font-semibold text-center">
        <a href="{{ route('product', $product->slug) }}">
            {{ $product['name'] }}
        </a>
    </h3>
    @if ($overallRating[0] != 0)
        <div class="rating-show justify-content-between text-center">
            <span class="d-inline-block font-size-sm text-body">
                @for ($inc = 1; $inc <= 5; $inc++)
                    @if ($inc <= (int) $overallRating[0])
                        <i class="tio-star text-warning"></i>
                    @elseif ($overallRating[0] != 0 && $inc <= (int) $overallRating[0] + 1.1 && $overallRating[0] > ((int) $overallRating[0]))
                        <i class="tio-star-half text-warning"></i>
                    @else
                        <i class="tio-star-outlined text-warning"></i>
                    @endif
                @endfor
                <label class="badge-style">( {{ count($product->reviews) }} )</label>
            </span>
        </div>
    @endif
    <p class="text-[#FC4D03] font-bold text-center">
        @if ($product->discount > 0)
            <del class="category-single-product-price">
                {{ webCurrencyConverter(amount: $product->unit_price) }}
            </del>
            <br>
        @endif
        {{ webCurrencyConverter(
            amount: $product->unit_price - getProductDiscount(product: $product, price: $product->unit_price),
        ) }}
</div>
