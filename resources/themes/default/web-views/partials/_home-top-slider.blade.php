@if (count($bannerTypeMainBanner) > 0)

    <div class="owl-carousel carousel-one">
        @foreach ($bannerTypeMainBanner as $banner)
            <div
                class="item bg-[url('{{ getStorageImages(path: $banner->photo_full_url, type: 'banner') }}')] bg-no-repeat bg-cover bg-center rounded-xl p-6 h-[500px]">

                <div class="max-w-7xl mx-auto flex flex-col lg:flex-row justify-between gap-10">
                    <div class="flex-1 text-center lg:text-left">
                        <h1 class="text-4xl md:text-[50px] font-bold leading-tight mb-4">
                            Discover a Smarter <br />
                            Way to Shop with <span class="text-[#FC4D03]">Albazar</span>
                        </h1>
                        <p class="text-[#383636] text-lg mb-6">
                            Explore a wide selection of electronics, fashion, perfumes, and more — handpicked for
                            quality, value, and everyday convenience.
                        </p>
                        <a href="{{ $banner['url'] }}"
                            class="inline-block bg-[#FC4D03] text-white px-6 py-3 rounded-lg font-semibold transition">
                            SHOP NOW →
                        </a>
                    </div>
                    {{-- <div class="flex-1 grid grid-cols-2 gap-6">
                                <div class="mb-9">
                                    <img src="{{ asset('footer/06.07.2025_06.56.14_REC.png') }}" alt="Fashion 1"
                                        class="rounded-xl w-full h-full object-cover" />
                                </div>
                                <div class="mt-9">
                                    <img src="{{ asset('footer/06.07.2025_06.56.23_REC.png') }}" alt="Fashion 2"
                                        class="rounded-xl w-full h-full object-cover" />
                                </div>
                            </div> --}}
                </div>
            </div>
        @endforeach
    </div>


    <div class="container-fluid mx-auto bg-[#FFEEE6]  md:pb-[30px] pb-[10px] md:pt-[50px] pt-[20px] md:hidden">
        <div
            class="max-w-[100%] md:max-w-[100%] lg:md:max-w-[80%]  mx-auto justify-between items-center  text-sm py-2 ">
            <div class=" py-4 px-4 md:px-12">
                <div class="grid grid-cols-1 gap-9 owl-carousel owl-theme carousel-six2">
                    <div class="col-span-12 ">
                        <div class="max-w-7xl mx-auto flex flex-col lg:flex-row   gap-10">
                            <div class="flex-1 grid grid-cols-2 gap-6">
                                <div class="mb-9">
                                    <img src="{{ asset('footer/06.07.2025_06.56.14_REC.png') }}" alt="Fashion 1"
                                        class="rounded-xl w-full h-full object-cover" />
                                </div>
                                <div class="mt-9">
                                    <img src="{{ asset('footer/06.07.2025_06.56.23_REC.png') }}" alt="Fashion 2"
                                        class="rounded-xl w-full h-full object-cover" />
                                </div>
                            </div>
                            <div class="flex-1  lg:text-left">
                                <h1 class="text-[22px] md:text-[50px] font-bold leading-tight mb-4">
                                    Discover a Smarter
                                    Way to Shop with <span class="text-[#FC4D03]">Albazar</span>
                                </h1>
                                <p class="text-[#383636] text-lg mb-6">
                                    Explore a wide selection of electronics, fashion, perfumes, and more —
                                    handpicked for quality, value, and everyday convenience.
                                </p>
                                <a href="#"
                                    class="inline-block bg-[#FC4D03] text-white px-6 py-3 rounded-lg font-semibold  transition">
                                    SHOP NOW →
                                </a>
                            </div>

                        </div>
                    </div>
                    <div class="col-span-12 ">
                        <div class="max-w-7xl mx-auto flex flex-col lg:flex-row   gap-10">
                            <div class="flex-1 grid grid-cols-2 gap-6">
                                <div class="mb-9">
                                    <img src="{{ asset('footer/06.07.2025_06.56.14_REC.png') }}" alt="Fashion 1"
                                        class="rounded-xl w-full h-full object-cover" />
                                </div>
                                <div class="mt-9">
                                    <img src="{{ asset('footer/06.07.2025_06.56.23_REC.png') }}" alt="Fashion 2"
                                        class="rounded-xl w-full h-full object-cover" />
                                </div>
                            </div>
                            <div class="flex-1  lg:text-left">
                                <h1 class="text-[22px] md:text-[50px] font-bold leading-tight mb-4">
                                    Discover a Smarter
                                    Way to Shop with <span class="text-[#FC4D03]">Albazar</span>
                                </h1>
                                <p class="text-[#383636] text-lg mb-6">
                                    Explore a wide selection of electronics, fashion, perfumes, and more —
                                    handpicked for quality, value, and everyday convenience.
                                </p>
                                <a href="#"
                                    class="inline-block bg-[#FC4D03] text-white px-6 py-3 rounded-lg font-semibold  transition">
                                    SHOP NOW →
                                </a>
                            </div>

                        </div>
                    </div>
                    <div class="col-span-12 ">
                        <div class="max-w-7xl mx-auto flex flex-col lg:flex-row   gap-10">
                            <div class="flex-1 grid grid-cols-2 gap-6">
                                <div class="mb-9">
                                    <img src="{{ asset('footer/06.07.2025_06.56.14_REC.png') }}" alt="Fashion 1"
                                        class="rounded-xl w-full h-full object-cover" />
                                </div>
                                <div class="mt-9">
                                    <img src="{{ asset('footer/06.07.2025_06.56.23_REC.png') }}" alt="Fashion 2"
                                        class="rounded-xl w-full h-full object-cover" />
                                </div>
                            </div>
                            <div class="flex-1  lg:text-left">
                                <h1 class="text-[22px] md:text-[50px] font-bold leading-tight mb-4">
                                    Discover a Smarter
                                    Way to Shop with <span class="text-[#FC4D03]">Albazar</span>
                                </h1>
                                <p class="text-[#383636] text-lg mb-6">
                                    Explore a wide selection of electronics, fashion, perfumes, and more —
                                    handpicked for quality, value, and everyday convenience.
                                </p>
                                <a href="#"
                                    class="inline-block bg-[#FC4D03] text-white px-6 py-3 rounded-lg font-semibold  transition">
                                    SHOP NOW →
                                </a>
                            </div>

                        </div>
                    </div>
                    <div class="col-span-12 ">
                        <div class="max-w-7xl mx-auto flex flex-col lg:flex-row   gap-10">
                            <div class="flex-1 grid grid-cols-2 gap-6">
                                <div class="mb-9">
                                    <img src="{{ asset('footer/06.07.2025_06.56.14_REC.png') }}" alt="Fashion 1"
                                        class="rounded-xl w-full h-full object-cover" />
                                </div>
                                <div class="mt-9">
                                    <img src="{{ asset('footer/06.07.2025_06.56.23_REC.png') }}" alt="Fashion 2"
                                        class="rounded-xl w-full h-full object-cover" />
                                </div>
                            </div>
                            <div class="flex-1  lg:text-left">
                                <h1 class="text-[22px] md:text-[50px] font-bold leading-tight mb-4">
                                    Discover a Smarter
                                    Way to Shop with <span class="text-[#FC4D03]">Albazar</span>
                                </h1>
                                <p class="text-[#383636] text-lg mb-6">
                                    Explore a wide selection of electronics, fashion, perfumes, and more —
                                    handpicked for quality, value, and everyday convenience.
                                </p>
                                <a href="#"
                                    class="inline-block bg-[#FC4D03] text-white px-6 py-3 rounded-lg font-semibold  transition">
                                    SHOP NOW →
                                </a>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endif
