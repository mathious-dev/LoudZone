<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bienvenue sur LoudZone</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    
    <body class="bg-gray-50 text-gray-900 flex flex-col items-center justify-center min-h-screen">
        
        <div class="text-center">
            <h1 class="text-5xl font-bold text-indigo-600 mb-8">
                Bienvenue sur le site de LoudZone
            </h1>   
            
            @if (Route::has('login'))
                <nav class="flex items-center justify-center gap-4">
                    @auth
                        <!-- Bouton si l'utilisateur est déjà connecté -->
                        <a href="{{ url('/dashboard') }}" class="px-6 py-2 bg-indigo-600 text-white font-semibold rounded-md shadow-sm hover:bg-indigo-700 transition">
                            Mon Dashboard
                        </a>
                    @else
                        <!-- Boutons si c'est un visiteur -->
                        <a href="{{ route('login') }}" class="px-6 py-2 bg-white text-gray-800 font-semibold border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 transition">
                            Se connecter
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-6 py-2 bg-indigo-600 text-white font-semibold rounded-md shadow-sm hover:bg-indigo-700 transition">
                                S'inscrire
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </div>
        
    </body>
</html>