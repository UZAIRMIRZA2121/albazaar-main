@if (isset($product))
    @php($overallRating = getOverallRating($product->reviews))

    <!-- Card Start -->
    <div class="min-w-[240px] max-w-[240px] bg-white rounded-xl overflow-hidden text-center p-1 group relative shrink-0">
        @if ($product->featured == 1)
            <span class="absolute left-4 bg-[#FC4D03] text-white text-xs px-2 py-1 rounded shadow">
                Promotion
            </span>
        @endif
        @if ($product->discount > 0)
            @if ($product->discount_type == 'percent')
                <span class="absolute left-4 bg-[#FC4D03] text-white text-xs px-2 py-1 rounded shadow">
                    -{{ round($product->discount, !empty($decimalPointSettings) ? $decimalPointSettings : 0) }}%
                </span>
            @elseif($product->discount_type == 'flat')
                <span class="absolute left-4 bg-[#FC4D03] text-white text-xs px-2 py-1 rounded shadow">
                    -{{ webCurrencyConverter(amount: $product->discount) }}
                </span>
            @endif
        @endif
 <a href="{{ route('product', $product->slug) }}">
        <div class="text-center p-2 rounded-[10px] overflow-hidden">
            <img src="{{ getStorageImages(path: $product->thumbnail_full_url, type: 'product') }}" alt="Sun Glass"
                class="w-full rounded-[10px] object-cover">
        </div>
       
        <div
            class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-200 z-10">
            <button
                class="bg-[#FC4D03] text-white text-[10px] font-semibold px-4 py-2 rounded-lg shadow-lg flex items-center gap-1">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M11.25 18.75C11.25 19.58 10.58 20.25 9.75 20.25C8.92 20.25 8.25 19.58 8.25 18.75C8.25 17.92 8.92 17.25 9.75 17.25C10.58 17.25 11.25 17.92 11.25 18.75ZM16.25 17.25C15.42 17.25 14.75 17.92 14.75 18.75C14.75 19.58 15.42 20.25 16.25 20.25C17.08 20.25 17.75 19.58 17.75 18.75C17.75 17.92 17.08 17.25 16.25 17.25ZM20.73 7.68L18.73 15.68C18.65 16.01 18.35 16.25 18 16.25H8C7.64 16.25 7.33 15.99 7.26 15.63L5.37 5.25H4C3.59 5.25 3.25 4.91 3.25 4.5C3.25 4.09 3.59 3.75 4 3.75H6C6.36 3.75 6.67 4.01 6.74 4.37L7.17 6.75H20C20.23 6.75 20.45 6.86 20.59 7.04C20.73 7.22 20.78 7.46 20.73 7.68ZM19.04 8.25H7.44L8.62 14.75H17.41L19.04 8.25Z"
                        fill="#ffffff" />
                </svg>
            
                    <span>QUICK ADD</span>
           
            </button>
        </div>
         </a>
        <div class="px-4 py-3">
            <h3 class="text-md font-medium"> {{ $product['name'] }}</h3>
            <p class="text-orange-500 font-semibold mt-2">
                @if ($product->discount > 0)
                    <del class="category-single-product-price">
                        {{ webCurrencyConverter(amount: $product->unit_price) }}
                    </del>
                @endif
                <span class="text-lg font-semibold">
                    {{ webCurrencyConverter(amount: $product->unit_price - getProductDiscount(product: $product, price: $product->unit_price)) }}
                </span>
            </p>
        </div>
    </div>
    <!-- Card End -->
@endif
