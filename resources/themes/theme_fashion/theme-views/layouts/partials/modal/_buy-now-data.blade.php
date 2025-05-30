<form action="{{ route('cart.add') }}" method="POST">
    @csrf
    <div class="d-flex align-items-center justify-content-between mb-30">
        <h5 class="modal-title flex-grow-1 text-center" id="buyNowModalLabel">
            {{ translate('Shipping_Method') }}
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="d-flex gap-2 mb-3">
        <img src="{{ theme_asset('assets/img/icons/car.svg') }}" alt="">
        <div>{{ translate('Choose_Shipping_Method') }}</div>
    </div>

    <div class="form-group">
        <div class="border rounded p-3 d-flex flex-column gap-2">

            @foreach($shipping_method_list as $shippingMethodKey => $shippingMethod)
            <div class="d-flex gap-2 align-items-center">
                <input type="radio" class="w-auto" name="shipping_method_id" id="shipping_method_id-{{ $shippingMethod['id'] }}" value="{{ $shippingMethod['id'] }}" {{ $shippingMethodKey == 0 ? 'checked':'' }}>
                <label class="mb-0" for="shipping_method_id-{{ $shippingMethod['id'] }}">
                    {{ ucfirst($shippingMethod['title']) }} ({{ $shippingMethod['duration'] }}) {{ webCurrencyConverter($shippingMethod['cost']) }}
                </label>
            </div>
            @endforeach

            <input type="hidden" class="form-control" value="1" name="shipping_method_exist">

        </div>
    </div>

    <div class="row d-none">
        @foreach($productData as $inputKey => $productInputData)
            <div class="col-6">
                <label>
                    {{ $inputKey }}
                </label>
                <input type="text" class="form-control" value="{{ $productInputData }}" name="{{ $inputKey }}">
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-4">
        <button type="submit" class="btn btn-primary">
            {{ translate('Proceed_to_Checkout') }}
        </button>
    </div>
</form>
