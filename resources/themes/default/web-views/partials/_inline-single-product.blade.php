<!-- Repeat for each product -->
@php($overallRating = getOverallRating($product->reviews))

<div class="text-center mb-5">
    @if ($product->discount > 0)
        <div class="d-flex">
            <span class="for-discount-value p-1 pl-2 pr-2 font-bold fs-13">
                <span class="direction-ltr d-block">
                    @if ($product->discount_type == 'percent')
                        -{{ round($product->discount, !empty($decimalPointSettings) ? $decimalPointSettings : 0) }}%
                    @elseif($product->discount_type == 'flat')
                        -{{ webCurrencyConverter(amount: $product->discount) }}
                    @endif
                </span>
            </span>
        </div>
    @else
        <div class="d-flex justify-content-end">
            <span class="for-discount-value-null"></span>
        </div>
    @endif
    @if ($product->product_type == 'physical' && $product->current_stock <= 0)
        <span class="out_fo_stock">{{ translate('out_of_stock') }}</span>
    @endif
    <div class=" overflow-hidden rounded-[15px]">
        <a href="{{ route('product', $product->slug) }}" class="w-100">
            <img src="{{ asset('footer/06.07.2025_04.45.59_REC.png') }}" alt="Baby Knitted Shoes"
                class="w-full h-full object-fill rounded-[15px]" />
        </a>
    </div>
    <h3 class="text-sm font-medium mt-4"> <a href="{{ route('product', $product->slug) }}">
            {{ $product['name'] }}
        </a></h3>
    @if ($product->discount > 0)
        <del class=" text-sm">
            {{ webCurrencyConverter(amount: $product->unit_price) }}
        </del>
    @endif
    <p class="text-orange-600 text-sm">
        {{ webCurrencyConverter(
            amount: $product->unit_price - getProductDiscount(product: $product, price: $product->unit_price),
        ) }}
    </p>
</div>
