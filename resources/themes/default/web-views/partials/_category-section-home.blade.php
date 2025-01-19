

  <style>
    .carousel-item img {
      width: 100%;
      height: 300px; /* Set a consistent height */
      object-fit: cover;
    }
    .carousel-inner {
      display: flex;
    }
    #imageCarousel{
        background-color: #000000;
    }


  </style>
<!-- Carousel Wrapper -->
<div id="imageCarousel" class="carousel slide" data-bs-interval="false">
  <div class="carousel-inner">
    <!-- Slide 1 -->
    <div class="carousel-item active">
      <div class="row">
        <div class="col-md-3">
          <img src="http://127.0.0.1:8081/storage/shop/banner/2025-01-13-6785921b4137a.webp" alt="Image 1" class="img-fluid">
        </div>
        <div class="col-md-3">
          <img src="http://127.0.0.1:8081/storage/shop/banner/2025-01-13-6785921b4137a.webp" alt="Image 2" class="img-fluid">
        </div>
        <div class="col-md-3">
          <img src="http://127.0.0.1:8081/storage/shop/banner/2025-01-13-6785921b4137a.webp" alt="Image 3" class="img-fluid">
        </div>
        <div class="col-md-3">
          <img src="http://127.0.0.1:8081/storage/shop/banner/2025-01-13-6785921b4137a.webp" alt="Image 4" class="img-fluid">
        </div>
      </div>
    </div>
    <!-- Slide 2 -->
    <div class="carousel-item">
      <div class="row">
        <div class="col-md-3">
          <img src="http://127.0.0.1:8081/storage/shop/banner/2025-01-13-6785921b4137a.webp" alt="Image 5" class="img-fluid">
        </div>
        <div class="col-md-3">
          <img src="http://127.0.0.1:8081/storage/shop/banner/2025-01-13-6785921b4137a.webp" alt="Image 6" class="img-fluid">
        </div>
        <div class="col-md-3">
          <img src="http://127.0.0.1:8081/storage/shop/banner/2025-01-13-6785921b4137a.webp" alt="Image 7" class="img-fluid">
        </div>
        <div class="col-md-3">
          <img src="http://127.0.0.1:8081/storage/shop/banner/2025-01-13-6785921b4137a.webp" alt="Image 8" class="img-fluid">
        </div>
      </div>
    </div>
    <!-- Slide 3 -->
    <div class="carousel-item">
      <div class="row">
        <div class="col-md-3">
          <img src="http://127.0.0.1:8081/storage/shop/banner/2025-01-13-6785921b4137a.webp" alt="Image 9" class="img-fluid">
        </div>
        <div class="col-md-3">
          <img src="http://127.0.0.1:8081/storage/shop/banner/2025-01-13-6785921b4137a.webp" alt="Image 10" class="img-fluid">
        </div>
        <div class="col-md-3">
          <img src="http://127.0.0.1:8081/storage/shop/banner/2025-01-13-6785921b4137a.webp" alt="Image 11" class="img-fluid">
        </div>
        <div class="col-md-3">
          <img src="https://pk.image1993.com/cdn/shop/files/Solids_380ba464-8ebe-44a4-83dd-4c71a87cf0d5.jpg?v=1736586989" alt="Image 12" class="img-fluid">
        </div>
      </div>
    </div>
  </div>

  {{-- <!-- Controls -->
  <button class="carousel-control-prev" type="button" data-bs-target="#imageCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#imageCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button> --}}
</div>

<!-- jQuery for Custom Behavior -->
<script>
  $(document).ready(function () {
    // Carousel auto-scroll settings
    const interval = 2000; // Time between slides in ms

    // Custom smooth scrolling
    const $carousel = $('#imageCarousel');

    setInterval(() => {
      // Trigger the next slide
      $carousel.carousel('next');
    }, interval);

    // Optional: Ensure smooth scrolling on manual control
    $carousel.on('slide.bs.carousel', function () {
      $(this).find('.carousel-inner').css('transition', 'transform 0.5s ease-in-out');
    });
  });
</script>



@if ($categories->count() > 0 )
    <section class="pb-4 rtl">
        <div class="container">
            <div>
                <div class="card __shadow h-100 max-md-shadow-0">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="categories-title m-0">
                                <span class="font-semibold">{{ translate('categories')}}</span>
                            </div>
                            <div>
                                <a class="text-capitalize view-all-text web-text-primary"
                                   href="{{route('categories')}}">{{ translate('view_all')}}
                                    <i class="czi-arrow-{{Session::get('direction') === "rtl" ? 'left mr-1 ml-n1 mt-1 float-left' : 'right ml-1 mr-n1'}}"></i>
                                </a>
                            </div>
                        </div>
                        <div class="d-none d-lg-block">
                            <div class="row mt-3">
                                @foreach($categories as $key => $category)
                                    @if ($key < 8)
                                        <div class="text-center __m-5px __cate-item">
                                            <a href="{{route('products',['category_id'=> $category['id'],'data_from'=>'category','page'=>1])}}" class="d-flex flex-column align-items-center">
                                                <div class="__img">
                                                    <img alt="{{ $category->name }}"
                                                         src="{{ getStorageImages(path:$category->icon_full_url, type: 'category') }}">
                                                </div>
                                                <p class="text-center fs-13 font-semibold mt-2">{{Str::limit($category->name, 15)}}</p>
                                            </a>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="d-lg-none">
                            <div class="owl-theme owl-carousel categories--slider mt-3">
                                @foreach($categories as $key => $category)
                                    @if ($key<8)
                                        <div class="text-center m-0 __cate-item w-100">
                                            <a href="{{route('products',['category_id'=> $category['id'],'data_from'=>'category','page'=>1])}}">
                                                <div class="__img mw-100 h-auto">
                                                    <img alt="{{ $category->name }}"
                                                         src="{{ getStorageImages(path: $category->icon_full_url, type: 'category') }}">
                                                </div>
                                                <p class="text-center line--limit-2 small mt-2">{{ $category->name }}</p>
                                            </a>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
