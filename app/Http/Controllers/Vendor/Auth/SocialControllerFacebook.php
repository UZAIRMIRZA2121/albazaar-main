<?php

namespace App\Http\Controllers\Vendor\Auth;

use App\Models\BusinessSetting;
use Exception;
use Validator;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\AdminProduct;
use App\Models\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Config;


class SocialControllerFacebook extends Controller
{

    public function facebookRedirect()
    {
        // Dynamically set Facebook credentials
        $business_setting = BusinessSetting::where('type', 'social_login')->first();
        $service = 'facebook';
        if ($business_setting) {
            // Decode the JSON string into an array
            $socialLogins = json_decode($business_setting->value, true);

            foreach ($socialLogins as $socialLogin) {
                if ($socialLogin['status'] == 1) { // Check if the login method is enabled
                    if ($socialLogin['login_medium'] == $service) {
                        // Set configuration dynamically based on the service
                        config([
                            "services.{$service}.client_id" => $socialLogin['client_id'],
                            "services.{$service}.client_secret" => $socialLogin['client_secret'],
                            "services.{$service}.redirect" => $service === 'google'
                                ? 'https://msonsmedicareservices.store/vendor/auth/login/google/callback'
                                : 'https://msonsmedicareservices.store/vendor/auth/facebook/callback',
                        ]);

                    }
                }
            }
        }

        // Redirect to Facebook for authentication
        return Socialite::driver('facebook')->redirect();
    }

    public function loginWithFacebook()
    {

        $business_setting = BusinessSetting::where('type', 'social_login')->first();
        $service = 'facebook';
        if ($business_setting) {
            // Decode the JSON string into an array
            $socialLogins = json_decode($business_setting->value, true);

            foreach ($socialLogins as $socialLogin) {
                if ($socialLogin['status'] == 1) { // Check if the login method is enabled
                    if ($socialLogin['login_medium'] == $service) {
                        // Set configuration dynamically based on the service
                        config([
                            "services.{$service}.client_id" => $socialLogin['client_id'],
                            "services.{$service}.client_secret" => $socialLogin['client_secret'],
                            "services.{$service}.redirect" => $service === 'google'
                                ? 'https://msonsmedicareservices.store/vendor/auth/login/google/callback'
                                : 'https://msonsmedicareservices.store/vendor/auth/facebook/callback',
                        ]);

                    }
                }
            }
        }
       
        // Debug the configuration to ensure values are correctly set
        try {
            $user = Socialite::driver('facebook')->stateless()->user();
            $existingUser = Seller::where('google_id', $user->id)->first();
            $stms_code = random_int(1000, 9999);
            if ($existingUser) {
                Auth::login($existingUser);
                return redirect()->intended('dashboard');
            } else {
                $uuid = Str::uuid()->toString();
                $createUser = Seller::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'image' => $user->avatar,
                    'google_id' => $user->id,
                    'password' => $user->password = Hash::make($uuid . now())
                ]);
                session(['new_email' => $user->email]);

                return redirect()->route('vendor.auth.registration.index');
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
