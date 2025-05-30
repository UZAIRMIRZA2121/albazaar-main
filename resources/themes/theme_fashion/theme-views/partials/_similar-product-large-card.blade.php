@php($overallRating = getOverallRating($product->reviews))

<div class="product-card product-card-row">

    <div class="product-card-inner d-">

        <div class="img">
            <a href="{{route('product',$product->slug)}}" class="d-block h-100">
                <img loading="lazy" class="w-100" alt="{{ translate('product') }}"
                     src="{{ getStorageImages(path: $product->thumbnail_full_url, type:'product') }}">
            </a>
            <a href="javascript:" class="d-inline-flex wish-icon addWishlist_function_view_page"
               data-id="{{$product->id}}">
                <i class="wishlist_{{$product->id}} bi {{ isProductInWishList($product->id) ? 'bi-heart-fill text-danger':'bi-heart' }}"></i>
            </a>
        </div>
        <div class="cont">
            <h6 class="title">
                <a href="{{route('product',$product->slug)}}">{{ Str::limit($product['name'], 25) }}</a>
            </h6>
            <div class="rating">
                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= (int)$overallRating[0])
                        <i class="bi bi-star-fill filled"></i>
                    @elseif ($overallRating[0] != 0 && $i <= (int)$overallRating[0] + 1.1 && $overallRating[0] > ((int)$overallRating[0]))
                        <i class="bi bi-star-half filled"></i>
                    @else
                        <i class="bi bi-star-fill"></i>
                    @endif
                @endfor
            </div>
            <div
                class="d-flex align-items-center justify-content-between column-gap-2 my-2 my-md-3">
                <h4 class="price">
                    <span>{{webCurrencyConverter($product->unit_price-\App\Utils\Helpers::getProductDiscount($product,$product->unit_price))}}</span>
                    @if($product->discount > 0)
                        <del>{{webCurrencyConverter($product->unit_price)}}</del>
                    @endif
                </h4>
            </div>
            @if ($product->order_details_sum_qty > 0)
                @if ($product['product_type'] == 'physical')
                    <div class="sold-info d-flex">
                        <span>
                            {{$product->order_details_sum_qty}} {{ translate('sold') }}
                        </span>
                        <span> / </span>
                        <span>
                            {{$product->order_details_sum_qty + $product->current_stock}} {{ translate('item') }}
                        </span>
                    </div>
                @else
                    <div class="sold-info">
                        {{$product->order_details_sum_qty}} {{ translate('sold') }}
                    </div>
                @endif
            @endif
            <div class="sold-info my-2 my-md-3">{{ translate('category') }}:
                <span>{{ \Illuminate\Support\Str::limit(isset($product->category) ? $product->category->name:'', 15) }}</span>
            </div>
            <div class="d-flex flex-wrap gap-2 product-cart-option-container">
                @if (json_decode($product->variation) != null)
                    <a href="javascript:" data-id="{{$product['id']}}"
                       class="btn btn-base flex-grow-1 justify-content-center __btn-outline quickView_action">
                        <i class="bi bi-cart"></i>
                        {{ translate('add_to_cart') }}
                    </a>
                @else
                    <form class="cart d-none addToCartDynamicForm add-to-cart-details-form-{{$product['id']}}"
                          action="{{ route('cart.add') }}"
                          data-id="add-to-cart-details-form-{{$product['id']}}"
                          data-errormessage="{{ translate('please_choose_all_the_options') }}"
                          data-outofstock="{{ translate('sorry').', '.translate('out_of_stock') }}.">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <input type="number" name="quantity" value="{{ $product->minimum_order_qty ?? 1 }}"
                               class="form-control product_quantity__qty" hidden>
                    </form>
                    <a href="javascript:" data-form="{{ 'add-to-cart-details-form-'.$product['id'] }}"
                       class="btn btn-base flex-grow-1 justify-content-center __btn-outline product-add-to-cart-button" type="button"
                       data-form=".add-to-cart-details-form-{{$product['id']}}"
                       data-update="{{ translate('update_cart') }}"
                       data-add="{{ translate('add_to_cart') }}">
                        <i class="bi bi-cart"></i>
                        {{ translate('add_to_cart') }}
                    </a>
                @endif

                <a href="javascript:"
                   class="btn btn-base flex-grow-1 justify-content-center __btn-outline addCompareList_view_page"
                   data-id="{{$product['id']}}"><i
                        class="bi bi-shuffle compare_list_icon-{{$product['id']}} {{ isProductInCompareList($product->id) ?'text-base':'' }}"></i></a>
            </div>
        </div>
    </div>
</div>


