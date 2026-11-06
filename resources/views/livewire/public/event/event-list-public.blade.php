<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    <!-- Titre de la page -->
    <h1 class="text-3xl md:text-4xl font-extrabold text-[#0B0A0B] mb-10 text-center">
        Nos prochains événements
    </h1>

    <!-- ZONE DE RECHERCHE ET FILTRES -->
    <div class="max-w-4xl mx-auto mb-16 space-y-4">
        
        <!-- 1. Barre de recherche (en haut, pleine largeur) -->
        <div class="w-full bg-white rounded-xl shadow-sm border border-[#84796F]/20 p-2">
            <x-search 
                :options="$tabSearchPossibility" 
                :listSearch="$listSearch" 
                :search="$search" 
                :searchWichColumn="$searchWichColumn" 
                :showList="$showList" 
            />
        </div>

        <!-- 2. Les autres filtres (en dessous, côte à côte) -->
        <div class="flex flex-col sm:flex-row gap-4">
            <!-- Tri Asc/Desc (Prend la moitié de l'espace sur PC) -->
            <div class="flex-1 bg-white rounded-xl shadow-sm border border-[#84796F]/20">
                <x-search-asc-desc :options="$tabSearchAscDescPossibility"/>
            </div>
            
            <!-- Filtre Événement important (Prend l'autre moitié) -->
            <div class="flex-1 bg-white rounded-xl shadow-sm border border-[#84796F]/20">
                <x-search-boolean label-true="Événement important" label-false="Événements classiques" />
            </div>
        </div>
    </div>

    <!-- Grille : 1 colonne (mobile), 2 (tablette), 3 (PC) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        
        @foreach ($listEvents as $event)
            <a href="{{ route('eventDetail', $event) }}" 
               class="bg-white rounded-2xl shadow-sm border border-[#84796F]/10 overflow-hidden hover:shadow-xl hover:border-[#5D0824]/30 transition-all duration-300 flex flex-col group cursor-pointer hover:-translate-y-1">
                
                <!-- Image -->
                <div class="relative h-56 w-full overflow-hidden bg-[#FAF1E3]/30">
                    @if($event->primary_image)
                        <img src="{{ asset('storage/'.$event->primary_image) }}" 
                             alt="{{ $event->label }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
                    @else
                        <!-- Image par défaut si vide -->
                        <div class="flex items-center justify-center h-full text-[#84796F]/40">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    @endif

                    <!-- Badge Événement important (Adapté aux couleurs du site) -->
                    @if($event->is_important)
                        <div class="absolute top-4 right-4 bg-[#5D0824] text-[#FAF1E3] text-xs font-black uppercase tracking-wider px-3 py-1.5 rounded-lg shadow-md z-10">
                            À la une
                        </div>
                    @endif
                </div>
                
                <!-- Contenu de la carte -->
                <div class="p-6 flex flex-col flex-grow">
                    <!-- Titre -->
                    <h3 class="text-xl font-black text-[#0B0A0B] mb-4 line-clamp-2 group-hover:text-[#5D0824] transition-colors">
                        {{ $event->label }}
                    </h3>
                    
                    <!-- Dates -->
                    <div class="flex items-start text-[#41342D] text-sm mb-6 bg-[#FAF1E3]/20 p-3.5 rounded-xl border border-transparent group-hover:border-[#5D0824]/10 transition-colors">
                        <!-- Icône calendrier -->
                        <svg class="w-5 h-5 mr-3 text-[#5D0824] opacity-80 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <div class="space-y-1">
                            <p><span class="font-bold text-[#0B0A0B]">Début :</span> {{ \Carbon\Carbon::parse($event->start_date)->translatedFormat('d F Y à H\hi') }}</p>
                            <p><span class="font-bold text-[#0B0A0B]">Fin :</span> {{ \Carbon\Carbon::parse($event->end_date)->translatedFormat('d F Y à H\hi') }}</p>
                        </div>
                    </div>

                    <!-- Bouton en bas -->
                    <div class="mt-auto pt-4 border-t border-[#84796F]/10">
                        <span class="text-[#5D0824] font-black text-sm uppercase tracking-wide flex items-center justify-center w-full transition-colors group-hover:text-[#0B0A0B]">
                            En savoir plus 
                            <svg class="w-4 h-4 ml-1.5 transform group-hover:translate-x-1.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </span>
                    </div>
                </div>
            </a>
        @endforeach

    </div>

    <!-- Message si aucun résultat -->
    @if($listEvents->isEmpty())
        <div class="text-center py-16 bg-white rounded-2xl border border-[#84796F]/20 shadow-sm mt-8">
            <svg class="mx-auto h-12 w-12 text-[#84796F]/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <h3 class="mt-4 text-lg font-black text-[#0B0A0B]">Aucun événement trouvé</h3>
            <p class="mt-2 text-sm text-[#84796F]">Essayez de modifier vos critères de recherche.</p>
        </div>
    @endif

    <!-- Pagination -->
    @if($listEvents->hasPages())
        <div class="mt-12 pt-6 border-t border-[#84796F]/10">
            {{ $listEvents->links() }}
        </div>
    @endif

</div>