<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartShipping;
use App\Models\Order;
use App\Services\TryotoService;
use App\Utils\CartManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TryotoController extends Controller
{
    private $tryotoService;

    public function __construct(TryotoService $tryotoService)
    {
        $this->tryotoService = $tryotoService;
    }

    public function getShippingOptions(Request $request)
    {

        try {
            $validatedData = $request->validate([
                'originCity' => 'nullable|array', // change this line to accept array
                'originCity.*' => 'string|nullable', // validate each item in the array
                'destinationCity' => 'required|string',
                'weight' => 'required',
                'height' => 'nullable|numeric',
                'width' => 'nullable|numeric',
                'length' => 'nullable|numeric',
            ]);


            $response = $this->tryotoService->getDeliveryFees($validatedData);

            return response()->json([
                'success' => true,
                'data' => $response
            ]);
        } catch (\Exception $e) {
            Log::error('Shipping options error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 422);
        }
    }

    public function createOrder(Request $request)
    {
        try {
            $orderData = $request->all(); // Validate and sanitize input as required.
            $response = $this->tryotoService->createOrder($orderData);
            return response()->json(['success' => true, 'data' => $response]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function createShipment(Request $request)
    {
        try {
            $orderId = $request->input('orderId');
            $deliveryOptionId = $request->input('deliveryOptionId');

            $response = $this->tryotoService->createShipment($orderId, $deliveryOptionId);
            return response()->json(['success' => true, 'data' => $response]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function trackShipment(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'trackingNumber' => 'required|string',
                'deliveryCompanyName' => 'required|string',
            ]);

            $trackingDetails = $this->tryotoService->trackShipment(
                $validatedData['trackingNumber'],
                $validatedData['deliveryCompanyName']
            );
            return response()->json(['success' => true, 'data' => $trackingDetails]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function getOrderTracking($orderId)
    {
        try {
            $tracking = $this->tryotoService->getOrderTracking($orderId);
            return response()->json($tracking);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function createOrderWithShipping(Request $request)
    {

        // Log the incoming payload for debugging
        Log::info('Order creation payload:', $request->all());

        try {

            // 1. Validate the request
            $validatedData = $request->validate([
                'orderId' => 'required|string',
                'pickupLocationCode' => 'required|string',
                'createShipment' => 'required',
                'deliveryOptionId' => 'required|integer',
                'payment_method' => 'required|string',
                'amount' => 'required|numeric',
                'currency' => 'required|string',
                'customer' => 'required|array',
                'customer.name' => 'required|string',
                'customer.email' => 'required|email',
                'customer.mobile' => 'required|string',
                'customer.address' => 'required|string',
                'customer.district' => 'required|string',
                'customer.city' => 'required|string',
                'customer.country' => 'required|string',
                'items' => 'required|array',
                'items.*.name' => 'required|string',
                'items.*.price' => 'required|numeric',
                'items.*.quantity' => 'required|integer',
                'items.*.sku' => 'required|string'
            ]);


            // 2. Format orderId like shown in dashboard
            $timestamp = date('ymdHis');
            $validatedData['orderId'] = 'test' . $timestamp;

            $orderData = [
                // Basic Order Details
                'orderId' => $validatedData['orderId'],
                'ref1' => '1234ABCDE',
                'pickupLocationCode' => '12364',
                'createShipment' => true,
                'deliveryOptionId' => (int) $validatedData['deliveryOptionId'],
                'storeName' => 'Brand A English',
                'payment_method' => $validatedData['payment_method'],
                'amount' => (float) $validatedData['amount'],
                'amount_due' => 0,
                'shippingAmount' => 20,
                'subtotal' => (float) $validatedData['amount'],
                'currency' => 'SAR',

                // Customs Info
                'customsValue' => '12',
                'customsCurrency' => 'SAR',
                'shippingNotes' => 'be careful. it is fragile',
                'packageSize' => 'small',

                // Package Info
                'packageCount' => 1,
                'packageWeight' => 1,
                'boxWidth' => 10,
                'boxLength' => 10,
                'boxHeight' => 10,

                // Meta Info
                'orderDate' => date('d/m/Y H:i'),
                'deliverySlotDate' => date('d/m/Y'),
                'deliverySlotFrom' => '2:30pm',
                'deliverySlotTo' => '12pm',
                'senderName' => 'Test Company',

                // Customer Details
                'customer' => [
                    'name' => $validatedData['customer']['name'],
                    'email' => $validatedData['customer']['email'],
                    'mobile' => $validatedData['customer']['mobile'],
                    'address' => $validatedData['customer']['address'],
                    'district' => $validatedData['customer']['district'],
                    'city' => $validatedData['customer']['city'],
                    'country' => $validatedData['customer']['country'],
                    'postcode' => '102030',
                    'lat' => '40.706333',
                    'lon' => '29.888211',
                    'refID' => '1000012',
                    'W3WAddress' => 'alarmed.cards.stuffy'
                ],

                // Items List
                'items' => array_map(function ($item) {
                    return [
                        'productId' => 90902,
                        'name' => $item['name'],
                        'price' => (float) $item['price'],
                        'rowTotal' => (float) $item['price'] * (int) $item['quantity'],
                        'taxAmount' => 15,
                        'quantity' => (int) $item['quantity'],
                        'sku' => $item['sku'],
                        'image' => 'http://....'
                    ];
                }, $validatedData['items'])
            ];


            // Log the formatted order data
            Log::info('Creating order with data:', $orderData);

            // 4. Make the API call to Tryoto service
            $response = $this->tryotoService->createOrder($orderData);

            // Log the response from the API
            Log::info('Order creation response:', ['response' => $response]);

            // 5. Return a success response
            return response()->json([
                'success' => true,
                'data' => $response,
                'orderId' => $validatedData['orderId'],
                'orderdata' => $validatedData
            ]);
        } catch (ValidationException $e) {
            // Log validation errors
            Log::error('Validation error:', ['errors' => $e->errors()]);

            // Return validation error response
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            // Log generic errors
            Log::error('Order creation error:', ['error' => $e->getMessage()]);

            // Return error response
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function testOrderCreation()
    {

        try {
            $orderData = [
                "orderId" => "test" . time() . rand(1000, 9999),
                "ref1" => "1234ABCDE",
                "pickupLocationCode" => "12364",
                "createShipment" => true,
                "deliveryOptionId" => "12364",
                "storeName" => "Brand A English",
                "payment_method" => "paid",
                "amount" => 100,
                "amount_due" => 0,
                "shippingAmount" => 20,
                "subtotal" => 100,
                "currency" => "SAR",
                "customsValue" => "12",
                "customsCurrency" => "USD",
                "shippingNotes" => "be careful. it is fragile",
                "packageSize" => "small",
                "packageCount" => 2,
                "packageWeight" => 1,
                "boxWidth" => 10,
                "boxLength" => 10,
                "boxHeight" => 10,
                "orderDate" => "30/12/2022 15:45",
                "deliverySlotDate" => "31/12/2022",
                "deliverySlotFrom" => "2:30pm",
                "deliverySlotTo" => "12pm",
                "customer" => [
                    "name" => "عبدالله الغامدي",
                    "email" => "test@test.com",
                    "mobile" => "546607389",
                    "address" => "6832, Abruq AR Rughamah District, Jeddah 22272 3330, Saudi Arabia",
                    "district" => "Al Hamra",
                    "city" => "Riyadh",
                    "country" => "SA",
                    "postcode" => "12345",
                    "lat" => "40.706333",
                    "lon" => "29.888211",
                    "refID" => "1000012",
                    "W3WAddress" => "alarmed.cards.stuffy"
                ],
                "items" => [
                    [
                        "productId" => 112,
                        "name" => "test product",
                        "price" => 100,
                        "quantity" => 1,
                        "sku" => "test-product",
                        "image" => "http://...."
                    ],
                    [
                        "name" => "test product 2",
                        "price" => 100,
                        "quantity" => 1,
                        "sku" => "test-product-2",
                        "image" => "http://...."
                    ]
                ]
            ];

            \Log::info('Testing order creation with data:', $orderData);

            $response = $this->tryotoService->createOrder($orderData);

            \Log::info('Test order creation response:', ['response' => $response]);

            return response()->json([
                'success' => true,
                'data' => $response
            ]);
        } catch (\Exception $e) {
            \Log::error('Test order creation failed:', [
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function createOrderFromData($transRef)
    {
        // 1️⃣ Fetch the Order
        $order = Order::with('orderDetails')->where('transaction_ref', $transRef)->first();


        if (!$order) {
            \Log::error("Order not found for transaction_ref: $transRef");
            return response()->json([
                'success' => false,
                'message' => 'Order not found'
            ], 404);
        }
        // 4️⃣ Generate unique orderId
        $orderId = 'order' . date('ymdHis');

        $order->update([
            'tryotto_order_id' => 'bazaar-' . $orderId
        ]);
        // 2️⃣ Extract shipping address
        $shipping = $order->shipping_address_data ?? (object) [];
        $customer = [
            'name' => $shipping->contact_person_name ?? 'Guest Customer',
            'email' => $shipping->email ?? 'guest@example.com',
            'mobile' => $shipping->phone ?? '000000000',
            'address' => $shipping->address ?? 'Unknown Address',
            'district' => $shipping->city ?? 'N/A',
            'city' => $shipping->city ?? 'N/A',
            'country' => $shipping->country ?? 'SA',
            'postcode' => $shipping->postal_code ?? '00000',
            'lat' => $shipping->latitude ?? '0.0000',
            'lon' => $shipping->longitude ?? '0.0000',
            'refID' => '1000012',
            'W3WAddress' => 'alarmed.cards.stuffy'
        ];

        // 3️⃣ Map items
        $items = [];
        foreach ($order->orderDetails as $detail) {
            // Decode the JSON from `product_details` column
            $product = json_decode($detail->product_details, true);

            $items[] = [
                'productId' => $product['id'] ?? 0,
                'name' => $product['name'] ?? 'Unknown Product',
                'price' => (float) $detail->price,
                'rowTotal' => (float) $detail->price * (int) $detail->qty,
                'taxAmount' => $detail->tax,
                'quantity' => (int) $detail->qty,
                'sku' => $product['code'] ?? 'N/A',
                'image' => isset($product['images'][0]['image_name'])
                    ? asset('storage/product/' . $product['images'][0]['image_name'])
                    : 'http://....'
            ];
        }


        // 5️⃣ Build the final array
        $orderData = [
            'orderId' => $orderId,
            'ref1' => '1234ABCDE',
            'pickupLocationCode' => '12364',
            'createShipment' => true,
            'deliveryOptionId' => (int) ($order->option_id ?? 12364),
            'storeName' => 'Brand A English',
            'payment_method' => $order->payment_method ?? 'paid',
            'amount' => (float) $order->order_amount,
            'amount_due' => 0,
            'shippingAmount' => (float) $order->shipping_cost,
            'subtotal' => (float) $order->order_amount,
            'currency' => 'SAR',
            'customsValue' => '12',
            'customsCurrency' => 'SAR',
            'shippingNotes' => 'be careful. it is fragile',
            'packageSize' => 'small',
            'packageCount' => 1,
            'packageWeight' => 1,
            'boxWidth' => 10,
            'boxLength' => 10,
            'boxHeight' => 10,
            'orderDate' => date('d/m/Y H:i'),
            'deliverySlotDate' => date('d/m/Y'),
            'deliverySlotFrom' => '2:30pm',
            'deliverySlotTo' => '12pm',
            'senderName' => 'Test Company',
            'customer' => $customer,
            'items' => $items
        ];
        \Log::info('Creating Tryoto order from data:', $orderData);
        return $this->tryotoService->createOrder($orderData);

    }

    public function updateShippingOption(Request $request)
    {



        // Validate the request
        $request->validate([
            'option_id' => 'required|integer',
            'price' => 'required',
            'chosen_shipping_id' => 'required',

        ]);
        $optionId = $request->input('option_id');
        $price = $request->input('price');
        $service_name = $request->input('service_name');
        $cart_group_id = $request->input('chosen_shipping_id');
        $totalQuantity = Cart::where('cart_group_id', $request->chosen_shipping_id)->where('is_checked', 1)->sum('quantity');

        log::info($request->all());

        $originalPrice = $price; // Store the original price
        $price *= 1.10; // Increase price by 10%
        $price = number_format($price, 2, '.', ''); // Format to 2 decimal places

        $shippingCommission = number_format($price - $originalPrice, 2, '.', ''); // Calculate the commission

        log::info($totalQuantity);

        $cart = CartShipping::updateOrCreate(
            ['cart_group_id' => $cart_group_id], // Condition to check existence
            [
                'shipping_method_id' => null,
                'option_id' => $optionId,
                'service_name' => $service_name,
                'shipping_cost' => $originalPrice,
                'shipping_comission' => $shippingCommission,
            ]
        );



        $chosenShipping = CartShipping::where('id', $request->chosen_shipping_id)->first();

        if ($chosenShipping) {

            $chosenShipping->option_id = $optionId;
            $chosenShipping->shipping_comission = $shippingCommission;
            $chosenShipping->service_name = $service_name;
            $chosenShipping->shipping_cost = $price;
            $chosenShipping->save();

            // Explicitly call the relationship and fetch the first cart
            $cart = $chosenShipping->cart()->first();

            if ($cart) {
                $cart->update(['shipping_cost' => $price]);
            }
        }



        // Process the shipping option (store in session, DB, etc.)
        session(['selected_shipping_option' => $optionId, 'selected_shipping_price' => $price]);

        // Return JSON response
        return response()->json([
            'success' => true,
            'message' => 'Shipping option updated successfully!',
            'option_id' => $optionId,
            'price' => $price
        ]);
    }
    public function storeWarehouse(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|max:50',
            'address' => 'required|string',
            'contactName' => 'nullable|string|max:255',
            'contactEmail' => 'nullable|email',
            'lat' => 'nullable|string',
            'lon' => 'nullable|string',
            'city' => 'nullable|string|max:255',
            'district' => 'nullable|string|max:255',
            'street' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'postcode' => 'nullable|string|max:20',
            'servingRadius' => 'nullable|string',
            'brandName' => 'nullable|string|max:255',
            'status' => 'nullable|string|in:active,inactive',
        ]);

        $sellerId = Auth::guard('seller')->id();
        $seller = \App\Models\Seller::findOrFail($sellerId);

        if ($seller->pickup_location_code) {
            // Update existing warehouse
            $validated['code'] = $seller->pickup_location_code;
            \Log::info('Updating warehouse:', $validated);
            $response = $this->tryotoService->updatePickupLocation($validated);
        } else {
            // Create new warehouse
            $validated['code'] = 'code-' . rand(100000, 999999);
            \Log::info('Creating warehouse:', $validated);
            $response = $this->tryotoService->createPickupLocation($validated);

            // Save generated code
            $seller->pickup_location_code = $validated['code'];
        }

        // ✅ Update Seller's address/location fields too
        $seller->shop_name = $validated['name'];
        $seller->shop_address = $validated['address'];
        $seller->city = $validated['city'];
        $seller->latitude = $validated['lat'];
        $seller->longitude = $validated['lon'];

        // You can update other fields if desired (like postcode, etc)
        $seller->save();

        return redirect()->back()->with('success', 'Warehouse saved successfully!');
    }



}