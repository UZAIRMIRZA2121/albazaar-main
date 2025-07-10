<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\PromotionTransaction;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use Carbon\Carbon;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Services\PayTabsService;

class FeaturedProductController extends Controller
{
    protected $paytabsService;

    public function __construct(PayTabsService $paytabsService)
    {
        $this->paytabsService = $paytabsService;
    }

    public function index(Request $request, $promotionId)
    {
        $promotion = Promotion::findOrFail($promotionId);
        $products = Product::where('user_id', Auth::guard('seller')->id())
            ->where('request_status', 1)
            ->where('status', 1)
            ->get();

        $categories = Category::all();

        return view('vendor-views.featured-products.view', compact('promotion', 'categories', 'products'));
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'promotion_id' => 'required|exists:promotions,id',
            'product_id' => 'required|array', // Accept multiple product IDs
            'product_id.*' => 'exists:products,id', // Validate each product ID in array
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Fetch selected products
        $products = Product::whereIn('id', $request->product_id)->get();

        // Check if any product is already featured
        foreach ($products as $product) {
            if ($product->featured == 1) {
                Toastr::error("Product '{$product->name}' is already featured", 'Error');
                return redirect()->back();
            }
        }

        // Get promotion details
        $promotion = Promotion::findOrFail($request->promotion_id);

        // Calculate total days
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);
        $daysDifference = $startDate->diffInDays($endDate);

        // Calculate total price for all selected products
        $total_price = $promotion->price * $daysDifference * count($products);

        // Create description
        $description = "You want to buy '{$promotion->promotion_type}' for {$daysDifference} days from {$startDate->format('Y-m-d')} to {$endDate->format('Y-m-d')}, with a total price of {$total_price} PKR.";

        // Get authenticated seller details
        $authenticatedUser = auth('seller')->user();

        // Prepare order data
        $order = [
            'cart_id' => uniqid(),
            'description' => $description,
            'amount' => $total_price,
            'customer_details' => [
                'name' => $authenticatedUser->f_name . ' ' . $authenticatedUser->l_name ?? 'Unknown',
                'email' => $authenticatedUser->email ?? 'No Email',
                'phone' => $authenticatedUser->phone ?? 'No Phone',
                'street1' => $authenticatedUser->shop_address ?? 'No Address',
                'city' => $authenticatedUser->city ?? 'No City',
                'state' => $authenticatedUser->state ?? 'No State',
                'country' => $authenticatedUser->country ?? 'Saudi Arabia',
                'zip' => $authenticatedUser->zip ?? 'No Zip',
                'ip' => request()->ip(),
            ]
        ];


        // Send order to payment gateway
        $paymentResponse = $this->paytabsService->createPayment($order);



        // Redirect to payment URL if available
        if (isset($paymentResponse['redirect_url'])) {
            // Store promotion transaction
            PromotionTransaction::create([
                'cart_id' => $order['cart_id'],
                'tran_ref' => $paymentResponse['tran_ref'] ?? null,
                'promotion_id' => $request->promotion_id,
                'product_ids' => $request->product_id,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'promotion_type' => $promotion->promotion_type,
            ]);

            return view('vendor-views.featured-products.paytabs_iframe', [
                'iframeUrl' => $paymentResponse['redirect_url'],
            ]);
        }

    }


    public function payment_return(Request $request, $id)
    {
        dd($id);
        $tranRef = session('tran_ref');

        $featuredProductData = session('featured_product_data');

        if (!$tranRef || !$featuredProductData) {
            return redirect()->route('vendor.dashboard.promotion.index')->with('error', 'Invalid transaction reference.');
        }

        $payment = $this->paytabsService->checkTransactionStatus($tranRef);

        if (isset($payment['payment_result']['response_status']) && $payment['payment_result']['response_status'] == 'A') {
            // Fetch multiple products
            $products = Product::whereIn('id', $featuredProductData['product_id'])->get();

            foreach ($products as $product) {
                $product->update([
                    'promotion_id' => $featuredProductData['promotion_id'],
                    'start_date' => $featuredProductData['start_date'],
                    'end_date' => $featuredProductData['end_date'],
                    'featured_till' => Carbon::now(),
                    'payment_status' => 1,
                ]);
            }

            // Clear session data
            session()->forget(['featured_product_data', 'tran_ref']);

            Toastr::success('Payment successful and products featured!', 'Success');
            return redirect()->route('vendor.featured-product.index', ['promotionId' => $featuredProductData['promotion_id']]);

        } else {
            Toastr::error('Payment failed.', 'Error');
            return redirect()->route('vendor.featured-product.index');
        }
    }

    public function showIframe(Request $request)
    {
        $order = [
            'cart_id' => 'ORDER123',
            'description' => 'Product Description',
            'amount' => 100,
            'return' => route('paytabs.return'),
            'customer_details' => [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'phone' => '1234567890',
                'street1' => 'Street 1',
                'city' => 'Karachi',
                'state' => 'Sindh',
                'country' => 'PK',
                'zip' => '75500',
            ],
        ];

        $payTabs = new PayTabsService();
        $iframeUrl = $payTabs->createPayment($order);

        if (!$iframeUrl) {
            return abort(500, 'Unable to get PayTabs URL');
        }

        return view('vendor-views.featured-products.paytabs_iframe', compact('iframeUrl'));
    }

    public function paymentReturn(Request $request, $id)
    {

        $cartId = $id;

        if (!$cartId) {
            return redirect()->route('vendor.dashboard.promotion.index')->with('error', 'Cart ID missing.');
        }

        // Fetch transaction by cart_id
        $transaction = PromotionTransaction::where('cart_id', $cartId)->first();

        if (!$transaction || !$transaction->tran_ref) {
            return redirect()->route('vendor.dashboard.promotion.index')->with('error', 'Transaction not found or missing reference.');
        }

        // Check status from PayTabs
        $payment = $this->paytabsService->checkTransactionStatus($transaction->tran_ref);

        if (isset($payment['payment_result']['response_status']) && $payment['payment_result']['response_status'] === 'A') {
            $transaction->update(['payment_status' => 1]);
            // Apply promotion to all products
            $products = Product::whereIn('id', $transaction->product_ids)->get();
          
            foreach ($products as $product) {
                $product->update([
                    'promotion_id' => $transaction->promotion_id,
                    'start_date' => $transaction->start_date,
                    'end_date' => $transaction->end_date,
                    'featured_till' => Carbon::parse($transaction->end_date),
                    'payment_status' => 1,
                    'featured' => 1,
                ]);
            }

            Toastr::success('Payment successful and products featured!', 'Success');
            return redirect()->route('vendor-views.featured-products.payment_success', ['promotionId' => $transaction->promotion_id]);
        } else {
            Toastr::error('Payment failed.', 'Error');
            return redirect()->route('vendor-views.featured-products.payment_failed');
        }
    }


}
