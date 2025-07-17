@extends('layouts.front-end.app')

@section('title', $product['name'])

@push('css_or_js')
    @include(VIEW_FILE_NAMES['product_seo_meta_content_partials'], [
        'metaContentData' => $product?->seoInfo,
        'productDetails' => $product,
    ])
    <link rel="stylesheet" href="{{ theme_asset(path: 'public/assets/front-end/css/product-details.css') }}" />
@endpush

@section('content')

    <div class="container-fluid mx-4 md:mx-0">
        <div class="max-w-[100%] md:max-w-[100%] lg:md:max-w-[78%] mx-auto justify-between items-center text-sm py-2">
            <div class="grid grid-cols-12 gap-3 md:gap-9">
                {{-- @include(VIEW_FILE_NAMES['product_details']) --}}
            </div>
        </div>
    </div>
    <div class="container-fluid mx-4 md:mx-0  ">
        <div class="max-w-[100%] md:max-w-[100%] lg:md:max-w-[78%] mx-auto justify-between items-center  text-sm py-2 ">

            <div class="grid grid-cols-12 gap-2 mt-9 mb-8">
                <div class="col-span-12">
                    <p class="text-sm text-gray-500">
                        <a href="#" class="text-orange-500 font-semibold">Categories</a> &gt;
                        <a href="#" class="text-orange-500 font-semibold">{{ $product->category->name }}</a> &gt;
                        <span class="text-black font-medium">{{ $product->name }}</span>
                    </p>
                </div>
            </div>


            <div class="grid grid-cols-12 gap-3 md:gap-9">
                <!-- Left Side: Image Section -->
                <div class="col-span-12 md:col-span-6">
                    <!-- Main Image with fixed height and object-contain -->
                    @if ($product->images != null && json_decode($product->images) > 0)
                        @if (json_decode($product->colors) && count($product->color_images_full_url) > 0)
                            @foreach ($product->color_images_full_url as $key => $photo)
                                @if ($photo['color'] != null)
                                    <div class="h-[400px] border rounded-xl overflow-hidden">
                                        <img id="mainImage" src="{{ asset('footer/12.07.2025_02.43.53_REC.png') }}"
                                            alt="Baby Knitted Shoes" class="w-full h-full object-revert-layer;" />
                                    </div>
                                @else
                                    <div class="h-[400px] border rounded-xl overflow-hidden">
                                        <img id="mainImage"
                                            src="{{ getStorageImages(path: $photo['image_name'], type: 'product') }}"
                                            alt="Baby Knitted Shoes" class="w-full h-full object-revert-layer;" />
                                    </div>
                                @endif
                            @endforeach
                        @else
                            @php
                                $mainImage = isset($product->images_full_url[0])
                                    ? getStorageImages($product->images_full_url[0], type: 'product')
                                    : asset('footer/12.07.2025_02.43.53_REC.png');
                            @endphp

                            <div class="h-[400px] border rounded-xl overflow-hidden">
                                <img id="mainImage" src="{{ $mainImage }}" alt="Product Image"
                                    class="w-full h-full object-cover" />
                            </div>

                            <div class="flex gap-4 mt-4">
                                @foreach ($product->images_full_url as $key => $photo)
                                    <div class="product-preview-item d-flex align-items-center justify-content-center {{ $key == 0 ? 'active' : '' }}"
                                        id="image{{ $key }}">
                                        <img src="{{ getStorageImages($photo, type: 'product') }}"
                                            alt="{{ translate('product') }}"
                                            data-zoom="{{ getStorageImages(path: $photo, type: 'product') }}"
                                            class="w-20 h-20 rounded-xl cursor-pointer border-2 border-gray-300 object-cover"
                                            onclick="document.getElementById('mainImage').src = this.src" />
                                        <div class="cz-image-zoom-pane"></div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Thumbnails -->


                        @endif
                    @endif


                </div>

       
                    <form id="add-to-cart-form" class="addToCartDynamicForm col-span-12 md:col-span-6">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                <!-- Right Side: Product Details -->
                <div class="col-span-12 md:col-span-6">
                    <h2 class="text-3xl font-bold mt-3 mb-2">{{ $product->name }}
                        @if ($product->featured == 1)
                            <span class="absolute -top-3 left-4 bg-[#FC4D03] text-white text-xs px-2 py-1 rounded shadow">
                                Promotion
                            </span>
                        @endif
                    </h2>
                    <div class="text-gray-600 mb-4">{!! $product->details !!}</div>

                    <div class="flex items-center space-x-3 mb-4">
                        {!! getPriceRangeWithDiscount(product: $product) !!}
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

                        {{-- <span class="bg-[#FC4D03] text-white px-2 py-1 text-sm rounded">Save 20%</span> --}}
                    </div>

                    <!-- Size -->
                    <div class="mb-4">
                        <p class="font-semibold">Size</p>
                        <div class="flex gap-3 mt-2">
                            <button class="w-7 h-7 border rounded hover:bg-gray-200">S</button>
                            <button class="w-7 h-7 border rounded hover:bg-gray-200">M</button>
                            <button class="w-7 h-7 border rounded hover:bg-gray-200">L</button>
                            <button class="w-7 h-7 border rounded hover:bg-gray-200">XL</button>
                        </div>
                    </div>
                    @if (isset($product->colors) && !empty($product->colors) && is_array(json_decode($product->colors)))
                        <!-- Color -->
                        <div class="mb-4">
                            {{-- <p class="font-semibold">Color</p> --}}
                            <div class="flex gap-3 mt-2">
                                @foreach (json_decode($product->colors) as $key => $color)
                                    <input type="radio"
                                        id="{{ str_replace(' ', '', $product->id . '-color-' . str_replace('#', '', $color)) }}"
                                        name="color" value="{{ $color }}" class="hidden peer"
                                        @if ($key == 0) checked @endif>

                                    <label
                                        for="{{ str_replace(' ', '', $product->id . '-color-' . str_replace('#', '', $color)) }}"
                                        style="background: {{ $color }};"
                                        class="w-6 h-6 rounded border cursor-pointer peer-checked:ring-2 ring-offset-2 ring-primary-500 block"
                                        title="{{ \App\Utils\get_color_name($color) }}">
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endif


                    <!-- Quantity -->
                    @php
                        $minQty = $product->minimum_order_qty ?? 1;
                        $maxQty = $product['product_type'] === 'physical' ? $product->current_stock : 100;
                    @endphp

                    <div x-data="{ quantity: {{ $minQty }} }" class="my-4">
                        <p class="font-semibold">Quantity</p>
                        <div class="flex items-center gap-2 mt-2">
                            <!-- Decrement Button -->
                            <button type="button"
                                class="w-8 h-8 flex items-center justify-center border rounded bg-gray-100 text-gray-700 hover:bg-gray-200"
                                @click="if (quantity > {{ $minQty }}) quantity--">
                                -
                            </button>

                            <!-- Quantity Input -->
                            <input type="number" x-model="quantity" :min="{{ $minQty }}" :max="{{ $maxQty }}"
                                name="quantity" class="w-12 text-center border rounded px-2 py-1" />

                            <!-- Increment Button -->
                            <button type="button"
                                class="w-8 h-8 flex items-center justify-center border rounded bg-gray-100 text-gray-700 hover:bg-gray-200"
                                @click="if (quantity < {{ $maxQty }}) quantity++">
                                +
                            </button>
                        </div>

                        <!-- Hidden Inputs (Optional) -->
                        <input type="hidden" name="product_variation_code" class="product-generated-variation-code"
                            data-product-id="{{ $product['id'] }}">
                        <input type="hidden" name="key" class="in_cart_key form-control w-50" value="">
                    </div>

                        <!-- Buttons -->
                        <div class="flex gap-4 mb-4">
                            <button
                                class="bg-[#FC4D03] hover:bg-orange-600 text-white font-semibold px-6 py-2 rounded flex items-center gap-2 action-add-to-cart-form"
                                type="button" data-update-text="{{ translate('update_cart') }}"
                                id="action-add-to-cart-form" data-add-text="{{ translate('add_to_cart') }}">
                                <span class="string-limit">{{ translate('add_to_cart') }}</span>
                            </button>


                        </div>
                    </form>
                    <!-- Footer Info -->
                    <div class="text-sm text-gray-600 space-y-1">
                        @if ($product['menufacture_days'])
                            <p>✔️ {{ $product['menufacture_days'] }} Menufacture Days required</p>
                        @endif
                        <p>
                            @if ($product['returnable'] == 1)
                                ✔️ Returnable
                            @else
                                ❌ Returnable
                            @endif
                        </p>
                        <p>
                            {{ $product['menufacture_days'] == null ? '❌' : '✔️' }} Readymade
                        </p>

                        <p>✔️ Safe Payment</p>
                        <p>✔️ 100% Authentic Products</p>
                    </div>
                </div>

                <div class="col-span-12  py-10 space-y-8">
                    <!-- Description Section -->
                    @if ($product['details'])
                        <span class="bg-[#FC4D03] text-white px-2 py-1 text-sm rounded ">Current Stock :
                            {{ $product->current_stock }}</span>
                    @endif
                    @if (!empty($product->details))
                        <div>
                            <h2 class="text-lg font-semibold mb-2">Description</h2>
                            <p class="text-gray-700 leading-relaxed">
                                {!! $product->details !!}
                            </p>
                        </div>
                    @endif
                    <hr class="border-gray-300" />
                    <!-- Product Details Section -->
                    {{-- <div>
                        <h2 class="text-lg font-semibold mb-2">Product details</h2>
                        <p class="text-gray-700 leading-relaxed">
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                            the industry's
                            standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                            scrambled it to
                            make a type specimen book. It has survived not only five centuries, but also the leap into
                            electronic
                            typesetting, remaining essentially unchanged.
                        </p>
                    </div> --}}
                    {{-- <hr class="border-gray-300" /> --}}

                    <div>
                        <h2 class="text-lg font-semibold mb-6">Reviews</h2>

                        <!-- Single Review -->
                        <div class="space-y-8">
                            <div class="flex gap-4">
                                <img src="https://i.pravatar.cc/50?img=1" alt="User"
                                    class="w-12 h-12 rounded-full" />
                                <div class="flex-1">
                                    <div class="flex items-center justify-between">
                                        <div class="space-y-1">
                                            <h4 class="font-semibold">Dianne Russell</h4>
                                            <div class="text-gray-500 text-sm flex items-center gap-1">
                                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M8 7V3m8 4V3m-9 9h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                <span>4 days ago</span>
                                            </div>
                                        </div>
                                        <button
                                            class="flex items-center text-orange-500 text-sm font-medium hover:underline">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 10h11M9 21V7a4 4 0 014-4h7" />
                                            </svg>
                                            Reply
                                        </button>
                                    </div>

                                    <!-- Stars -->
                                    <div class="flex text-yellow-500 mt-1">
                                        ★★★★★
                                    </div>

                                    <!-- Review Text -->
                                    <p class="text-gray-700 mt-2">
                                        It is a long established fact that a reader will be distracted by the readable
                                        content of a page when
                                        looking at its layout. The point of using Lorem Ipsum is that it has a
                                        more-or-less
                                        normal distribution
                                        of letters, as opposed to using 'Content here, content here', making it look
                                        like
                                        readable English.
                                    </p>
                                </div>
                            </div>

                            <!-- Repeat above .flex review block as needed -->
                            <!-- You can loop this using Blade or JS for dynamic content -->
                        </div>
                    </div>
                </div>
                <div class="col-span-12  flex justify-center">

                    <button
                        class="px-5 py-4 hover:bg-[#FC4D03] hover:border-[#ffffff] hover:text-white text-black border-2 border-[#000000] rounded-lg">
                        VIEW ALL </button>
                </div>
            </div>





        </div>
    </div>



    <!--  Featured products -->
    <div class="container-fluid mx-4 md:mx-0 ">
        <div class="max-w-[100%] md:max-w-[100%] lg:md:max-w-[78%] mx-auto justify-between items-center  text-sm py-2 ">
            <div class=" md:py-10 px-4">
                <div class="max-w-7xl mx-auto">
                    <!-- Header -->
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold">Featured products</h2>
                        <a href="#" class="text-orange-600 font-medium text-sm hover:underline">View
                            all</a>
                    </div>
                    <!-- Wrapper -->
                    <div class="w-full overflow-x-auto lg:overflow-x-visible">
                        <div class="flex ">

                            <!-- Card Start -->
                            <div
                                class="min-w-[240px] max-w-[240px] bg-white rounded-xl overflow-hidden text-center p-1 group relative shrink-0">
                                <div class="text-center p-2 rounded-[10px] overflow-hidden">
                                    <img src="{{ asset('footer/06.07.2025_04.46.08_REC.png') }}" alt="Sun Glass"
                                        class="w-full rounded-[10px] object-cover">
                                </div>
                                <div
                                    class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-200 z-10">
                                    <button
                                        class="bg-[#FC4D03] text-white text-[10px] font-semibold px-4 py-2 rounded-lg shadow-lg flex items-center gap-1">
                                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.25 18.75C11.25 19.58 10.58 20.25 9.75 20.25C8.92 20.25 8.25 19.58 8.25 18.75C8.25 17.92 8.92 17.25 9.75 17.25C10.58 17.25 11.25 17.92 11.25 18.75ZM16.25 17.25C15.42 17.25 14.75 17.92 14.75 18.75C14.75 19.58 15.42 20.25 16.25 20.25C17.08 20.25 17.75 19.58 17.75 18.75C17.75 17.92 17.08 17.25 16.25 17.25ZM20.73 7.68L18.73 15.68C18.65 16.01 18.35 16.25 18 16.25H8C7.64 16.25 7.33 15.99 7.26 15.63L5.37 5.25H4C3.59 5.25 3.25 4.91 3.25 4.5C3.25 4.09 3.59 3.75 4 3.75H6C6.36 3.75 6.67 4.01 6.74 4.37L7.17 6.75H20C20.23 6.75 20.45 6.86 20.59 7.04C20.73 7.22 20.78 7.46 20.73 7.68ZM19.04 8.25H7.44L8.62 14.75H17.41L19.04 8.25Z"
                                                fill="#ffffff" />
                                        </svg>
                                        <span>QUICK ADD</span>
                                    </button>
                                </div>
                                <div class="px-4 py-3">
                                    <h3 class="text-md font-medium">Gavriel Bag</h3>
                                    <p class="text-orange-500 font-semibold mt-2">SAR893.00</p>
                                </div>
                            </div>
                            <!-- Card End -->
                            <!-- Card Start -->
                            <div
                                class="min-w-[240px] max-w-[240px] bg-white rounded-xl overflow-hidden text-center p-1 group relative shrink-0">
                                <div class="text-center p-2 rounded-[10px] overflow-hidden">
                                    <img src="{{ asset('footer/06.07.2025_04.45.59_REC.png') }}" alt="Sun Glass"
                                        class="w-full rounded-[10px] object-cover">
                                </div>
                                <div
                                    class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-200 z-10">
                                    <button
                                        class="bg-[#FC4D03] text-white text-[10px] font-semibold px-4 py-2 rounded-lg shadow-lg flex items-center gap-1">
                                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.25 18.75C11.25 19.58 10.58 20.25 9.75 20.25C8.92 20.25 8.25 19.58 8.25 18.75C8.25 17.92 8.92 17.25 9.75 17.25C10.58 17.25 11.25 17.92 11.25 18.75ZM16.25 17.25C15.42 17.25 14.75 17.92 14.75 18.75C14.75 19.58 15.42 20.25 16.25 20.25C17.08 20.25 17.75 19.58 17.75 18.75C17.75 17.92 17.08 17.25 16.25 17.25ZM20.73 7.68L18.73 15.68C18.65 16.01 18.35 16.25 18 16.25H8C7.64 16.25 7.33 15.99 7.26 15.63L5.37 5.25H4C3.59 5.25 3.25 4.91 3.25 4.5C3.25 4.09 3.59 3.75 4 3.75H6C6.36 3.75 6.67 4.01 6.74 4.37L7.17 6.75H20C20.23 6.75 20.45 6.86 20.59 7.04C20.73 7.22 20.78 7.46 20.73 7.68ZM19.04 8.25H7.44L8.62 14.75H17.41L19.04 8.25Z"
                                                fill="#ffffff" />
                                        </svg>
                                        <span>QUICK ADD</span>
                                    </button>
                                </div>
                                <div class="px-4 py-3">
                                    <h3 class="text-md font-medium">Gavriel Bag</h3>
                                    <p class="text-orange-500 font-semibold mt-2">SAR893.00</p>
                                </div>
                            </div>
                            <!-- Card End -->
                            <!-- Card Start -->
                            <div
                                class="min-w-[240px] max-w-[240px] bg-white rounded-xl overflow-hidden text-center p-1 group relative shrink-0">
                                <div class="text-center p-2 rounded-[10px] overflow-hidden">
                                    <img src="{{ asset('footer/06.07.2025_04.45.35_REC.png') }}" alt="Sun Glass"
                                        class="w-full rounded-[10px] object-cover">
                                </div>
                                <div
                                    class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-200 z-10">
                                    <button
                                        class="bg-[#FC4D03] text-white text-[10px] font-semibold px-4 py-2 rounded-lg shadow-lg flex items-center gap-1">
                                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.25 18.75C11.25 19.58 10.58 20.25 9.75 20.25C8.92 20.25 8.25 19.58 8.25 18.75C8.25 17.92 8.92 17.25 9.75 17.25C10.58 17.25 11.25 17.92 11.25 18.75ZM16.25 17.25C15.42 17.25 14.75 17.92 14.75 18.75C14.75 19.58 15.42 20.25 16.25 20.25C17.08 20.25 17.75 19.58 17.75 18.75C17.75 17.92 17.08 17.25 16.25 17.25ZM20.73 7.68L18.73 15.68C18.65 16.01 18.35 16.25 18 16.25H8C7.64 16.25 7.33 15.99 7.26 15.63L5.37 5.25H4C3.59 5.25 3.25 4.91 3.25 4.5C3.25 4.09 3.59 3.75 4 3.75H6C6.36 3.75 6.67 4.01 6.74 4.37L7.17 6.75H20C20.23 6.75 20.45 6.86 20.59 7.04C20.73 7.22 20.78 7.46 20.73 7.68ZM19.04 8.25H7.44L8.62 14.75H17.41L19.04 8.25Z"
                                                fill="#ffffff" />
                                        </svg>
                                        <span>QUICK ADD</span>
                                    </button>
                                </div>
                                <div class="px-4 py-3">
                                    <h3 class="text-md font-medium">Gavriel Bag</h3>
                                    <p class="text-orange-500 font-semibold mt-2">SAR893.00</p>
                                </div>
                            </div>
                            <!-- Card End -->
                            <!-- Card Start -->
                            <div
                                class="min-w-[240px] max-w-[240px] bg-white rounded-xl overflow-hidden text-center p-1 group relative shrink-0">
                                <div class="text-center p-2 rounded-[10px] overflow-hidden">
                                    <img src="{{ asset('footer/06.07.2025_04.05.04_REC.png') }}" alt="Sun Glass"
                                        class="w-full rounded-[10px] object-cover">
                                </div>
                                <div
                                    class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-200 z-10">
                                    <button
                                        class="bg-[#FC4D03] text-white text-[10px] font-semibold px-4 py-2 rounded-lg shadow-lg flex items-center gap-1">
                                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.25 18.75C11.25 19.58 10.58 20.25 9.75 20.25C8.92 20.25 8.25 19.58 8.25 18.75C8.25 17.92 8.92 17.25 9.75 17.25C10.58 17.25 11.25 17.92 11.25 18.75ZM16.25 17.25C15.42 17.25 14.75 17.92 14.75 18.75C14.75 19.58 15.42 20.25 16.25 20.25C17.08 20.25 17.75 19.58 17.75 18.75C17.75 17.92 17.08 17.25 16.25 17.25ZM20.73 7.68L18.73 15.68C18.65 16.01 18.35 16.25 18 16.25H8C7.64 16.25 7.33 15.99 7.26 15.63L5.37 5.25H4C3.59 5.25 3.25 4.91 3.25 4.5C3.25 4.09 3.59 3.75 4 3.75H6C6.36 3.75 6.67 4.01 6.74 4.37L7.17 6.75H20C20.23 6.75 20.45 6.86 20.59 7.04C20.73 7.22 20.78 7.46 20.73 7.68ZM19.04 8.25H7.44L8.62 14.75H17.41L19.04 8.25Z"
                                                fill="#ffffff" />
                                        </svg>
                                        <span>QUICK ADD</span>
                                    </button>
                                </div>
                                <div class="px-4 py-3">
                                    <h3 class="text-md font-medium">Gavriel Bag</h3>
                                    <p class="text-orange-500 font-semibold mt-2">SAR893.00</p>
                                </div>
                            </div>
                            <!-- Card End -->
                            <!-- Card Start -->
                            <div
                                class="min-w-[240px] max-w-[240px] bg-white rounded-xl overflow-hidden text-center p-1 group relative shrink-0">
                                <div class="text-center p-2 rounded-[10px] overflow-hidden">
                                    <img src="{{ asset('footer/06.07.2025_04.46.08_REC.png') }}" alt="Sun Glass"
                                        class="w-full rounded-[10px] object-cover">
                                </div>
                                <div
                                    class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-200 z-10">
                                    <button
                                        class="bg-[#FC4D03] text-white text-[10px] font-semibold px-4 py-2 rounded-lg shadow-lg flex items-center gap-1">
                                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.25 18.75C11.25 19.58 10.58 20.25 9.75 20.25C8.92 20.25 8.25 19.58 8.25 18.75C8.25 17.92 8.92 17.25 9.75 17.25C10.58 17.25 11.25 17.92 11.25 18.75ZM16.25 17.25C15.42 17.25 14.75 17.92 14.75 18.75C14.75 19.58 15.42 20.25 16.25 20.25C17.08 20.25 17.75 19.58 17.75 18.75C17.75 17.92 17.08 17.25 16.25 17.25ZM20.73 7.68L18.73 15.68C18.65 16.01 18.35 16.25 18 16.25H8C7.64 16.25 7.33 15.99 7.26 15.63L5.37 5.25H4C3.59 5.25 3.25 4.91 3.25 4.5C3.25 4.09 3.59 3.75 4 3.75H6C6.36 3.75 6.67 4.01 6.74 4.37L7.17 6.75H20C20.23 6.75 20.45 6.86 20.59 7.04C20.73 7.22 20.78 7.46 20.73 7.68ZM19.04 8.25H7.44L8.62 14.75H17.41L19.04 8.25Z"
                                                fill="#ffffff" />
                                        </svg>
                                        <span>QUICK ADD</span>
                                    </button>
                                </div>
                                <div class="px-4 py-3">
                                    <h3 class="text-md font-medium">Gavriel Bag</h3>
                                    <p class="text-orange-500 font-semibold mt-2">SAR893.00</p>
                                </div>
                            </div>
                            <!-- Card End -->



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    @include('layouts.front-end.partials.modal._chatting', [
        'seller' => $product->seller,
        'user_type' => $product->added_by,
    ])

    <span id="route-review-list-product" data-url="{{ route('review-list-product') }}"></span>
    <span id="products-details-page-data" data-id="{{ $product['id'] }}"></span>
    <script src="{{ theme_asset(path: 'public/assets/front-end/js/product-details.js') }}"></script>
    <script src="{{ theme_asset(path: 'public/assets/front-end/js/custom.js') }}"></script>

    <script type="text/javascript" async="async"
        src="https://platform-api.sharethis.com/js/sharethis.js#property=5f55f75bde227f0012147049&product=sticky-share-buttons">
    </script>



@endsection
