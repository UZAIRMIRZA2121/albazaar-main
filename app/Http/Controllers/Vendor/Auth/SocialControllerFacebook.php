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


class SocialControllerFacebook extends Controller
{
    public function facebookRedirect()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function loginWithFacebook()
    {
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
