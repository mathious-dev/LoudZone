<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 min-h-screen">
    
    <!-- Le "bon contour" qui englobe tout le tableau de bord -->
    <div class="bg-white border border-gray-200 rounded-2xl shadow-lg p-6 sm:p-10 min-h-[80vh]">
        
        <!-- En-tête du Dashboard -->
        <div class="mb-10 pb-5 border-b border-gray-100 text-center sm:text-left">
            <h1 class="text-3xl font-extrabold text-gray-900">Vue d'ensemble</h1>
            <p class="text-sm text-gray-500 mt-2">Statistiques et informations principales de votre plateforme.</p>
        </div>

        <!-- Grille des statistiques -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <!-- Carte 1 : Total Utilisateurs -->
            <div class="bg-gray-50 rounded-xl border border-gray-200 p-6 flex flex-col items-center text-center hover:shadow-md transition-shadow duration-200">
                <h2 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-2">Utilisateurs inscrits</h2>
                <p class="text-4xl font-extrabold text-[#5D0824]">{{ $countUser }}</p>
            </div>

            <!-- Carte 2 : Abonnés Newsletter -->
            <div class="bg-gray-50 rounded-xl border border-gray-200 p-6 flex flex-col items-center text-center hover:shadow-md transition-shadow duration-200">
                <h2 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-2">Abonnés Newsletter</h2>
                <div class="flex items-center space-x-3">
                    <p class="text-4xl font-extrabold text-[#5D0824]">{{ $countUserNewsletter }}</p>
                    @if($countUser > 0)
                        <!-- Pourcentage -->
                        <span class="text-sm font-bold text-green-700 bg-green-100 px-2.5 py-1 rounded-full shadow-sm">
                            {{ round(($countUserNewsletter / $countUser) * 100) }}%
                        </span>
                    @endif
                </div>
            </div>

            <!-- Carte 3 : Annonce en cours -->
            <div class="bg-gray-50 rounded-xl border border-gray-200 p-6 flex flex-col items-center text-center hover:shadow-md transition-shadow duration-200">
                <h2 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-3">Annonce publiée</h2>
                @if($announcementPublish)
                    <p class="text-base font-bold text-gray-900 line-clamp-3">{{ $announcementPublish->label }}</p>
                @else
                    <p class="text-sm font-medium text-gray-400 italic">Aucune annonce en cours</p>
                @endif
            </div>

            <!-- Carte 4 : Événement important -->
            <div class="bg-gray-50 rounded-xl border border-gray-200 p-6 flex flex-col items-center text-center hover:shadow-md transition-shadow duration-200">
                <h2 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-3">À la une</h2>
                @if($eventPublish)
                    <p class="text-base font-bold text-gray-900 line-clamp-3">{{ $eventPublish->label }}</p>
                @else
                    <p class="text-sm font-medium text-gray-400 italic">Aucun événement important</p>
                @endif
            </div>

        </div>

    </div>
</div>