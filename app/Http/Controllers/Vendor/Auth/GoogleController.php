<?php

namespace App\Http\Controllers\Vendor\Auth;

use App\Models\User;
use App\Models\Seller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        // dd("chchc");
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $finduser = Seller::where('google_id', $user->id)->first();

            if ($finduser) {
                Auth::login($finduser);
                return redirect()->intended('dashboard');
            } else {
                $uuid = Str::uuid()->toString();
                $newUser = Seller::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'image' => $user->avatar,
                    'google_id'=> $user->id,
                    'password' => $user->password = Hash::make($uuid . now())
                ]);

                Auth::login($newUser);
                return redirect()->intended('dashboard');
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
