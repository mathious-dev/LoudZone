<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bienvenue sur LoudZone</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    
    <!-- On modifie le body pour qu'il gère le fond vidéo et le conteneur principal -->
    <body class="relative flex flex-col items-center justify-center min-h-screen overflow-hidden bg-gray-900 text-white antialiased font-sans">
        
        <!-- ========================================== -->
        <!-- L'ARRIÈRE-PLAN VIDÉO                       -->
        <!-- ========================================== -->
        <video autoplay loop muted playsinline class="absolute z-0 w-auto min-w-full min-h-full max-w-none object-cover opacity-60">
            <!-- <source src="{{ asset('videos/ton-fond.mp4') }}" type="video/mp4" /> -->
        </video>

        <!-- Filtre bordeaux -->
        <div class="absolute z-0 inset-0 bg-[#48041B]/50 mix-blend-multiply"></div>

        <!-- ========================================== -->
        <!-- LE CONTENU CENTRAL (La carte de bienvenue) -->
        <!-- ========================================== -->
        <div class="relative z-10 w-full max-w-2xl px-8 py-12 bg-white/95 backdrop-blur-sm shadow-2xl rounded-3xl border-t-4 border-[#48041B] text-center mx-4">
            
            <!-- Le Logo (Optionnel, mais ça rend bien sur l'accueil) -->
            <div class="flex justify-center mb-8">
                 <!-- Utilise ton composant logo ici, ou une simple balise img -->
                 <div class="scale-[2.5] origin-center">
                     <x-authentication-card-logo />
                 </div>
            </div>

            <!-- Titre principal -->
            <h1 class="text-4xl md:text-5xl font-extrabold text-[#48041B] mb-6 tracking-tight">
                Bienvenue sur LoudZone
            </h1>   
            
            <!-- Petit texte d'accroche (Optionnel) -->
            <p class="text-gray-600 mb-10 text-lg">
                Connectez-vous pour accéder à votre espace ou rejoignez-nous dès maintenant !
            </p>

            <!-- ========================================== -->
            <!-- LA NAVIGATION (Boutons de connexion)       -->
            <!-- ========================================== -->
            @if (Route::has('login'))
                <nav class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    @auth
                        <!-- Bouton si l'utilisateur est déjà connecté -->
                        <a href="{{ route('articleListPublic') }}" class="w-full sm:w-auto px-8 py-3 bg-[#48041B] text-white font-bold rounded-lg shadow-lg hover:bg-[#300211] transition-all hover:-translate-y-0.5">
                            Accéder au site
                        </a>
                    @else
                        <!-- Boutons si c'est un visiteur -->
                        <a href="{{ route('login') }}" class="w-full sm:w-auto px-8 py-3 bg-white text-[#48041B] font-bold border-2 border-[#48041B] rounded-lg shadow-sm hover:bg-gray-50 transition-all hover:-translate-y-0.5">
                            Se connecter
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-3 bg-[#48041B] text-white font-bold rounded-lg shadow-lg hover:bg-[#300211] transition-all hover:-translate-y-0.5">
                                S'inscrire
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif

        </div>
        
    </body>
</html>