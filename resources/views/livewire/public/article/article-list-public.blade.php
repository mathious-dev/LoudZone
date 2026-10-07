<div class="py-6">
    <!-- Le conteneur de la grille : 3 colonnes sur écran moyen/grand, avec un espace de 6 (gap-6) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        
        @foreach ($listArticles as $article)
        <!-- La carte de l'article -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 flex flex-col">
            
            <!-- Zone de l'image (en haut de la carte) -->
            <div class="h-48 w-full bg-gray-100 flex items-center justify-center border-b border-gray-200">
                @if($article->images)
                    <img src="{{ asset('storage/' . $article->images) }}" 
                         alt="{{ $article->title }}" 
                         class="h-full w-full object-cover">
                @else
                    <!-- Icône par défaut si pas d'image -->
                    <svg class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                @endif
            </div>

            <!-- Zone du texte (Titre et Prix) -->
            <div class="p-5 flex flex-col flex-grow">
                <h3 class="text-lg font-semibold text-gray-800 line-clamp-2">
                    {{ $article->title }}
                </h3>
                
                <!-- On pousse le prix vers le bas de la carte -->
                <div class="mt-auto pt-4 flex items-center justify-between">
                    <span class="text-xl font-bold text-indigo-600">
                        {{ number_format($article->price_ht, 2, ',', ' ') }} €
                    </span>
                    
                    <!-- Optionnel : Un petit bouton pour voir l'article -->
                    <button class="text-sm text-white bg-indigo-600 hover:bg-indigo-700 px-3 py-1.5 rounded-md transition-colors">
                        Voir
                    </button>
                </div>
            </div>

        </div>
        @endforeach
        
    </div>

    <!-- Affichage des liens de pagination (Les numéros de pages 1, 2, 3...) -->
    @if($listArticles->hasPages())
        <div class="mt-8">
            {{ $listArticles->links() }}
        </div>
    @endif
</div>