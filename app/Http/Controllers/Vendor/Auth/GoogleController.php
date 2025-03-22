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
        // Determine if the request is from "vendor" or "customer"
        $userType = request()->segment(1); // Get 'vendor' or 'customer' from the URL

        // Generate dynamic redirect URI using APP_URL
        $redirectUri = config('app.url') . "/$userType/auth/login/google/callback";

        // Override the redirect URI for this request
        config(['services.google.redirect' => $redirectUri]);

        //    dd(config('services.google')); // Debugging to confirm dynamic value

        return Socialite::driver('google')->redirect();
    }



    public function handleGoogleCallback()
    {
            // Determine if the request is from "vendor" or "customer"
            $userType = request()->segment(1); // Get 'vendor' or 'customer' from the URL

            // Generate dynamic redirect URI using APP_URL
            $redirectUri = config('app.url') . "/$userType/auth/login/google/callback";
    
            // Override the redirect URI for this request
            config(['services.google.redirect' => $redirectUri]);
    //   dd(config('services.google')); // Debugging to confirm dynamic value
        try {
            // Determine user type dynamically from the URL
            $userType = request()->segment(1); // 'vendor' or 'customer'

            // Get user details from Google
            $googleUser = Socialite::driver('google')->user();

            // Check if the user exists in the appropriate table
            if ($userType === 'vendor') {
                $existingUser = Seller::where('google_id', $googleUser->id)->first();
            } else {
                $existingUser = User::where('google_id', $googleUser->id)->first();
            }

            if ($existingUser) {
                // Log in the existing user
                Auth::login($existingUser);

                // Redirect based on user type
                return redirect()->route($userType . '.dashboard');
            } else {
                // Create a new user dynamically
                $uuid = Str::uuid()->toString();

                if ($userType === 'vendor') {
                    $newUser = Seller::create([
                        'f_name' => $googleUser->name,
                        'email' => $googleUser->email,
                        'image' => $googleUser->avatar,
                        'google_id' => $googleUser->id,
                        'password' => Hash::make($uuid . now())
                    ]);

                    // Start chat for vendor
                    $this->startChatting($googleUser->id);
                } else {
                    $newUser = User::create([
                        'name' => $googleUser->name,
                        'email' => $googleUser->email,
                        'profile_photo' => $googleUser->avatar,
                        'google_id' => $googleUser->id,
                        'password' => Hash::make($uuid . now())
                    ]);
                }

                // Log in the new user
                Auth::login($newUser);

                // Redirect user to their respective registration page
                return redirect()->route($userType . '.auth.registration.index');
            }
        } catch (\Exception $e) {
            Log::error('Google Callback Error: ' . $e->getMessage());
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
