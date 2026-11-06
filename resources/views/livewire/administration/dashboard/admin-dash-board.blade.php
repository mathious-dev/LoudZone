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
            <a href="{{ route('admin.userList') }}" class="group bg-gray-50 rounded-xl border border-gray-200 p-6 flex flex-col items-center text-center hover:shadow-lg hover:border-indigo-300 hover:bg-indigo-50 hover:-translate-y-1 transition-all duration-200 cursor-pointer">
                <h2 class="text-sm font-bold text-gray-500 group-hover:text-indigo-600 uppercase tracking-wider mb-2">Utilisateurs inscrits</h2>
                <span class="text-3xl font-black text-gray-900 group-hover:text-indigo-700">{{ $countUser }}</span>
                <span class="mt-4 text-xs font-bold text-indigo-500 flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                    Voir les détails <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </span>
            </a>

            <!-- Carte 2 : Abonnés Newsletter -->
            <a href="{{ route('admin.userList',['newsLetter'=>true]) }}" class="group bg-gray-50 rounded-xl border border-gray-200 p-6 flex flex-col items-center text-center hover:shadow-lg hover:border-indigo-300 hover:bg-indigo-50 hover:-translate-y-1 transition-all duration-200 cursor-pointer">
                <h2 class="text-sm font-bold text-gray-500 group-hover:text-indigo-600 uppercase tracking-wider mb-2">Abonnés Newsletter</h2>
                <span class="text-3xl font-black text-gray-900 group-hover:text-indigo-700">{{ $countUserNewsletter }}</span>
                <span class="mt-4 text-xs font-bold text-indigo-500 flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                    Voir les détails <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </span>
            </a>

            <!-- Carte 3 : Annonce en cours -->
            @if($announcementPublish)
            <a href="{{ route('admin.announcementList') }}" class="group bg-green-50 rounded-xl border border-green-200 p-6 flex flex-col items-center text-center hover:shadow-lg hover:border-green-400 hover:bg-green-100 hover:-translate-y-1 transition-all duration-200 cursor-pointer">
                <h2 class="text-sm font-bold text-green-700 uppercase tracking-wider mb-3">Annonce publiée</h2>
                <span class="text-lg font-black text-green-900">{{ $announcementPublish->label}}</span>
                <span class="mt-4 text-xs font-bold text-green-600 flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                    Gérer l'annonce <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </span>
            </a>
            @else
            <div class="bg-gray-50 rounded-xl border border-gray-200 p-6 flex flex-col items-center text-center">
                <h2 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-3">Annonce publiée</h2>
                <p class="text-sm font-medium text-gray-400 italic">Aucune annonce en cours</p>
            </div>
            @endif

            <!-- Carte 4 : Événement important -->
            @if($eventPublish)
            <a href="{{ route('admin.eventListAdmin',['eventPublishLabel'=> $eventPublish->label]) }}" class="group bg-indigo-50 rounded-xl border border-indigo-200 p-6 flex flex-col items-center text-center hover:shadow-lg hover:border-indigo-400 hover:bg-indigo-100 hover:-translate-y-1 transition-all duration-200 cursor-pointer">
                <h2 class="text-sm font-bold text-indigo-700 uppercase tracking-wider mb-3">À la une</h2>
                <span class="text-lg font-black text-indigo-900">{{ $eventPublish->label}}</span>
                <span class="mt-4 text-xs font-bold text-indigo-600 flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                    Voir l'événement <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </span>
            </a>
            @else
            <div class="bg-gray-50 rounded-xl border border-gray-200 p-6 flex flex-col items-center text-center">
                <h2 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-3">À la une</h2>
                <p class="text-sm font-medium text-gray-400 italic">Aucun événement important</p>
            </div>
            @endif

        </div>
    </div>
</div>