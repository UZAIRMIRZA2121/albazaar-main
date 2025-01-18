<?php

namespace App\Http\Controllers\Vendor\Auth;

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
        Config::set('services.facebook.client_id', env('FACEBOOK_CLIENT_ID'));
        Config::set('services.facebook.client_secret', env('FACEBOOK_CLIENT_SECRET'));
        Config::set('services.facebook.redirect', env('FACEBOOK_REDIRECT_URL'));
        // Debug the configuration to ensure values are correctly set
     
    
        // Redirect to Facebook for authentication
        return Socialite::driver('facebook')->redirect();
    }
    
    public function loginWithFacebook()
    {
        config([
            'services.facebook.client_id' => '1007819224509885',
            'services.facebook.client_secret' => '533dd425ade16943aa3fd954be9ff031',
            'services.facebook.redirect' => 'https://msonsmedicareservices.store/auth/facebook/callback',
        ]);
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
                Auth::login($createUser);
                  return redirect()->intended('dashboard');
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
