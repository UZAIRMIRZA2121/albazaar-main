<?php

namespace App\Http\Controllers;

use App\Services\TryotoService;
use Illuminate\Http\Request;
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
                'originCity' => 'required|string',
                'destinationCity' => 'required|string',
                'weight' => 'required',
                'height' => 'nullable|numeric',
                'width' => 'nullable|numeric',
                'length' => 'nullable|numeric'
            ]);

            $response = $this->tryotoService->getDeliveryFees($validatedData);

            return response()->json([
                'success' => true,
                'data' => $response
            ]);
        } catch (\Exception $e) {
            \Log::error('Shipping options error: ' . $e->getMessage());
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

    public function createOrderFromData(array $validatedData)
    {
        $timestamp = date('ymdHis');
        $validatedData['orderId'] = 'test' . $timestamp;

        $orderData = [
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

        \Log::info('Creating Tryoto order:', $orderData);

        // This is your original Tryoto API call
        return $this->createOrder($orderData);
    }
}