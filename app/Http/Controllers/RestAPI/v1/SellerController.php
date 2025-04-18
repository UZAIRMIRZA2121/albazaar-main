<?php

namespace App\Http\Controllers\RestAPI\v1;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Review;
use App\Models\Seller;
use App\Models\Shop;
use App\Traits\InHouseTrait;
use App\Utils\Helpers;
use App\Utils\ProductManager;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Arr;

class SellerController extends Controller
{
    use InHouseTrait;

    public function __construct(
        private Seller       $seller,
    )
    {
    }

    public function get_seller_info(Request $request)
    {
        $data = [];
        $sellerId = $request['seller_id'];
        $seller = $sellerId != 0 ? Seller::with(['shop'])->where(['id' => $request['seller_id']])->first(['id', 'f_name', 'l_name', 'phone', 'image', 'minimum_order_amount']) : null;

        $productIds = Product::active()
            ->when($sellerId == 0, function ($query) {
                return $query->where(['added_by' => 'admin']);
            })
            ->when($sellerId != 0, function ($query) use ($sellerId) {
                return $query->where(['added_by' => 'seller'])
                    ->where('user_id', $sellerId);
            })
            ->withCount('reviews')
            ->pluck('id')->toArray();

        $avgRating = Review::active()->whereIn('product_id', $productIds)->avg('rating');
        $totalReview = Review::active()->whereIn('product_id', $productIds)->count();
        $totalOrder = Review::active()->whereIn('product_id', $productIds)->groupBy('order_id')->count();
        $totalProduct = Product::active()
            ->when($sellerId == 0, function ($query) {
                return $query->where(['added_by' => 'admin']);
            })
            ->when($sellerId != 0, function ($query) use ($sellerId) {
                return $query->where(['added_by' => 'seller'])
                    ->where('user_id', $sellerId);
            })->count();

        $minimumOrderAmount = 0;
        $minimumOrderAmountStatus = getWebConfig(name: 'minimum_order_amount_status');
        $minimumOrderAmountBySeller = getWebConfig(name: 'minimum_order_amount_by_seller');
        $ratingPercentage = round(($avgRating * 100) / 5);
        if ($sellerId != 0 && $minimumOrderAmountStatus && $minimumOrderAmountBySeller) {
            $minimumOrderAmount = $seller['minimum_order_amount'];
            unset($seller['minimum_order_amount']);
        }

        $data['seller'] = $seller;
        $data['avg_rating'] = (float)$avgRating;
        $data['positive_review'] = round(($avgRating * 100) / 5);
        $data['total_review'] = $totalReview;
        $data['total_order'] = $totalOrder;
        $data['total_product'] = $totalProduct;
        $data['minimum_order_amount'] = $minimumOrderAmount;
        $data['rating_percentage'] = $ratingPercentage;

        return response()->json($data, 200);
    }

    public function get_seller_products($seller_id, Request $request): JsonResponse
    {
        $products = ProductManager::get_seller_products($seller_id, $request);
        $productsList = $products->total() > 0 ? Helpers::product_data_formatting($products->items(), true) : [];
        return response()->json([
            'total_size' => $products->total(),
            'limit' => (int)$request['limit'],
            'offset' => (int)$request['offset'],
            'products' => $productsList
        ]);
    }

