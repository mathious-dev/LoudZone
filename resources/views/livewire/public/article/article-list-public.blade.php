<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    <!-- ========================================== -->
    <!-- BARRE D'OUTILS (Recherche + Tri)           -->
    <!-- ========================================== -->
    <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-10 bg-gray-50 p-4 rounded-xl border border-gray-100">
        <div class="w-full md:w-2/3">
            <x-search :options="$tabSearchPossibility"/>
        </div>
        <div class="w-full md:w-auto flex justify-end">
             <x-search-asc-desc :options="$tabSearchAscDescPossibility"/>
        </div>
        <div>
            <x-search-category :options="$tabSearchCategoryPossibility"/>
        </div>
    </div>

    <!-- ========================================== -->
    <!-- GRILLE DES ARTICLES (Forcée en 3 colonnes) -->
    <!-- ========================================== -->
    <!-- J'ai retiré xl:grid-cols-4 pour bloquer à 3 colonnes max -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

        @foreach ($listArticles as $article)
        <div class="group bg-white rounded-2xl shadow-sm hover:shadow-xl border border-gray-100 overflow-hidden flex flex-col transition-all duration-300 transform hover:-translate-y-1">

            <!-- Zone de l'image -->
            <a href="{{ route('articleDetail', $article->id) }}" class="relative block h-56 overflow-hidden bg-gray-50">
                @if($article->primary_image)
                    <img src="{{ asset('storage/' . $article->primary_image) }}" 
                         alt="{{ $article->title }}" 
                         class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
                @else
                    <div class="flex items-center justify-center h-full w-full text-gray-300">
                        <svg class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                @endif
            </a>

            <!-- Zone du texte -->
            <div class="p-6 flex flex-col flex-grow">

                <a href="{{ route('articleDetail', $article->id) }}" class="block mb-2">
                    <h3 class="text-xl font-bold text-gray-900 line-clamp-2 group-hover:text-indigo-600 transition-colors duration-200">
                        {{ $article->title }}
                    </h3>
                </a>
                <div class="mb-4">
                    @if($article->articleCategory)
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                            {{ $article->articleCategory->label }}
                        </span>
                    @else
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-50 text-red-500 border border-red-100">
                            Pas de catégorie
                        </span>
                    @endif
                </div>
                <div class="mt-auto pt-6 flex items-end justify-between">
    
                    <!-- Zone de Prix -->
                    <div class="flex flex-col">
                        @if($article->promotion)
                            <!-- S'il y a une promotion -->
                            <div class="flex items-center gap-2 mb-1">
                                <!-- Ancien prix barré : ICI on garde price_with_tva pour montrer le prix de départ -->
                                <span class="text-sm font-medium text-gray-400 line-through">
                                    {{ number_format($article->price_with_tva, 2, ',', ' ') }} €
                                </span>
                                <!-- Badge de pourcentage -->
                                <span class="inline-flex items-center px-1.5 py-0.5 rounded text-xs font-bold bg-red-100 text-red-700">
                                    -{{ $article->promotion->amount }}%
                                </span>
                            </div>
                            
                            <!-- Nouveau prix final : On utilise final_price -->
                            <div class="flex items-baseline">
                                <span class="text-2xl font-black text-indigo-600">{{ number_format($article->final_price, 2, ',', ' ') }}</span>
                                <span class="ml-1 text-sm font-medium text-gray-500">€</span>
                            </div>

                        @else
                            <!-- S'il n'y a PAS de promotion -->
                            <div class="flex items-baseline">
                                <!-- On affiche directement final_price ! -->
                                <span class="text-2xl font-black text-gray-900">{{ number_format($article->final_price, 2, ',', ' ') }}</span>
                                <span class="ml-1 text-sm font-medium text-gray-500">€</span>
                            </div>
                        @endif
                    </div>
                    <button wire:click='addArticleToCart({{ $article->id }})'>Ajouter au panier</button>
                    <!-- Bouton Voir -->
                    <a href="{{ route('articleDetail', $article->id) }}" class="inline-flex items-center justify-center px-4 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mb-0.5">
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