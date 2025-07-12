@extends('layouts.back-end.app')
@section('title', translate('order_List'))

@section('content')
    <div class="content container-fluid">
        <div>
            <div class="d-flex flex-wrap gap-2 align-items-center mb-3">
                <h2 class="h1 mb-0">
                    <img src="{{ dynamicAsset(path: 'public/assets/back-end/img/all-orders.png') }}" class="mb-1 mr-1"
                        alt="">
                    <span class="page-header-title">
                        @if ($status == 'processing')
                            {{ translate('packaging') }}
                        @elseif($status == 'failed')
                            {{ translate('failed_to_Deliver') }}
                        @elseif($status == 'all')
                            {{ translate('all') }}
                        @else
                            {{ translate(str_replace('_', ' ', $status)) }}
                        @endif
                    </span>
                    {{ translate('orders') }}
                </h2>
                <span class="badge badge-soft-dark radius-50 fz-14">{{ $orders->total() }}</span>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.orders.list', ['status' => request('status')]) }}" id="form-data"
                        method="GET">
                        <div class="row gx-2">
                            <div class="col-12">
                                <h4 class="mb-3 text-capitalize">{{ translate('filter_order') }}</h4>
                            </div>
                            @if (request('delivery_man_id'))
                                <input type="hidden" name="delivery_man_id" value="{{ request('delivery_man_id') }}">
                            @endif

                            <div class="col-sm-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label class="title-color text-capitalize"
                                        for="filter">{{ translate('order_type') }}</label>
                                    <select name="filter" id="filter" class="form-control">
                                        <option value="all" {{ $filter == 'all' ? 'selected' : '' }}>
                                            {{ translate('all') }}</option>
                                        <option value="admin" {{ $filter == 'admin' ? 'selected' : '' }}>
                                            {{ translate('in_House_Order') }}</option>
                                        <option value="seller" {{ $filter == 'seller' ? 'selected' : '' }}>
                                            {{ translate('vendor_Order') }}</option>
                                        @if (($status == 'all' || $status == 'delivered') && !request()->has('delivery_man_id'))
                                            <option value="POS" {{ $filter == 'POS' ? 'selected' : '' }}>
                                                {{ translate('POS_Order') }}</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-4 col-xl-3" id="seller_id_area"
                                style="{{ $filter && $filter == 'admin' ? 'display:none' : '' }}">
                                <div class="form-group">
                                    <label class="title-color" for="store">{{ translate('store') }}</label>
                                    <select name="seller_id" id="seller_id" class="form-control">
                                        <option value="all">{{ translate('all_shop') }}</option>
                                        <option value="0" id="seller_id_inhouse"
                                            {{ request('seller_id') == 0 ? 'selected' : '' }}>{{ translate('inhouse') }}
                                        </option>
                                        @foreach ($sellers as $seller)
                                            @isset($seller->shop)
                                                <option
                                                    value="{{ $seller->id }}"{{ request('seller_id') == $seller->id ? 'selected' : '' }}>
                                                    {{ $seller->shop->name }}
                                                </option>
                                            @endisset
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label class="title-color" for="customer">{{ translate('customer') }}</label>

                                    <input type="hidden" id='customer_id' name="customer_id"
                                        value="{{ request('customer_id') ? request('customer_id') : 'all' }}">
                                    <select id="customer_id_value"
                                        data-placeholder="@if ($customer == 'all') {{ translate('all_customer') }}
                                                    @else
                                                        {{ $customer->name ?? $customer->f_name . ' ' . $customer->l_name . ' ' . '(' . $customer->phone . ')' }} @endif"
                                        class="js-data-example-ajax form-control form-ellipsis">
                                        <option value="all">{{ translate('all_customer') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-4 col-xl-3">
                                <label class="title-color" for="date_type">{{ translate('date_type') }}</label>
                                <div class="form-group">
                                    <select class="form-control __form-control" name="date_type" id="date_type">
                                        <option value="" selected disabled>{{ translate('select_Date_Type') }}
                                        </option>
                                        <option value="this_year" {{ $dateType == 'this_year' ? 'selected' : '' }}>
                                            {{ translate('this_Year') }}</option>
                                        <option value="this_month" {{ $dateType == 'this_month' ? 'selected' : '' }}>
                                            {{ translate('this_Month') }}</option>
                                        <option value="this_week" {{ $dateType == 'this_week' ? 'selected' : '' }}>
                                            {{ translate('this_Week') }}</option>
                                        <option value="custom_date" {{ $dateType == 'custom_date' ? 'selected' : '' }}>
                                            {{ translate('custom_Date') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-4 col-xl-3" id="from_div">
                                <label class="title-color" for="customer">{{ translate('start_date') }}</label>
                                <div class="form-group">
                                    <input type="date" name="from" value="{{ $from }}" id="from_date"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-4 col-xl-3" id="to_div">
                                <label class="title-color" for="customer">{{ translate('end_date') }}</label>
                                <div class="form-group">
                                    <input type="date" value="{{ $to }}" name="to" id="to_date"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex gap-3 justify-content-end">
                                    <a href="{{ route('admin.orders.list', ['status' => request('status')]) }}"
                                        class="btn btn-secondary px-5">
                                        {{ translate('reset') }}
                                    </a>
                                    <button type="submit" class="btn btn--primary px-5" id="formUrlChange"
                                        data-action="{{ url()->current() }}">
                                        {{ translate('show_data') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <div class="px-3 py-4 light-bg">
                        <div class="row g-2 align-items-center flex-grow-1">
                            <div class="col-md-4">
                                <h5 class="text-capitalize d-flex gap-1">
                                    {{ translate('order_list') }}
                                    <span class="badge badge-soft-dark radius-50 fz-12">{{ $orders->total() }}</span>
                                </h5>
                            </div>
                            <div class="col-md-8 d-flex gap-3 flex-wrap flex-sm-nowrap justify-content-md-end">
                                <form action="" method="GET">
                                    <div class="input-group input-group-custom input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tio-search"></i>
                                            </div>
                                        </div>
                                        <input id="datatableSearch_" type="search" name="searchValue"
                                            class="form-control" placeholder="{{ translate('search_by_Order_ID') }}"
                                            aria-label="Search by Order ID" value="{{ $searchValue }}">
                                        <button type="submit"
                                            class="btn btn--primary input-group-text">{{ translate('search') }}</button>
                                    </div>
                                </form>
                                <div class="dropdown">
                                    <a type="button" class="btn btn-outline--primary text-nowrap"
                                        href="{{ route('admin.orders.export-excel', ['delivery_man_id' => request('delivery_man_id'), 'status' => $status, 'from' => $from, 'to' => $to, 'filter' => $filter, 'searchValue' => $searchValue, 'seller_id' => $vendorId, 'customer_id' => $customerId, 'date_type' => $dateType]) }}">
                                        <img width="14"
                                            src="{{ dynamicAsset(path: 'public/assets/back-end/img/excel.png') }}"
                                            class="excel" alt="">
                                        <span class="ps-2">{{ translate('export') }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive datatable-custom">
                        <table
                            class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100 text-start">
                            <thead class="thead-light thead-50 text-capitalize">
                                <tr>
                                    <th>{{ translate('SL') }}</th>
                                    <th>{{ translate('order_ID') }}</th>
                                    <th class="text-capitalize">{{ translate('order_date') }}</th>
                                    <th class="text-capitalize">{{ translate('customer_info') }}</th>
                                    <th>{{ translate('store') }}</th>
                                    <th class="text-capitalize">{{ translate('total_amount') }}</th>
                                    <th class="text-capitalize">{{ translate('Commission') }}</th>
                                    <th class="text-capitalize">{{ translate('Shipping cost') }}</th>
                                    <th class="text-capitalize">{{ translate('Shipping Commission') }}</th>
                                    <th class="text-capitalize">{{ translate('Shipping Services') }}</th>
                                    <th class="text-capitalize">{{ translate('Shipping Services Id') }}</th>
                                    <th class="text-capitalize">{{ translate('tax') }}</th>
                                    @if ($status == 'all')
                                        <th class="text-center">{{ translate('order_status') }} </th>
                                    @else
                                        <th class="text-capitalize">{{ translate('payment_method') }} </th>
                                    @endif
                                    <th class="text-center">{{ translate('action') }}</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($orders as $key => $order)

                                    <tr class="status-{{ $order['order_status'] }} class-all">
                                        <td class="">
                                            {{ $orders->firstItem() + $key }}
                                        </td>

                                        <td>
                                            <a class="title-color"
                                                href="{{ route('admin.orders.details', ['id' => $order['id']]) }}">{{ $order['id'] }}
                                                {!! $order->order_type == 'POS' ? '<span class="text--primary">(POS)</span>' : '' !!}</a>
                                        </td>
                                        <td>
                                            <div>{{ date('d M Y', strtotime($order['created_at'])) }},</div>
                                            <div>{{ date('h:i A', strtotime($order['created_at'])) }}</div>
                                        </td>
                                        <td>
                                            @if ($order->is_guest)
                                                <strong class="title-name">{{ translate('guest_customer') }}</strong>
                                            @elseif($order->customer_id == 0)
                                                <strong class="title-name">{{ translate('walking_customer') }}</strong>
                                            @else
                                                @if ($order->customer)
                                                    <a class="text-body text-capitalize"
                                                        href="{{ route('admin.orders.details', ['id' => $order['id']]) }}">
                                                        <strong
                                                            class="title-name">{{ $order->customer['f_name'] . ' ' . $order->customer['l_name'] }}</strong>
                                                    </a>
                                                    @if ($order->customer['phone'])
                                                        <a class="d-block title-color"
                                                            href="tel:{{ $order->customer['phone'] }}">{{ $order->customer['phone'] }}</a>
                                                    @else
                                                        <a class="d-block title-color"
                                                            href="mailto:{{ $order->customer['email'] }}">{{ $order->customer['email'] }}</a>
                                                    @endif
                                                @else
                                                    <label class="badge badge-danger fz-12">
                                                        {{ translate('customer_not_found') }}
                                                    </label>
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                            @if (isset($order->seller_id) && isset($order->seller_is))
                                                <a href="{{ $order->seller_is == 'seller' && $order->seller?->shop ? route('admin.vendors.view', ['id' => $order->seller->shop->id]) : 'javascript:' }}"
                                                    class="store-name font-weight-medium">
                                                    @if ($order->seller_is == 'seller')
                                                        {{ isset($order->seller?->shop) ? $order->seller?->shop?->name : translate('Store_not_found') }}
                                                    @elseif($order->seller_is == 'admin')
                                                        {{ translate('in_House') }}
                                                    @endif
                                                </a>
                                            @else
                                                {{ translate('Store_not_found') }}
                                            @endif
                                        </td>
                                        <td>
                                            <div>
                                                @php($orderTotalPriceSummary = \App\Utils\OrderManager::getOrderTotalPriceSummary(order: $order))
                                                {{ setCurrencySymbol(amount: usdToDefaultCurrency(amount: $orderTotalPriceSummary['totalAmount']), currencyCode: getCurrencyCode()) }}
                                            </div>

                                            @if ($order->payment_status == 'paid')
                                                <span class="badge badge-soft-success">{{ translate('paid') }}</span>
                                            @else
                                                <span class="badge badge-soft-danger">{{ translate('unpaid') }}</span>
                                            @endif
                                        </td>

                                        <td class="">
                                            {{ setCurrencySymbol(amount: usdToDefaultCurrency(amount: $order->admin_commission), currencyCode: getCurrencyCode()) }}
                                        </td>
                                        <td class="">
                                            {{ setCurrencySymbol(amount: usdToDefaultCurrency(amount: $order->shipping_cost), currencyCode: getCurrencyCode()) }}
                                        </td>
                                        <td class="">
                                            $ {{ $order->shipping_commission }}
                                        </td>


                                        <td class="">
                                            {{ $order->service_name }}
                                        </td>
                                        <td class="">
                                            {{ $order->option_id }}
                                        </td>

                                        <td class="">
                                            {{ setCurrencySymbol(amount: usdToDefaultCurrency(amount: $order->details->sum('tax')), currencyCode: getCurrencyCode()) }}
                                        </td>
                                        @if ($status == 'all')
                                            <td class="text-center text-capitalize">
                                                @if ($order['order_status'] == 'pending')
                                                    <span class="badge badge-soft-info fz-12">
                                                        {{ translate($order['order_status']) }}
                                                    </span>
                                                @elseif($order['order_status'] == 'processing' || $order['order_status'] == 'out_for_delivery')
                                                    <span class="badge badge-soft-warning fz-12">
                                                        {{ str_replace('_', ' ', $order['order_status'] == 'processing' ? translate('packaging') : translate($order['order_status'])) }}
                                                    </span>
                                                @elseif($order['order_status'] == 'confirmed')
                                                    <span class="badge badge-soft-success fz-12">
                                                        {{ translate($order['order_status']) }}
                                                    </span>
                                                @elseif($order['order_status'] == 'failed')
                                                    <span class="badge badge-danger fz-12">
                                                        {{ translate('failed_to_deliver') }}
                                                    </span>
                                                @elseif($order['order_status'] == 'delivered')
                                                    <span class="badge badge-soft-success fz-12">
                                                        {{ translate($order['order_status']) }}
                                                    </span>
                                                @else
                                                    <span class="badge badge-soft-danger fz-12">
                                                        {{ translate($order['order_status']) }}
                                                    </span>
                                                @endif
                                            </td>
                                        @else
                                            <td class="text-capitalize">
                                                {{ str_replace('_', ' ', $order['payment_method']) }}
                                            </td>
                                        @endif
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <a class="btn btn-outline--primary square-btn btn-sm mr-1"
                                                    title="{{ translate('view') }}"
                                                    href="{{ route('admin.orders.details', ['id' => $order['id']]) }}">
                                                    <img src="{{ dynamicAsset(path: 'public/assets/back-end/img/eye.svg') }}"
                                                        class="svg" alt="">
                                                </a>
                                                <a class="btn btn-outline-success square-btn btn-sm mr-1" target="_blank"
                                                    title="{{ translate('invoice') }}"
                                                    href="{{ route('admin.orders.generate-invoice', [$order['id']]) }}">
                                                    <i class="tio-download-to"></i>
                                                </a>

                                                <button
                                                    class="btn btn-outline-info square-btn btn-sm mr-1 view-details-btn"
                                                    data-toggle="modal"
                                                    data-target="#orderDetailsModal-{{ $order['id'] }}">
                                                    <i class="tio-info-outlined"></i> View
                                                </button>

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive mt-4">
                        <div class="d-flex justify-content-lg-end">
                            {!! $orders->links() !!}
                        </div>
                    </div>
                    @if (count($orders) == 0)
                        @include(
                            'layouts.back-end._empty-state',
                            ['text' => 'no_order_found'],
                            ['image' => 'default']
                        )
                    @endif
                </div>
            </div>
            <div class="js-nav-scroller hs-nav-scroller-horizontal d-none">
                <span class="hs-nav-scroller-arrow-prev d-none">
                    <a class="hs-nav-scroller-arrow-link" href="javascript:">
                        <i class="tio-chevron-left"></i>
                    </a>
                </span>

                <span class="hs-nav-scroller-arrow-next d-none">
                    <a class="hs-nav-scroller-arrow-link" href="javascript:">
                        <i class="tio-chevron-right"></i>
                    </a>
                </span>
                <ul class="nav nav-tabs page-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">{{ translate('order_list') }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    @foreach ($orders as $order)
        <div class="modal fade" id="orderDetailsModal-{{ $order['id'] }}" tabindex="-1" role="dialog"
            aria-labelledby="orderDetailsModalLabel-{{ $order['id'] }}" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex flex-wrap flex-md-nowrap gap-10 justify-content-between mb-4">
                                <div class="d-flex flex-column gap-10">
                                    <h4 class="text-capitalize">{{ translate('Order_ID') }} #{{ $order['id'] }}</h4>
                                    <div class="">
                                        {{ date('d M, Y , h:i A', strtotime($order['created_at'])) }}
                                    </div>

                                </div>
                                <div class="text-sm-right flex-grow-1">
                                    <div class="d-flex flex-wrap gap-10 justify-content-end">
                                        @if ($order->verificationImages && count($order->verificationImages) > 0 && $order->verification_status == 1)
                                            <div>
                                                <button class="btn btn--primary px-4" data-toggle="modal"
                                                    data-target="#order_verification_modal"><i class="tio-verified"></i>
                                                    {{ translate('order_verification') }}
                                                </button>
                                            </div>
                                        @endif

                                        @if (getWebConfig('map_api_status') == 1 && isset($shippingAddress->latitude) && isset($shippingAddress->longitude))
                                            <div class="">
                                                <button class="btn btn--primary px-4" data-toggle="modal"
                                                    data-target="#locationModal"><i class="tio-map"></i>
                                                    {{ translate('show_locations_on_map') }}
                                                </button>
                                            </div>
                                        @endif

                                        <a class="btn btn--primary px-4" target="_blank"
                                            href={{ route('admin.orders.generate-invoice', [$order['id']]) }}>
                                            <img src="{{ dynamicAsset(path: 'public/assets/back-end/img/icons/uil_invoice.svg') }}"
                                                alt="" class="mr-1">
                                            {{ translate('print_Invoice') }}
                                        </a>
                                    </div>
                                    <div class="d-flex flex-column gap-2 mt-3">
                                        <div class="order-status d-flex justify-content-sm-end gap-10 text-capitalize">
                                            <span class="title-color">{{ translate('status') }}: </span>
                                            @if ($order['order_status'] == 'pending')
                                                <span
                                                    class="badge color-caribbean-green-soft font-weight-bold radius-50 d-flex align-items-center py-1 px-2">{{ translate(str_replace('_', ' ', $order['order_status'])) }}</span>
                                            @elseif($order['order_status'] == 'failed')
                                                <span
                                                    class="badge badge-soft-danger font-weight-bold radius-50 d-flex align-items-center py-1 px-2">{{ translate(str_replace('_', ' ', $order['order_status'] == 'failed' ? 'Failed to Deliver' : '')) }}
                                                </span>
                                            @elseif($order['order_status'] == 'processing' || $order['order_status'] == 'out_for_delivery')
                                                <span
                                                    class="badge badge-soft-warning font-weight-bold radius-50 d-flex align-items-center py-1 px-2">
                                                    {{ translate(str_replace('_', ' ', $order['order_status'] == 'processing' ? 'Packaging' : $order['order_status'])) }}
                                                </span>
                                            @elseif($order['order_status'] == 'delivered' || $order['order_status'] == 'confirmed')
                                                <span
                                                    class="badge badge-soft-success font-weight-bold radius-50 d-flex align-items-center py-1 px-2">
                                                    {{ translate(str_replace('_', ' ', $order['order_status'])) }}
                                                </span>
                                            @else
                                                <span
                                                    class="badge badge-soft-danger font-weight-bold radius-50 d-flex align-items-center py-1 px-2">
                                                    {{ translate(str_replace('_', ' ', $order['order_status'])) }}
                                                </span>
                                            @endif
                                        </div>

                                        <div class="payment-method d-flex justify-content-sm-end gap-10 text-capitalize">
                                            <span class="title-color">{{ translate('payment_Method') }} :</span>
                                            <strong>{{ translate($order['payment_method']) }}</strong>
                                        </div>

                                        @if (
                                            $order->payment_method != 'cash_on_delivery' &&
                                                $order->payment_method != 'pay_by_wallet' &&
                                                !isset($order->offlinePayments))
                                            <div
                                                class="reference-code d-flex justify-content-sm-end gap-10 text-capitalize">
                                                <span class="title-color">{{ translate('reference_Code') }} :</span>
                                                <strong>{{ str_replace('_', ' ', $order['transaction_ref']) }}
                                                    {{ $order->payment_method == 'offline_payment' ? '(' . $order->payment_by . ')' : '' }}</strong>
                                            </div>
                                        @endif

                                        <div class="payment-status d-flex justify-content-sm-end gap-10">
                                            <span class="title-color">{{ translate('payment_Status') }}:</span>
                                            @if ($order['payment_status'] == 'paid')
                                                <span class="text-success payment-status-span font-weight-bold">
                                                    {{ translate('paid') }}
                                                </span>
                                            @else
                                                <span class="text-danger payment-status-span font-weight-bold">
                                                    {{ translate('unpaid') }}
                                                </span>
                                            @endif
                                        </div>

                                        @if (getWebConfig('order_verification'))
                                            <span class="">
                                                <b>
                                                    {{ translate('order_verification_code') }} :
                                                    {{ $order['verification_code'] }}
                                                </b>
                                            </span>
                                        @endif

                                    </div>
                                </div>
                            </div>
                            @if ($order->order_note != null)
                                <div class="mt-2 mb-5 w-100 d-block">
                                    <div class="gap-10">
                                        <h4>{{ translate('order_Note') }}:</h4>
                                        <div class="text-justify">{{ $order->order_note }}</div>
                                    </div>
                                </div>
                            @endif
                            <div class="table-responsive datatable-custom">
                                <table
                                    class="table fz-12 table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100">
                                    <thead class="thead-light thead-50 text-capitalize">
                                        <tr>
                                            <th>{{ translate('SL') }}</th>
                                            <th>{{ translate('item_details') }}</th>
                                            <th>{{ translate('item_price') }}</th>
                                            <th>{{ translate('tax') }}</th>
                                            <th>{{ translate('item_discount') }}</th>
                                            <th>{{ translate('total_price') }}</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @php($item_price = 0)
                                        @php($total_price = 0)
                                        @php($subtotal = 0)
                                        @php($total = 0)
                                        @php($discount = 0)
                                        @php($tax = 0)
                                        @php($row = 0)
                                        @foreach ($order->details as $key => $detail)
                                            @php($productDetails = $detail?->productAllStatus ?? json_decode($detail->product_details))
                                            @if ($productDetails)
                                                <tr>
                                                    <td>{{ ++$row }}</td>
                                                    <td>
                                                        <div class="media align-items-center gap-10">
                                                            <img class="avatar avatar-60 rounded img-fit"
                                                                src="{{ getStorageImages(path: $detail?->productAllStatus?->thumbnail_full_url, type: 'backend-product') }}"
                                                                alt="{{ translate('image_Description') }}">
                                                            <div>
                                                                <h6 class="title-color">
                                                                    {{ substr($productDetails->name, 0, 30) }}{{ strlen($productDetails->name) > 10 ? '...' : '' }}
                                                                </h6>
                                                                <div><strong>{{ translate('qty') }} :</strong>
                                                                    {{ $detail['qty'] }}
                                                                </div>
                                                                <div>
                                                                    <strong>{{ translate('unit_price') }} :</strong>
                                                                    {{ setCurrencySymbol(amount: usdToDefaultCurrency(amount: $detail['price'] + ($detail->tax_model == 'include' ? $detail['tax'] / $detail['qty'] : 0))) }}
                                                                    @if ($detail->tax_model == 'include')
                                                                        ({{ translate('tax_incl.') }})
                                                                    @else
                                                                        ({{ translate('tax') . ':' . $productDetails->tax }}{{ $productDetails->tax_type === 'percent' ? '%' : '' }})
                                                                    @endif

                                                                </div>
                                                                @if ($detail->variant)
                                                                    <div>
                                                                        <strong>
                                                                            {{ translate('variation') }} :
                                                                        </strong>
                                                                        {{ $detail['variant'] }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        @if (isset($productDetails->digital_product_type) && $productDetails->digital_product_type == 'ready_after_sell')
                                                            <button type="button" class="btn btn-sm btn--primary mt-2"
                                                                title="{{ translate('file_upload') }}"
                                                                data-toggle="modal"
                                                                data-target="#fileUploadModal-{{ $detail->id }}">
                                                                <i class="tio-file-outlined"></i> {{ translate('file') }}
                                                            </button>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{ setCurrencySymbol(amount: usdToDefaultCurrency(amount: $detail['price'] * $detail['qty']), currencyCode: getCurrencyCode()) }}
                                                    </td>
                                                    <td>
                                                        {{ setCurrencySymbol(amount: usdToDefaultCurrency(amount: $detail['tax']), currencyCode: getCurrencyCode()) }}
                                                    </td>
                                                    <td>{{ setCurrencySymbol(amount: usdToDefaultCurrency(amount: $detail['discount']), currencyCode: getCurrencyCode()) }}
                                                    </td>
                                                    @php($subtotal = $detail['price'] * $detail['qty'] + $detail['tax'] - $detail['discount'])
                                                    <td>{{ setCurrencySymbol(amount: usdToDefaultCurrency(amount: $subtotal), currencyCode: getCurrencyCode()) }}
                                                    </td>
                                                </tr>
                                                @php($item_price += $detail['price'] * $detail['qty'])
                                                @php($discount += $detail['discount'])
                                                @php($tax += $detail['tax'])
                                                @php($total += $subtotal)
                                            @endif
                                            @php($sellerId = $detail->seller_id)
                                            @if (isset($productDetails->digital_product_type) && $productDetails->digital_product_type == 'ready_after_sell')
                                                @php($product_details = json_decode($detail->product_details))
                                                <div class="modal fade" id="fileUploadModal-{{ $detail->id }}"
                                                    tabindex="-1" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <form
                                                                action="{{ route('admin.orders.digital-file-upload-after-sell') }}"
                                                                method="post" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="modal-body">
                                                                    @if ($detail?->digital_file_after_sell_full_url && isset($detail->digital_file_after_sell_full_url['key']))
                                                                        <div class="mb-4">
                                                                            {{ translate('uploaded_file') . ' : ' }}
                                                                            @php($downloadPathExist = $detail->digital_file_after_sell_full_url['status'])
                                                                            <span
                                                                                data-file-path="{{ $downloadPathExist ? $detail->digital_file_after_sell_full_url['path'] : 'javascript:' }}"
                                                                                class="getDownloadFileUsingFileUrl btn btn-success btn-sm {{ $downloadPathExist ? '' : 'download-path-not-found' }}"
                                                                                title="{{ translate('download') }}">
                                                                                {{ translate('download') }} <i
                                                                                    class="tio-download"></i>
                                                                            </span>
                                                                        </div>
                                                                    @elseif($detail->digital_file_after_sell)
                                                                        <div class="mb-4">
                                                                            {{ translate('uploaded_file') . ' : ' }}
                                                                            @php($downloadPath = dynamicStorage(path: 'storage/app/public/product/digital-product/' . $detail->digital_file_after_sell))
                                                                            <span
                                                                                data-file-path="{{ file_exists($downloadPath) ? $downloadPath : 'javascript:' }}"
                                                                                class="getDownloadFileUsingFileUrl btn btn-success btn-sm {{ file_exists($downloadPath) ? $downloadPath : 'download-path-not-found' }}"
                                                                                title="{{ translate('download') }}">
                                                                                {{ translate('download') }} <i
                                                                                    class="tio-download"></i>
                                                                            </span>
                                                                        </div>
                                                                    @else
                                                                        <h4 class="text-center">
                                                                            {{ translate('file_not_found') . '!' }}</h4>
                                                                    @endif
                                                                    @if ($product_details->added_by == 'admin' && $detail->seller_id == 1)
                                                                        <div class="inputDnD">
                                                                            <div class="form-group inputDnD input_image input_image_edit"
                                                                                data-title="{{ translate('drag_&_drop_file_or_browse_file') }}">
                                                                                <input type="file"
                                                                                    name="digital_file_after_sell"
                                                                                    class="form-control-file text--primary font-weight-bold image-input"
                                                                                    accept=".jpg, .jpeg, .png, .gif, .zip, .pdf">
                                                                            </div>
                                                                        </div>
                                                                        <div class="mt-1 text-info">
                                                                            {{ translate('file_type') . ' ' . ':' . ' ' . 'jpg, jpeg, png, gif, zip, pdf' }}
                                                                        </div>
                                                                        <input type="hidden"
                                                                            value="{{ $detail->id }}" name="order_id">
                                                                    @else
                                                                        <h4 class="mt-3 text-center">
                                                                            {{ translate('admin_have_no_permission_for_vendors_digital_product_upload') }}
                                                                        </h4>
                                                                    @endif
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">{{ translate('close') }}</button>
                                                                    @if ($product_details->added_by == 'admin' && $detail->seller_id == 1)
                                                                        <button type="submit"
                                                                            class="btn btn--primary">{{ translate('upload') }}</button>
                                                                    @endif
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <hr />
                            @php($orderTotalPriceSummary = \App\Utils\OrderManager::getOrderTotalPriceSummary(order: $order))
                            <div class="row justify-content-md-end mb-3">
                                <div class="col-md-9 col-lg-8">
                                    <dl class="row gy-1 text-sm-right">
                                        <dt class="col-5">{{ translate('item_price') }}</dt>
                                        <dd class="col-6 title-color">
                                            <strong>{{ setCurrencySymbol(amount: usdToDefaultCurrency(amount: $orderTotalPriceSummary['itemPrice']), currencyCode: getCurrencyCode()) }}</strong>
                                        </dd>
                                        <dt class="col-5 text-capitalize">{{ translate('item_discount') }}</dt>
                                        <dd class="col-6 title-color">
                                            -
                                            <strong>{{ setCurrencySymbol(amount: usdToDefaultCurrency(amount: $orderTotalPriceSummary['itemDiscount']), currencyCode: getCurrencyCode()) }}</strong>
                                        </dd>
                                        <dt class="col-5 text-capitalize">{{ translate('sub_total') }}</dt>
                                        <dd class="col-6 title-color">
                                            <strong>{{ setCurrencySymbol(amount: usdToDefaultCurrency(amount: $orderTotalPriceSummary['subTotal']), currencyCode: getCurrencyCode()) }}</strong>
                                        </dd>
                                        <dt class="col-5 text-nowrap">
                                            {{ translate('coupon_discount') }}
                                            <br>
                                            {{ !in_array($order['coupon_code'], [0, null]) ? '(' . translate('expense_bearer_') . ($order['coupon_discount_bearer'] == 'inhouse' ? 'admin' : ($order['coupon_discount_bearer'] == 'seller' ? 'vendor' : $order['coupon_discount_bearer'])) . ')' : '' }}
                                        </dt>
                                        <dd class="col-6 title-color">
                                            -<strong>{{ setCurrencySymbol(amount: usdToDefaultCurrency(amount: $orderTotalPriceSummary['couponDiscount']), currencyCode: getCurrencyCode()) }}</strong>
                                        </dd>
                                        <dt class="col-5 text-uppercase">{{ translate('vat') }}/{{ translate('tax') }}
                                        </dt>
                                        <dd class="col-6 title-color">
                                            <strong>{{ setCurrencySymbol(amount: usdToDefaultCurrency(amount: $orderTotalPriceSummary['taxTotal']), currencyCode: getCurrencyCode()) }}</strong>
                                        </dd>
                                        <dt class="col-5 text-capitalize">
                                            {{ translate('delivery_fee') }}
                                            <br>
                                            {{ $order['is_shipping_free'] ? '(' . translate('expense_bearer_') . ($order['free_delivery_bearer'] == 'seller' ? 'vendor' : $order['free_delivery_bearer']) . ')' : '' }}
                                        </dt>
                                        <dd class="col-6 title-color">
                                            <strong>{{ setCurrencySymbol(amount: usdToDefaultCurrency(amount: $orderTotalPriceSummary['shippingTotal']), currencyCode: getCurrencyCode()) }}</strong>
                                        </dd>

                                        <dt class="col-5"><strong>{{ translate('total') }}</strong></dt>
                                        <dd class="col-6 title-color">
                                            <strong>{{ setCurrencySymbol(amount: usdToDefaultCurrency(amount: $orderTotalPriceSummary['totalAmount']), currencyCode: getCurrencyCode()) }}</strong>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    @endforeach

    <span id="message-date-range-text" data-text="{{ translate('invalid_date_range') }}"></span>
    <span id="js-data-example-ajax-url" data-url="{{ route('admin.orders.customers') }}"></span>
@endsection

@push('script_2')
    <script src="{{ dynamicAsset(path: 'public/assets/back-end/js/admin/order.js') }}"></script>
@endpush
