<?php
namespace App\Http\Controllers;

use Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SSOLoginController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback()
{
    $googleUser = Socialite::driver('google')->stateless()->user();

    // Save or update the user
    $user = User::updateOrCreate(
        ['email' => $googleUser->getEmail()], // match existing user by email
        [
            'name' => $googleUser->getName(),
            'google_id' => $googleUser->getId(),
            'avatar' => $googleUser->getAvatar(),
            'email_verified_at' => now(), // optional
        ]
    );

    Auth::login($user);

    return redirect()->intended('/dashboard');
}

}
