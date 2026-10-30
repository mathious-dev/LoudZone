<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    
    <!-- Bouton Retour -->
    <div class="mb-6">
        <!-- Remplace '#' par la route de ta liste d'événements publique, ex: route('events.index') -->
        <a href="{{route('eventListPublic')}}" class="inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-800 transition-colors">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Retour aux événements
        </a>
    </div>

    <!-- Image d'en-tête (Hero) -->
    @if($event->primary_image)
        <div class="w-full h-64 md:h-96 rounded-2xl overflow-hidden mb-10 shadow-md">
            <img src="{{ asset('storage/'.$event->primary_image) }}" alt="{{ $event->label }}" class="w-full h-full object-cover">
        </div>
    @endif

    <!-- Contenu Principal (Grille) -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        
        <!-- Colonne de gauche (2/3 de l'espace) : Titre et Description -->
        <div class="lg:col-span-2">
            
            @if($event->is_important)
                <span class="inline-block px-3 py-1 mb-4 rounded-full text-xs font-bold bg-orange-100 text-orange-800 border border-orange-200 uppercase tracking-wider">
                    ⭐ Événement à la une
                </span>
            @endif

            <h1 class="text-3xl md:text-5xl font-extrabold text-gray-900 mb-6 leading-tight">
                {{ $event->label }}
            </h1>
            
            <!-- Description -->
            <div class="prose max-w-none text-gray-700 text-lg leading-relaxed whitespace-pre-line">
                {{ $event->description }}
            </div>
        </div>

        <!-- Colonne de droite (1/3 de l'espace) : Infos Pratiques (Dates & Adresse) -->
        <div class="lg:col-span-1">
            <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100 shadow-sm sticky top-8">
                <h3 class="text-xl font-bold text-gray-900 mb-6 border-b border-gray-200 pb-3">Informations pratiques</h3>
                
                <!-- Bloc Dates -->
                <div class="mb-6">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 mt-1 bg-indigo-100 p-2 rounded-lg text-indigo-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Début</p>
                            <p class="text-base font-semibold text-gray-900">
                                {{ \Carbon\Carbon::parse($event->start_date)->translatedFormat('l d F Y') }} <br>
                                <span class="text-indigo-600 text-sm">à {{ \Carbon\Carbon::parse($event->start_date)->format('H\hi') }}</span>
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start mt-4">
                        <div class="flex-shrink-0 mt-1 bg-red-100 p-2 rounded-lg text-red-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Fin</p>
                            <p class="text-base font-semibold text-gray-900">
                                {{ \Carbon\Carbon::parse($event->end_date)->translatedFormat('l d F Y') }} <br>
                                <span class="text-red-600 text-sm">à {{ \Carbon\Carbon::parse($event->end_date)->format('H\hi') }}</span>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Ligne de séparation -->
                <hr class="border-gray-200 mb-6">

                <!-- Bloc Adresse -->
                <div>
                    <div class="flex items-start">
                        <div class="flex-shrink-0 mt-1 bg-green-100 p-2 rounded-lg text-green-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Lieu</p>
                            @if($event->address)
                                <p class="text-base font-semibold text-gray-900">{{ $event->address->city }}</p>
                                <p class="text-sm text-gray-600 mt-1">
                                    {{ $event->address->street }} <br>
                                    {{ $event->address->postal_code }} {{ $event->address->city }}
                                </p>
                            @else
                                <p class="text-sm text-gray-600 mt-1 italic">Adresse non communiquée.</p>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
        
    </div>
</div>