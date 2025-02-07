<?php

namespace App\Http\Controllers\Vendor\Auth;

use App\Models\BusinessSetting;
use Illuminate\Support\Str;
use App\Models\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialControllerFacebook extends Controller
{
    /**
     * Redirect to Facebook authentication page
     */
    public function facebookRedirect()
    {
        $this->configureFacebook();

        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Handle Facebook login callback
     */
    public function loginWithFacebook()
    {
        $this->configureFacebook();

        try {
            // Retrieve user from Facebook
            $user = Socialite::driver('facebook')->stateless()->user();

            // Ensure email exists, otherwise, generate a placeholder
            $email = $user->getEmail() ?? 'fb_user_' . $user->getId() . '@facebook.com';

            // Check if user already exists
            $existingUser = Seller::where('facebook_id', $user->getId())->orWhere('email', $email)->first();

            if ($existingUser) {
                session(['new_email' => $existingUser->email]);
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
                return redirect()->route('vendor.auth.registration.index');
            }
        } catch (\Exception $e) {
            return redirect()->route('vendor.auth.login')->with('error', 'Facebook login failed. Please try again.');
        }
    }

    /**
     * Configure Facebook login dynamically
     */
    private function configureFacebook()
    {
        $business_setting = BusinessSetting::where('type', 'social_login')->first();
        $service = 'facebook';

        if ($business_setting) {
            $socialLogins = json_decode($business_setting->value, true);

            foreach ($socialLogins as $socialLogin) {
                if ($socialLogin['status'] == 1 && $socialLogin['login_medium'] == $service) {
                    config([
                        "services.{$service}.client_id" => $socialLogin['client_id'],
                        "services.{$service}.client_secret" => $socialLogin['client_secret'],
                        "services.{$service}.redirect" => url("/vendor/auth/facebook/callback"),
                    ]);
                }
            }
        }
    }
}
