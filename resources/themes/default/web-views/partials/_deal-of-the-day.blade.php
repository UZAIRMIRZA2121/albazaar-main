@if (isset($product))

    <div class="container-fluid  bg-[#ffffff] md:mt-[50px] mt-[20px]">
        <div class="max-w-[100%] md:max-w-[100%] lg:md:max-w-[78%] mx-auto justify-between items-center  text-sm py-2 ">
            <div class="grid grid-cols-12  gap-6 p-2 md:p-6">


                @if (isset($dealOfTheDay->product))
                    <div class="d-flex justify-content-center align-items-center py-4">
                        <h4
                            class="font-bold fs-16 m-0 align-items-center text-uppercase text-center px-2 web-text-primary">
                            {{ translate('deal_of_the_day') }}
                        </h4>
                    </div>
                    <div class="recommended-product-card mt-0 min-height-auto">
                        <div class="d-flex justify-content-center align-items-center __pt-20 __m-20-r">
                            <div class="position-relative">
                                <img class="__rounded-top aspect-1 h-auto" alt=""
                                    src="{{ getStorageImages(path: $dealOfTheDay?->product?->thumbnail_full_url, type: 'product') }}">
                                @if ($dealOfTheDay && $dealOfTheDay->discount > 0)
                                    <span class="for-discount-value p-1 pl-2 pr-2 font-bold fs-13">
                                        <span class="direction-ltr d-block">
                                            @if ($dealOfTheDay->discount_type == 'percent')
                                                -{{ round($dealOfTheDay->discount, !empty($decimal_point_settings) ? $decimal_point_settings : 0) }}%
                                            @elseif($dealOfTheDay->discount_type == 'flat')
                                                -{{ webCurrencyConverter(amount: $dealOfTheDay->discount) }}
                                            @endif
                                        </span>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="__i-1 bg-transparent text-center mb-0">
                            <div class="px-0">
                                @php($overallRating = getOverallRating($dealOfTheDay->product['reviews']))
                                @if ($overallRating[0] != 0)
                                    <div class="rating-show">
                                        <span class="d-inline-block font-size-sm text-body">
                                            @for ($inc = 1; $inc <= 5; $inc++)
                                                @if ($inc <= (int) $overallRating[0])
                                                    <i class="tio-star text-warning"></i>
                                                @elseif ($overallRating[0] != 0 && $inc <= (int) $overallRating[0] + 1.1)
                                                    <i class="tio-star-half text-warning"></i>
                                                @else
                                                    <i class="tio-star-outlined text-warning"></i>
                                                @endif
                                            @endfor
                                            <label class="badge-style">( {{ count($dealOfTheDay->product['reviews']) }}
                                                )</label>
                                        </span>
                                    </div>
                                @endif
                                <h6 class="font-semibold pt-1">
                                    {{ Str::limit($dealOfTheDay->product['name'], 80) }}
                                </h6>
                                <div
                                    class="mb-4 pt-1 d-flex flex-wrap justify-content-center align-items-center text-center gap-8">

                                    @if ($dealOfTheDay->product->discount > 0)
                                        <del class="fs-14 font-semibold __color-9B9B9B">
                                            {{ webCurrencyConverter(amount: $dealOfTheDay->product->unit_price) }}
                                        </del>
                                    @endif
                                    <span class="text-accent fs-18 font-bold text-dark">
                                        {{ webCurrencyConverter(
                                            amount: $dealOfTheDay->product->unit_price -
                                                getProductDiscount(product: $dealOfTheDay->product, price: $dealOfTheDay->product->unit_price),
                                        ) }}
                                    </span>
                                </div>
                                <button
                                    class="btn btn--primary font-bold px-4 rounded-10 text-uppercase get-view-by-onclick"
                                    data-link="{{ route('product', $dealOfTheDay->product->slug) }}">
                                    {{ translate('buy_now') }}
                                </button>

                            </div>
                        </div>
                    </div>
                @else
                    @if (isset($recommendedProduct))
                        {{-- Latest products --}}


                    @endif
                @endif
            </div>
        </div>
    </div>
@endif
