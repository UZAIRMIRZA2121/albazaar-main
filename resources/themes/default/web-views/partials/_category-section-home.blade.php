@if ($categories->count() > 0)
<div class="container-fluid  bg-[#ffffff] mt-[15px] pb-[30px]">
    <div class="max-w-full lg:max-w-[78%] mx-auto text-sm py-2">
        <h2 class="text-2xl font-bold mb-6">{{ translate('Top Categories') }}</h2>

        <!-- Mobile: Horizontal scroll flex -->
        <div class="block md:hidden w-full overflow-x-auto">
            <div class="flex gap-4">
                @foreach ($categories->take(12) as $category)
                    <div class="flex flex-col items-center space-y-1">
                        <a href="{{ route('products', ['category_id' => $category['id'], 'data_from' => 'category', 'page' => 1]) }}" class="group">
                            <div
                                class="w-[85px] h-[85px] rounded-full flex items-center justify-center overflow-hidden border-[#EBF0F8] border-2 hover:border-[#2457AA] cursor-pointer">
                                <img src="{{ getStorageImages(path: $category->icon_full_url, type: 'category') }}"
                                     alt="{{ $category->name }}" class="w-full h-full object-cover">
                            </div>
                        </a>
                        <p class="text-gray-700 font-medium">{{ Str::limit($category->name, 12) }}</p>
                        <p class="text-gray-700 text-[12px]">{{ $category->product->count() ?? 0 }} Items</p>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Desktop: Grid layout -->
        <div class="hidden md:grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6 justify-center">
            @foreach ($categories->take(12) as $category)
                <div class="flex flex-col items-center text-center space-y-2">
                    <a href="{{ route('products', ['category_id' => $category['id'], 'data_from' => 'category', 'page' => 1]) }}" class="group">
                        <div class="w-[170px] h-[170px] rounded-full flex items-center justify-center overflow-hidden border-[#EBF0F8] border-4 hover:border-[#2457AA] cursor-pointer">
                            <img src="{{ getStorageImages(path: $category->icon_full_url, type: 'category') }}"
                                 alt="{{ $category->name }}" class="w-full h-full object-cover">
                        </div>
                    </a>
                    <p class="text-gray-700 font-medium">{{ Str::limit($category->name, 15) }}</p>
                    <p class="text-gray-700 font-medium">{{ $category->product->count() ?? 0 }} Items</p>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endif
