<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        //Méthode de laravel pour allez vers la page de connexion Google
        //le with permet de metre une option supplémentaire
        //le prompt c'est un paramètre google
        return Socialite::driver('google')->with(['prompt' => 'select_account'])->redirect();
    }
    public function returnFromGoogle()
    {
        //Méthode de laravel pour revenir de la page de Google avec les informations
        $googleUser=Socialite::driver('google')->user();
        $user=User::findOrCreateGoogleUser($googleUser);
        Auth::login($user);
        return redirect()->route('articleListPublic');
    }
}
