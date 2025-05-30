@php use App\Utils\Helpers; @endphp
@extends('theme-views.layouts.app')

@section('title', translate('my_Compare_List').' | '.$web_config['company_name'].' '.translate('ecommerce'))

@section('content')
    <main class="main-content d-flex flex-column gap-3 py-3 mb-4">
        <div class="container">
            <div class="row g-3">
                @include('theme-views.partials._profile-aside')
                <div class="col-lg-9">
                    <div class="card h-100">
                        <div class="card-body p-lg-4">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                                <h5 class="text-capitalize">{{translate('my_compare_list')}}</h5>
                                <div class="d-flex gap-4 flex-wrap">
                                    @if($compareLists->count()>0)
                                        <a href="javascript:"
                                           class="btn-link text-danger text-capitalize delete-action text-capitalize"
                                           data-action="{{route('product-compare.delete-all') }}"
                                           data-text="{{translate('want_to_clear_all_compare_list').'?'}}">
                                            {{translate('Clear_All')}}
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <div class="mt-4">
                                <div class="table-responsive">
                                    <table class="table align-middle table-bordered compare--table" style="min-width:@if($compareLists->count()>2)700px @elseif($compareLists->count()>1) 600px @endif">
                                        <tbody>
                                        @if($compareLists->count()>0)
                                            <tr>
                                                <th></th>

                                                @php($digitalProductExist = false)
                                                @foreach ($compareLists as $compareList)
                                                    <?php
                                                        if ($compareList?->product && $compareList?->product->product_type == "digital") {
                                                            $digitalProductExist = true;
                                                        }
                                                    ?>
                                                    <th>
                                                        <div class="d-flex flex-column gap-1 align-items-center">
                                                            <img width="160" class="dark-support aspect-1 object-contain" alt=""
                                                                 src="{{ getStorageImages(path: $compareList?->product?->thumbnail_full_url, type: 'product') }}">
                                                            <a href="javascript:"
                                                               data-action="{{route('product-compare.delete', ['id'=>$compareList['id']]) }}"
                                                               data-text="{{translate('want_to_delete_this_item').'?'}}"
                                                               class="btn-link text-danger text-decoration-underline delete-action">
                                                                {{translate('remove')}}
                                                            </a>
                                                        </div>
                                                    </th>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <th>{{ translate('Product_Name') }}</th>
                                                @foreach ($compareLists as $compareList)
                                                    <td>
                                                        <a href="{{route('product',$compareList->product['slug'])}}">
                                                            {{ $compareList->product['name'] }}
                                                        </a>
                                                    </td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <th>{{ translate('price') }}</th>
                                                @foreach ($compareLists as $compareList)
                                                    <td>{{ webCurrencyConverter($compareList->product['unit_price']) }}</td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <th>{{ translate('rating') }}</th>
                                                @foreach ($compareLists as $compareList)
                                                    <td>
                                                        <div class="d-flex">@php($avgRatting = number_format($compareList->product?->reviews?->avg('rating'), 2))
                                                            <div class="text-gold me-2">
                                                                @for ($rattingIndex = 1; $rattingIndex <= 5; $rattingIndex++)
                                                                    @if ($rattingIndex <= (int)$avgRatting)
                                                                        <i class="bi bi-star-fill filled"></i>
                                                                    @elseif ($avgRatting != 0 && $rattingIndex <= (int)$avgRatting + 1.1 && $avgRatting > ((int)$avgRatting))
                                                                        <i class="bi bi-star-half filled"></i>
                                                                    @else
                                                                        <i class="bi bi-star"></i>
                                                                    @endif
                                                                @endfor
                                                            </div>
                                                            ({{ $avgRatting }})</div>
                                                    </td>
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <th>{{ translate('brand') }}</th>
                                                @foreach ($compareLists as $compareList)
                                                    @if ($web_config['brand_setting'])
                                                        @if(isset($compareList->product->brand->image))
                                                            <td>
                                                                <a href="{{ route('products',['brand_id'=> $compareList->product->brand['id'],'data_from'=>'brand','page'=>1]) }}">
                                                                    <img width="48" class="rounded dark-support" alt=""
                                                                         src="{{ getStorageImages(path: $compareList?->product?->brand->image_full_url, type:'brand') }}">
                                                                </a>
                                                            </td>
                                                        @else
                                                            <td>
                                                                {{ 'N/a' }}
                                                            </td>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </tr>
                                            <tr>
                                                <th>{{ translate('category') }}</th>
                                                @foreach ($compareLists as $compareList)
                                                    <td>
                                                        <a href="{{route('products',['category_id'=> $compareList->product['category_id'],'data_from'=>'category','page'=>1])}}">
                                                            {{ $compareList?->product?->category?->name }}
                                                        </a>
                                                    </td>
                                                @endforeach
                                            </tr>
                                            @if($digitalProductExist)
                                                <tr>
                                                    <th>
                                                        {{ translate('Digital_Variation') }}
                                                    </th>
                                                    @foreach ($compareLists as $compareList)
                                                        <td>
                                                            <?php
                                                                $digitalVariation = $compareList?->product?->digitalVariation;
                                                            ?>
                                                            @if($digitalVariation && count($digitalVariation) > 0)
                                                                @foreach($digitalVariation as $variantIndex => $variation)
                                                                    @php($variantIndex++)
                                                                    {{ strtoupper($variation['variant_key'] )}}
                                                                    @if($variantIndex < count($digitalVariation)),@endif
                                                                @endforeach
                                                            @else
                                                                {{ "N/a" }}
                                                            @endif
                                                        </td>
                                                    @endforeach
                                                </tr>
                                            @endif
                                        @endif

                                        </tbody>
                                    </table>
                                </div>

                                @if($compareLists->count()==0)
                                    <div class="d-flex flex-column justify-content-center align-items-center gap-2 py-3 w-100">
                                        <img width="80" class="mb-3" src="{{ theme_asset('assets/img/empty-state/empty-compare-list.svg') }}" alt="">
                                        <h5 class="text-center text-muted">
                                            {{ translate('You_have_not_added_product_to_compare_yet') }}!
                                        </h5>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
