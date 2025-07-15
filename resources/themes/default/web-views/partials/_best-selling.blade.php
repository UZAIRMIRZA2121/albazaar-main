<!-- Best sellings -->
<div class="container-fluid mx-4 bg-[#ffffff] mt-[50px]  md:block">
    <div class="max-w-[100%] md:max-w-[100%] lg:md:max-w-[78%] mx-auto justify-between items-center  text-sm py-2 ">
        <!-- Section Title -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">{{ translate('best_sellings') }}</h2>
            <a href="{{ route('products', ['data_from' => 'best-selling', 'page' => 1]) }}"
                class="text-orange-500 hover:underline">{{ translate('view_all') }}</a>
        </div>
        <!-- Product Cards -->
        <div class="owl-carousel  carousel-seven grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
            @foreach ($bestSellProduct as $key => $bestSellItem)
                @if ($bestSellItem && $key < 6)
                    <!-- Card 1 -->
                    <a class="__best-selling" href="{{ route('product', $bestSellItem->slug) }}">
                        @if ($bestSellItem->discount > 0)
                            <div class="d-flex">
                                <span class="for-discount-value p-1 pl-2 pr-2 font-bold fs-13">
                                    <span class="direction-ltr d-block">
                                        @if ($bestSellItem->discount_type == 'percent')
                                            -{{ round($bestSellItem->discount) }}%
                                        @elseif($bestSellItem->discount_type == 'flat')
                                            -{{ webCurrencyConverter(amount: $bestSellItem->discount) }}
                                        @endif
                                    </span>
                                </span>
                            </div>
                        @endif
                        <div class="item overflow-hidden text-center rounded-[10px] ">
                            <div class=" overflow-hidden rounded-[10px]">
                                <img src="{{ getStorageImages(path: $bestSellItem?->thumbnail_full_url, type: 'product') }}"
                                    alt="{{ translate('product') }}" class="w-full h-full object-cover object-center" />
                            </div>
                         
                            @php($overallRating = getOverallRating($bestSellItem['reviews']))
                            @if ($overallRating[0] != 0)
                                <!-- Rating -->
                                <div class="text-orange-500 mt-2 flex justify-center space-x-1">
                                    @for ($inc = 1; $inc <= 5; $inc++)
                                        @if ($inc <= floor($overallRating[0]))
                                            {{-- Full Star --}}
                                            <span>★</span>
                                        @elseif($overallRating[0] > floor($overallRating[0]) && $inc == ceil($overallRating[0]))
                                            {{-- Half Star (you can use a different icon or styling if you have) --}}
                                            <span class="text-orange-300">★</span>
                                        @else
                                            {{-- Empty Star (e.g., grey) --}}
                                            <span class="text-gray-300">★</span>
                                        @endif
                                    @endfor
                                </div>
                            @endif
                            <!-- Title & Price -->
                            <div class="p-2">
                                <h3 class="text-md font-medium"> {{ Str::limit($bestSellItem['name'], 100) }}</h3>
                                @if ($bestSellItem->discount > 0)
                                    <del class="__color-9B9B9B __text-12px">
                                        {{ webCurrencyConverter(amount: $bestSellItem->unit_price) }}
                                    </del>
                                @endif
                                <p class="text-orange-500 font-semibold mt-1">
                                    {{ webCurrencyConverter(
                                        amount: $bestSellItem->unit_price - getProductDiscount(product: $bestSellItem, price: $bestSellItem->unit_price),
                                    ) }}
                                </p>
                            </div>
                        </div>
                    </a>
                @endif
            @endforeach
        </div>
        <a href="#"
            class="text-orange-600 text-[16px] underline hover:text-orange-700 transition duration-200 text-center block mt-3">
            View all
        </a>
    </div>
</div>