    public function getSellerList(Request $request, $type)
    {
        $sellers = $this->seller->when($type == 'top', function($query){
                return $query->whereHas('orders');
            })
            ->approved()->with(['shop', 'orders', 'product.reviews' => function ($query) {
                $query->active();
            }])
            ->withCount(['orders', 'product' => function ($query) {
                $query->active();
            }])
            ->get()
            ->each(function ($seller) {
                $seller['temporary_close'] = (int)$seller?->shop?->temporary_close ?? 0;
                $seller->product?->map(function ($product) {
                    $product['rating'] = $product?->reviews?->where('status', 1)->pluck('rating')->sum();
                    $product['rating_count'] = $product->reviews?->where('status', 1)->count();
                    $product['rating_count'] = $product->reviews?->where('status', 1)->count();
                });
                $seller['total_rating'] = $seller?->product->pluck('rating')->sum();
                $seller['rating_count'] = $seller->product->pluck('rating_count')->sum();
                $seller['review_count'] = $seller->product->pluck('rating_count')->sum();
                $seller['average_rating'] = $seller['total_rating'] / ($seller['rating_count'] == 0 ? 1 : $seller['rating_count']);

                $currentDate = date('Y-m-d');
                $vacationStartDate = date('Y-m-d', strtotime($seller->shop->vacation_start_date));
                $vacationEndDate = date('Y-m-d', strtotime($seller->shop->vacation_end_date));
                $vacationStatus = (int)$seller?->shop?->vacation_status ?? 0;
                $seller->is_vacation_mode_now = $vacationStatus && ($currentDate >= $vacationStartDate) && ($currentDate <= $vacationEndDate) ? 1 : 0;

                unset($seller['product']);
                unset($seller['orders']);
        });

        $inhouseProducts = Product::active()->with(['reviews', 'rating'])
        ->withCount(['reviews' => function ($query) {
            $query->active();
        }])
        ->where(['added_by' => 'admin'])->get();
        $inhouseProductCount = $inhouseProducts->count();

        $inhouseReviewData = Review::active()->whereIn('product_id', $inhouseProducts->pluck('id'));
        $inhouseReviewDataCount = $inhouseReviewData->count();
        $inhouseRattingStatusPositive = 0;
        foreach ($inhouseReviewData->pluck('rating') as $singleRating) {
            ($singleRating >= 4 ? ($inhouseRattingStatusPositive++) : '');
        }

        $inhouseShop = $this->getInHouseShopObject();
        $inhouseShop->id = 0;

        $inhouseSeller = $this->getInHouseSellerObject();
        $inhouseSeller->id = 0;
        $inhouseSeller->total_rating = $inhouseReviewDataCount;
        $inhouseSeller->rating_count = $inhouseReviewDataCount;
        $inhouseSeller->review_count = $inhouseReviewDataCount;
        $inhouseSeller->product_count = $inhouseProductCount;
        $inhouseSeller->average_rating = $inhouseReviewData->avg('rating');
        $inhouseSeller->positive_review = $inhouseReviewDataCount != 0 ? ($inhouseRattingStatusPositive * 100) / $inhouseReviewDataCount : 0;
        $inhouseSeller->orders_count = Order::where(['seller_is' => 'admin'])->count();
        $inhouseSeller->temporary_close = (int)$inhouseShop->temporary_close ?? 0;
        $inhouseSeller->shop = $inhouseShop;
        $sellers->prepend($inhouseSeller);

        if ($type == 'top') {
            $sellers = ProductManager::getPriorityWiseTopVendorQuery(query: $sellers);
        } elseif ($type == 'new') {
            $sellers = $sellers->sortByDesc('id');
        } else {
            $sellers = ProductManager::getPriorityWiseVendorQuery(query: $sellers);
        }

        $currentPage = $request['offset'] ?? Paginator::resolveCurrentPage('page');
        $totalSize = $sellers->count();
        $sellers = $sellers->forPage($currentPage, $request->get('limit', DEFAULT_DATA_LIMIT));

        $sellers = new LengthAwarePaginator($sellers, $totalSize, $request->get('limit', DEFAULT_DATA_LIMIT), $currentPage, [
            'path' => Paginator::resolveCurrentPath(),
            'appends' => $request->all(),
        ]);

        return [
            'total_size' => $sellers->total(),
            'limit' => (int)$request['limit'],
            'offset' => (int)$request['offset'],
            'sellers' => $sellers->values()
        ];

    }

    public function more_sellers()
    {
        $topVendorsList = Shop::active()
            ->whereHas('seller', function($query){
                return $query->whereHas('orders');
            })
            ->with(['seller' => function ($query) {
                $query->withCount(['orders']);
            }])
            ->get()
            ->sortByDesc(function ($shop) {
                return $shop->seller->orders_count;
            });

        return array_values($topVendorsList->toArray());
    }

    public function get_seller_best_selling_products($seller_id, Request $request)
    {
        $products = ProductManager::get_seller_best_selling_products($request, $seller_id, $request['limit'], $request['offset']);
        $products['products'] = isset($products['products'][0]) ? Helpers::product_data_formatting($products['products'], true) : [];

        return response()->json($products, 200);
    }

    public function get_sellers_featured_product($seller_id, Request $request)
    {
        $user = Helpers::getCustomerInformation($request);
        $featuredProducts = Product::active()->with('reviews', 'rating')
            ->withCount(['wishList' => function ($query) use ($user) {
                $query->where('customer_id', $user != 'offline' ? $user->id : '0');
            }])
            ->where(['featured' => '1'])
            ->when($seller_id == '0', function ($query) {
                return $query->where(['added_by' => 'admin']);
            })
            ->when($seller_id != '0', function ($query) use ($seller_id) {
                return $query->where(['added_by' => 'seller', 'user_id' => $seller_id]);
            });

        $featuredProductsList = ProductManager::getPriorityWiseFeaturedProductsQuery(query: $featuredProducts, dataLimit: $request['limit'], offset: $request['offset']);
        $featuredProductsList?->map(function ($product) {
            $product['reviews_count'] = $product->reviews->count();
            $product['rating'] = isset($product?->rating[0]) ? $product->rating[0] : null;
        });

        return [
            'total_size' => $featuredProductsList->total(),
            'limit' => (int)$request['limit'],
            'offset' => (int)$request['offset'],
            'products' => $featuredProductsList->items() ? Helpers::product_data_formatting($featuredProductsList->items(), true) : []
        ];
    }

    public function get_sellers_recommended_products($seller_id, Request $request)
    {
        $products = Product::active()->with(['category','reviews'])
                    ->when($seller_id == '0', function ($query){
                        return $query->where(['added_by' => 'admin']);
                    })
                    ->when($seller_id != '0', function ($query) use ($seller_id) {
                        return $query->where(['added_by' => 'seller', 'user_id'=>$seller_id]);
                    })
                    ->withCount('orderDelivered')
                    ->withSum('tags', 'visit_count')
                    ->orderBy('order_delivered_count', 'desc')
                    ->orderBy('tags_sum_visit_count', 'desc')
                    ->paginate($request['limit'], ['*'], 'page', $request['offset']);

        $products?->map(function ($product) {
            $product['reviews_count'] = $product->reviews->count();
            $product['rating'] = isset($product?->rating[0]) ?$product->rating[0] : null;
        });


        return [
            'total_size' => $products->total(),
            'limit' => (int)$request['limit'],
            'offset' => (int)$request['offset'],
            'products' => $products ? Helpers::product_data_formatting($products, true) : []
        ];
    }
}
