<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    <!-- Titre de la page -->
    <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-10 text-center">
        Nos prochains événements
    </h1>

    <!-- Grille : 1 colonne (mobile), 2 (tablette), 3 (PC) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        
        @foreach ($listEvents as $event)
            <a href="{{ route('eventDetail', $event) }}" 
               class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition-all duration-300 flex flex-col group cursor-pointer hover:-translate-y-1">
                
                <!-- Image -->
                <div class="relative h-56 w-full overflow-hidden bg-gray-100">
                    @if($event->primary_image)
                        <img src="{{ asset('storage/'.$event->primary_image) }}" 
                             alt="{{ $event->label }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <!-- Image par défaut si vide -->
                        <div class="flex items-center justify-center h-full text-gray-400">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    @endif

                    <!-- Petit badge optionnel si l'événement est mis en avant -->
                    @if($event->is_important)
                        <div class="absolute top-4 right-4 bg-orange-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-md z-10">
                            À la une
                        </div>
                    @endif
                </div>
                
                <!-- Contenu de la carte -->
                <div class="p-6 flex flex-col flex-grow">
                    <!-- Titre (Passe en bordeaux au survol) -->
                    <h3 class="text-xl font-bold text-gray-900 mb-4 line-clamp-2 group-hover:text-[#5D0824] transition-colors">
                        {{ $event->label }}
                    </h3>
                    
                    <!-- Dates -->
                    <div class="flex items-start text-gray-600 text-sm mb-4 bg-gray-50 p-3 rounded-lg border border-transparent group-hover:border-[#5D0824]/20 transition-colors">
                        <!-- Icône calendrier bordeaux -->
                        <svg class="w-5 h-5 mr-3 text-[#5D0824] opacity-90 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <div>
                            <p><span class="font-semibold text-gray-700">Début :</span> {{ \Carbon\Carbon::parse($event->start_date)->translatedFormat('d F Y à H\hi') }}</p>
                            <p><span class="font-semibold text-gray-700">Fin :</span> {{ \Carbon\Carbon::parse($event->end_date)->translatedFormat('d F Y à H\hi') }}</p>
                        </div>
                    </div>

                    <!-- Faux bouton (Bordeaux qui s'assombrit légèrement au survol) -->
                    <div class="mt-auto pt-4 border-t border-gray-100">
                        <span class="text-[#5D0824] group-hover:text-[#48041B] font-semibold text-sm flex items-center justify-center w-full transition-colors">
                            En savoir plus 
                            <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </span>
                    </div>
                </div>
            </a>
        @endforeach

    </div>

    <!-- Pagination -->
    @if($listEvents->hasPages())
        <div class="mt-12">
            {{ $listEvents->links() }}
        </div>
    @endif

</div>