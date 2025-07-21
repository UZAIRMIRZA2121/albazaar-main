<div class="container-fluid  bg-[#ffffff] md:mt-[50px] mt-[20px]   md:block">
    <div class="max-w-[100%] md:max-w-[100%] lg:md:max-w-[78%] mx-auto justify-between items-center  text-sm py-2 ">
        <!-- Section Title -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">{{ translate('top_rated') }}</h2>
        </div>
        <!-- Product Cards -->
        <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
            @foreach ($topRatedProducts as $key => $product)
                @if ($key < 6)
                    <!-- Card 1 -->
                    <div class="overflow-hidden text-center rounded-[10px] ">
                        @if ($product->discount > 0)
                            <div class="d-flex">
                                <span class="for-discount-value p-1 pl-2 pr-2 font-bold fs-13">
                                    <span class="direction-ltr d-block">
                                        @if ($product->discount_type == 'percent')
                                            -{{ round($product->discount) }}%
                                        @elseif($product->discount_type == 'flat')
                                            -{{ webCurrencyConverter(amount: $product->discount) }}
                                        @endif
                                    </span>
                                </span>
                            </div>
                        @endif
                        <div class=" overflow-hidden rounded-[10px]">
                            <img src="{{ getStorageImages(path: $product->thumbnail_full_url, type: 'product') }}"
                                alt="{{ translate('product') }}" class="w-full h-full object-cover object-center" />
                        </div>
                        <!-- Rating -->
                        <div class="text-orange-500 mt-2 flex justify-center space-x-1">
                            @php($overallRating = getOverallRating($product['reviews']))
                            @if ($overallRating[0] != 0)
                                @for ($inc = 1; $inc <= 5; $inc++)
                                    @if ($inc <= floor($overallRating[0]))
                                        <i class="fas fa-star text-orange-500"></i>
                                    @elseif($overallRating[0] > floor($overallRating[0]) && $inc == ceil($overallRating[0]))
                                        <i class="fas fa-star-half-alt text-orange-500"></i>
                                    @else
                                        <i class="far fa-star text-orange-300"></i>
                                    @endif
                                @endfor
                                ( {{ count($product['reviews']) }} )
                            @endif
                        </div>
                        <!-- Title & Price -->
                        <div class="p-2">
                            <h3 class="text-md font-medium">  {{ Str::limit($product['name'],100) }}</h3>
                               @if($product->discount > 0)
                                                    <del class="__text-12px __color-9B9B9B">
                                                        {{ webCurrencyConverter(amount: $product->unit_price) }}
                                                    </del>
                                                @endif
                            <p class="text-orange-500 font-semibold mt-1">  {{ webCurrencyConverter(amount:
                                                $product->unit_price-(getProductDiscount(product: $product, price: $product->unit_price))
                                                ) }}</p>
                        </div>
                    </div>
                @endif
            @endforeach

        </div>
        <a href="{{ route('products', ['data_from' => 'top-rated', 'page' => 1]) }}"
            class="text-orange-600 text-[16px] underline hover:text-orange-700 transition duration-200 text-center block mt-3">
            {{ translate('view_all') }}
        </a>
    </div>
</div>
<!-- Top Related -->
