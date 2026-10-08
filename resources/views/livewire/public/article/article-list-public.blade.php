<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    <!-- ========================================== -->
    <!-- SECTION RECHERCHE (Séparée de la grille)   -->
    <!-- ========================================== -->
    <div class="mb-10">
        <x-search :options="$tabSearchPossibility"/>
    </div>

    <!-- ========================================== -->
    <!-- GRILLE DES ARTICLES                        -->
    <!-- ========================================== -->
    <!-- 1 col sur mobile, 2 sur tablette, 3 sur PC, 4 sur très grand écran -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
        
        @foreach ($listArticles as $article)
        <!-- La carte de l'article avec l'effet "group" pour animer les éléments au survol -->
        <div class="group bg-white rounded-2xl shadow-sm hover:shadow-xl border border-gray-100 overflow-hidden flex flex-col transition-all duration-300 transform hover:-translate-y-1">
            
            <!-- Zone de l'image (hauteur 56 pour un rendu plus premium) -->
            <a href="{{ route('articleDetail', $article->id) }}" class="relative block h-56 overflow-hidden bg-gray-50">
                @if($article->primary_image)
                    <!-- L'image zoome légèrement au survol de la carte (group-hover:scale-105) -->
                    <img src="{{ asset('storage/' . $article->primary_image) }}" 
                         alt="{{ $article->title }}" 
                         class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
                @else
                    <!-- Icône par défaut centrée avec un fond plus doux -->
                    <div class="flex items-center justify-center h-full w-full text-gray-300">
                        <svg class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                @endif
            </a>

            <!-- Zone du texte -->
            <div class="p-6 flex flex-col flex-grow">
                
                <!-- Titre cliquable (qui change de couleur au survol) -->
                <a href="{{ route('articleDetail', $article->id) }}" class="block mb-2">
                    <h3 class="text-xl font-bold text-gray-900 line-clamp-2 group-hover:text-indigo-600 transition-colors duration-200">
                        {{ $article->title }}
                    </h3>
                </a>
                
                <!-- Le prix et le bouton repoussés en bas -->
                <div class="mt-auto pt-6 flex items-center justify-between">
                    <div class="flex items-baseline">
                        <span class="text-2xl font-black text-gray-900">{{ number_format($article->price_ht, 2, ',', ' ') }}</span>
                        <span class="ml-1 text-sm font-medium text-gray-500">€ HT</span>
                    </div>
                    
                    <!-- Remplacement du <button> par un vrai <a> pour le SEO et le clic-molette -->
                    <a href="{{ route('articleDetail', $article->id) }}" class="inline-flex items-center justify-center px-4 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Voir
                    </a>
                </div>
                
            </div>

        </div>
        @endforeach
        
    </div>

    <!-- ========================================== -->
    <!-- PAGINATION                                 -->
    <!-- ========================================== -->
    @if(method_exists($listArticles, 'hasPages') && $listArticles->hasPages())
        <div class="mt-12">
            {{ $listArticles->links() }}
        </div>
    @endif
    
</div>