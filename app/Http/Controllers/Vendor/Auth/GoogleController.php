<?php

namespace App\Http\Controllers\Vendor\Auth;

use App\Models\Chatting;
use App\Models\User;
use App\Models\Seller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Log;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {

        config([
            'services.vendor_google.client_id' => env('Vendor_GOOGLE_CLIENT_ID'),
            'services.vendor_google.client_secret' => env('Vendor_GOOGLE_CLIENT_SECRET'),
            'services.vendor_google.redirect' => env('Vendor_GOOGLE_REDIRECT_URI'),
        ]); 
        

        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {

        config([
            'services.vendor_google.client_id' => env('Vendor_GOOGLE_CLIENT_ID'),
            'services.vendor_google.client_secret' => env('Vendor_GOOGLE_CLIENT_SECRET'),
            'services.vendor_google.redirect' => env('Vendor_GOOGLE_REDIRECT_URI'),
        ]);

        try {
            dd(Socialite::driver('google')->user());

            $user = Socialite::driver('google')->user();

            // Check if the user already exists
            $finduser = Seller::where('google_id', $user->id)->first();

            if ($finduser) {
                session(['new_email' => $finduser->email]);
                return redirect()->route('vendor.auth.registration.index');
            } else {
                // Create a new user
                $uuid = Str::uuid()->toString();
                $newUser = Seller::create([
                    'f_name' => $user->name,
                    'email' => $user->email,
                    'image' => $user->avatar,
                    'google_id' => $user->id,
                    'password' => Hash::make($uuid . now())  // Password will be hashed
                ]);
                session(['new_email' => $user->email]);
                // Start chat with user
                $this->startChatting($user->id);

                return redirect()->route('vendor.auth.registration.index');
                // return view('web-views.customer-views.auth.register', compact('newUser'));
                // return view('themes\default\web-views\seller-view\auth\register', compact('newUser'));
                // Log in the new user
                // Auth::login($newUser);

                // return redirect()->intended('dashboard');
            }

        } catch (\Exception $e) {
            dd('Google Callback Error: ' . $e->getMessage());
            // Log the error message for debugging
            Log::error('Google Callback Error: ' . $e->getMessage());

            // Optionally, you can return a custom message to the user
            return redirect()->route('login')->with('error', 'There was an issue logging in with Google. Please try again.');
        }
    }
    private function startChatting($receiverId)
    {
        Chatting::create([
            'seller_id' => $receiverId,
            'admin_id' => 1,
            'message' => 'Welcome to ALBAZAR',
            'sent_by_admin' => 1,
            'seen_by_admin' => 1,
            'seen_by_seller' => 0,
            'status' => 1,
            'notification_receiver' => 'seller',
        ]);
    }
}
