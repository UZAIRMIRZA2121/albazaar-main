<?php

namespace App\Http\Controllers\CustomVendor;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use App\Models\Shop; // Adjust model name if different
use Illuminate\Http\Request;

class CustomVendorController extends Controller
{
    public function vendor_add(Request $request)
    {
        
        // Validate the email to check if it already exists
        $email = $request->input('email_add');
    
        $existingSeller = Seller::where('email', $email)->first();
        // if ($existingSeller) {
        //     // If the email exists, return a response indicating it's already taken
        //     return response()->json(['message' => 'Email is already taken.'], 400);
        // }
    
        $seller = new Seller();
        $seller->email = $email;
        $fullName = $request->input('name_vendor');
        $nameParts = explode(' ', $fullName);
        $l_name = array_pop($nameParts); 
        $seller->l_name = $l_name;
        $seller->f_name = implode(' ', $nameParts); 
    
        $seller->phone = $request->input('phone_vendor');
        $seller->password = bcrypt($request->input('password_vendor')); 
        $seller->save();
         session()->put('seller_id', $seller->id);
        // Return a response indicating the insertion was successful
        return response()->json(['message' => 'Seller added successfully!', 'seller' => $seller]);
    }
    
    public function checkShopName(Request $request)
    {
        $shopName = $request->input('shop_name');

        // Check if the shop name exists
        $exists = Shop::where('name', $shopName)->exists();

        return response()->json(['exists' => $exists]);
    }

    public function store(Request $request)
    {
        // Retrieve the seller ID from the session
        $sellerId = session('seller_id');
        $seller = Seller::find($sellerId);
    
        if (!$seller) {
            return redirect()->back()->with('error', 'Seller not found!');
        }
    
        try {
            // Update seller attributes with request data
            $seller->radio_check = $request->input('radio_check', $seller->radio_check);
            $seller->business_day = $request->input('businessName', $seller->businessName);
            $seller->establishment = $request->input('establishment', $seller->establishment);
            $seller->city = $request->input('city', $seller->city);
            $seller->shop_address = $request->input('shop_address', $seller->shop_address);
            $seller->latitude = $request->input('latitude', $seller->latitude);
            $seller->longitude = $request->input('longitude', $seller->longitude);
            $seller->shop_name = $request->input('shop_name', $seller->shop_name);
            $seller->category = $request->input('category', $seller->category);
            $seller->brief_here = $request->input('brief_here', $seller->brief_here);
          
            // Save the updated seller data
            $seller->save();
               // Now, handle the shop data
        $shopData = [
            'seller_id' => $seller->id, // Link to the seller's ID
            'name' => $request->input('shop_name'),
            'slug' => ($request->input('shop_name')), // Create slug based on the shop name
            'address' => $request->input('shop_address'),
        ];

        // Store shop data in the 'shops' table
        $shop = new Shop($shopData);
        $shop->save();
        return redirect()->back()->with('success', 'Your form has been submitted successfully!');
            // Redirect with success message
            
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Error updating seller: ' . $e->getMessage());
            dd('Error updating seller: ' . $e->getMessage());
            // Redirect with error message
            return redirect()->back()->with('error', 'Something went wrong! Please try again.');
        }
    }
    
}
