<?php

namespace App\Http\Controllers\Auth\Social;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try {
            $user = Socialite::driver($provider)->user();
            $local_user = User::where('email', $user->email)->first();
            if (!isset($local_user)) {
                $local_user = User::query()->create([
                    'name' => $user->name ? $user->name : $user->nickname,
                    'email' => $user->email,
                    'password' => bcrypt('12345678'),
                    'email_verified_at' => now(),
                ]);
                $user_social = $local_user->socials()->create([
                    'provider_id' => $user->id,
                    'provider' => $provider,
                    'user_data' => $user->user,
                    'token' => $user->token,
                ]);
            }
            auth()->login($local_user);
            return redirect()->route('dashboard');
        }catch (\Exception $e) {
            Log::debug($e->getMessage());
           return redirect()->route('login')->with('error', 'Serverda muammo yuz berdi');
        }
    }
}
