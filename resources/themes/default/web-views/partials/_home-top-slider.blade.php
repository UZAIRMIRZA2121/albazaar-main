@if (count($bannerTypeMainBanner) > 0)

    {{-- hero section desktop --}}
    <div
        class="container-fluid mx-auto bg-[#FFEEE6] bg-[url('{{ asset('footer/06.07.2025_06.56.41_REC.png') }}')] bg-no-repeat bg-cover bg-center  md:pb-[30px] pb-[10px] md:pt-[50px] pt-[20px] hidden md:block">
        <div class="max-w-[100%] md:max-w-[100%] lg:md:max-w-[80%]  mx-auto justify-between items-center  text-sm py-2 ">
            <div class=" py-12 px-6 md:px-12">
                <div class="grid grid-cols-1 gap-9 owl-carousel  carousel-one">
                    @foreach ($bannerTypeMainBanner as $banner)
                        <div class="col-span-12 item relative bg-[url('{{ getStorageImages(path: $banner->photo_full_url, type: 'banner') }}')] my-5 bg-cover bg-center"
                            style="height: 400px;">

                            <!-- Make this container fill the banner and position items absolutely -->
                            <div class="absolute bottom-5 left-5">
                                <a href="#"
                                    class="inline-block bg-[#FC4D03] text-white py-3 px-6 rounded-lg font-semibold transition">
                                    SHOP NOW →
                                </a>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    {{-- hero section mobile --}}

    <div class="container-fluid mx-auto bg-[#FFEEE6]  md:pb-[30px] pb-[10px] md:pt-[50px] pt-[20px] md:hidden">
        <div
            class="max-w-[100%] md:max-w-[100%] lg:md:max-w-[80%]  mx-auto justify-between items-center  text-sm py-2 ">
            <div class=" py-4 px-4 md:px-12">
                <div class="grid grid-cols-1 gap-9 owl-carousel owl-theme carousel-six2">
                    @foreach ($bannerTypeMainBanner as $banner)
                        <div
                            class="col-span-12  bg-[url('{{ getStorageImages(path: $banner->photo_full_url, type: 'banner') }}')]">
                            <div class="max-w-7xl mx-auto flex flex-col lg:flex-row   gap-10">
                                <div class="flex-1 grid grid-cols-2 gap-6">
                                    <div class="mb-9">
                                        {{-- <img src="{{ asset('footer/06.07.2025_06.56.14_REC.png') }}" alt="Fashion 1"
                                            class="rounded-xl w-full h-full object-cover" /> --}}
                                    </div>
                                    <div class="mt-9">
                                        {{-- <img src="{{ asset('footer/06.07.2025_06.56.23_REC.png') }}" alt="Fashion 2"
                                            class="rounded-xl w-full h-full object-cover" /> --}}
                                    </div>
                                </div>
                                <div class="flex-1  lg:text-left">
                                  
                                    <a href="#"
                                        class="inline-block bg-[#FC4D03] text-white px-6 py-3 rounded-lg font-semibold  transition">
                                        SHOP NOW →
                                    </a>
                                </div>

                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>



@endif
