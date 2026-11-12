<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bienvenue sur LoudZone</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <!-- On enlève le overflow-hidden pour permettre le scroll si l'écran est petit -->
    <body class="bg-gray-900 text-white antialiased font-sans">

        <!-- ========================================== -->
        <!-- L'ARRIÈRE-PLAN VIDÉO (En fixed)            -->
        <!-- ========================================== -->
        <!-- fixed inset-0 garantit que la vidéo couvre tout l'écran sans gêner le scroll -->
        <video autoplay loop muted playsinline class="fixed inset-0 z-0 w-full h-full object-cover opacity-60">
            <!-- <source src="{{ asset('videos/ton-fond.mp4') }}" type="video/mp4" /> -->
        </video>

        <!-- Filtre bordeaux fixe -->
        <div class="fixed inset-0 z-0 bg-[#48041B]/50 mix-blend-multiply"></div>

        <!-- ========================================== -->
        <!-- LE CONTENEUR PRINCIPAL FLEX                -->
        <!-- ========================================== -->
        <div class="relative z-10 flex flex-col min-h-screen">

            <!-- LA NAVIGATION (Tout en haut) -->
            <div class="w-full">
                @livewire('navigation-menu')
            </div>

            <!-- LE CONTENU CENTRAL (Prend tout l'espace disponible au milieu) -->
            <main class="flex-grow flex items-center justify-center p-4 my-8">

                <div class="w-full max-w-2xl px-8 py-12 bg-white/95 backdrop-blur-sm shadow-2xl rounded-3xl border-t-4 border-[#48041B] text-center">

                    <!-- Le Logo -->
                    <div class="flex justify-center mb-8">
                         <div class="scale-[2.5] origin-center">
                             <x-authentication-card-logo />
                         </div>
                    </div>

                    <!-- Titre principal -->
                    <h1 class="text-4xl md:text-5xl font-extrabold text-[#48041B] mb-6 tracking-tight">
                        Bienvenue sur LoudZone
                    </h1>

                    <!-- Petit texte d'accroche (Orienté Fan/Groupe) -->
                    <p class="text-gray-600 mb-10 text-lg">
                        Découvrez notre univers, nos prochains concerts et le merchandising officiel du groupe !
                    </p>

                    <!-- Les Boutons (Orientés Promotion et Vente) -->
                    <nav class="flex flex-col sm:flex-row items-center justify-center gap-4">

                        <!-- Bouton Boutique (accessible à tous) -->
                        <a href="{{ route('articleListPublic') }}" class="w-full sm:w-auto px-8 py-3 bg-[#48041B] text-white font-bold rounded-lg shadow-lg hover:bg-[#300211] transition-all hover:-translate-y-0.5">
                            Voir la boutique
                        </a>

                        <!-- Bouton Événements (Si tu as la route, sinon on mettra le lien plus tard) -->
                        <a href="{{route( 'eventListPublic' )}}" class="w-full sm:w-auto px-8 py-3 bg-white text-[#48041B] font-bold border-2 border-[#48041B] rounded-lg shadow-sm hover:bg-gray-50 transition-all hover:-translate-y-0.5">
                            Prochains concerts
                        </a>

                    </nav>

                </div>
            </main>

            <!-- ========================================== -->
            <!-- LE FOOTER (Poussé tout en bas par le flex) -->
            <!-- ========================================== -->
            <div class="w-full mt-auto">
                <livewire:public.Footer />
            </div>

        </div>

    </body>
</html>
