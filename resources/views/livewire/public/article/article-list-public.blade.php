<!-- Fond de page en Crème (Color 3) pour la lumière et le côté luxe -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 bg-[#FAF1E3] min-h-screen rounded-xl">
    
    <!-- ========================================== -->
    <!-- ÉVÉNEMENT À LA UNE (Bannière pleine largeur) -->
    <!-- ========================================== -->
    @if ($importantEvent)
    <div class="w-full mb-10 bg-[#5D0824] bg-cover bg-center text-[#FAF1E3] rounded-xl shadow-lg p-6 md:p-10 relative overflow-hidden flex flex-col justify-center border border-[#41342D]/20"
         @if($importantEvent->primary_image) style="background-image: url('{{ asset('storage/' . $importantEvent->primary_image) }}');" @endif>
        
        <!-- Filtre de couleur bordeaux semi-transparent (Overlay) : Activé uniquement si une image existe -->
        @if($importantEvent->primary_image)
            <div class="absolute inset-0 bg-[#5D0824] opacity-85"></div>
        @endif

        <!-- Effet de lumière décoratif en arrière-plan -->
        <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-white opacity-10 rounded-full blur-3xl pointer-events-none z-0"></div>

        <div class="relative z-10">
            <!-- Badge -->
            <div class="mb-4">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-black bg-[#FAF1E3] text-[#5D0824] uppercase tracking-wider shadow-sm">
                    ✨ Événement spécial
                </span>
            </div>
            
            <!-- Titre (avec drop-shadow pour le détacher de l'image) -->
            <h1 class="text-3xl md:text-4xl font-black mb-4 leading-tight drop-shadow-lg">
                {{ $importantEvent->label }}
            </h1>
            
            <!-- Description -->
            <p class="text-base md:text-lg text-gray-100 opacity-100 max-w-3xl leading-relaxed drop-shadow-md">
                {{ $importantEvent->description }}
            </p>
        </div>
    </div>  
    @endif
    
    <!-- ========================================== -->
    <!-- BARRE D'OUTILS (Recherche + Filtres + Tri) -->
    <!-- ========================================== -->
    <div class="mb-10 bg-white p-5 rounded-xl border border-[#84796F]/30 shadow-sm flex flex-col gap-4">
        
        <div class="flex flex-col md:flex-row items-center gap-2 w-full">
            
            <!-- Barre de recherche (prend un maximum d'espace) -->
            <div class="flex-grow w-full text-[#0B0A0B]">
                <x-search :options="$tabSearchPossibility" :listSearch="$listSearch" :search="$search" :searchWichColumn="$searchWichColumn"/>
            </div>
            
            <!-- Filtre Catégorie (à droite, largeur fixe sur grand écran) -->
            <div class="w-full md:w-56 shrink-0 text-[#0B0A0B]">
                <x-search-category :options="$tabSearchCategoryPossibility"/>
            </div>
        </div>

        <!-- LIGNE 2 : Tri et autres filtres (en dessous, alignés à gauche) -->
        <div class="flex flex-wrap items-center gap-4 justify-start pt-4 border-t border-[#84796F]/10">
            
            <!-- Tri Asc/Desc -->
            <div class="w-full md:w-auto text-[#0B0A0B]">
                <x-search-asc-desc :options="$tabSearchAscDescPossibility"/>
            </div>
        </div>
    </div>

    <!-- ========================================== -->
    <!-- GRILLE DES ARTICLES                        -->
    <!-- ========================================== -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

        @foreach ($listArticles as $article)
        <!-- Carte : Fond blanc pur pour faire ressortir l'image, bordure légère Taupe (Color 4) -->
        <div class="group bg-white rounded-2xl shadow-sm hover:shadow-xl border border-[#84796F]/20 overflow-hidden flex flex-col transition-all duration-300 transform hover:-translate-y-1">

            <!-- Zone de l'image -->
            <a href="{{ route('articleDetail', $article->id) }}" class="relative block h-56 overflow-hidden bg-[#FAF1E3]/50">
                @if($article->primary_image)
                    <img src="{{ asset('storage/' . $article->primary_image) }}" 
                         alt="{{ $article->title }}" 
                         class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105">
                @else
                    <div class="flex items-center justify-center h-full w-full text-[#84796F]/50">
                        <svg class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                @endif
            </a>

            <!-- Zone du texte -->
            <div class="p-6 flex flex-col flex-grow">

                <a href="{{ route('articleDetail', $article->id) }}" class="block mb-2">
                    <!-- Titre en Noir (Color 2) -->
                    <h3 class="text-xl font-bold text-[#0B0A0B] line-clamp-2 group-hover:text-[#5D0824] transition-colors duration-200">
                        {{ $article->title }}
                    </h3>
                </a>
                <div class="mb-4">
                    @if($article->articleCategory)
                        <!-- Badge Catégorie : Fond Moka (Color 5), texte Crème (Color 3) -->
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#41342D] text-[#FAF1E3]">
                            {{ $article->articleCategory->label }}
                        </span>
                    @else
                        <!-- Badge "Pas de catégorie" en Taupe -->
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#84796F]/10 text-[#84796F] border border-[#84796F]/20">
                            Pas de catégorie
                        </span>
                    @endif
                </div>
                @if ($article->clothes->isNotEmpty())
                    <div>
                        <strong>vêtements disponibles :</strong>
                        <ul>
                            @foreach($article->clothes as $clothe)
                                <li>
                                    Taille : {{ $clothe->size ?? "Unique" }} | 
                                    Couleur : {{ $clothe->color ?? "Standard" }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <div class="mt-auto pt-6 flex items-end justify-between gap-2">
    
                    <!-- Zone de Prix -->
                    <div class="flex flex-col">
                        @if($article->promotion)
                            <div class="flex items-center gap-2 mb-1">
                                <!-- Ancien prix barré en Taupe (Color 4) -->
                                <span class="text-sm font-medium text-[#84796F] line-through">
                                    {{ number_format($article->price_with_tva, 2, ',', ' ') }} €
                                </span>
                                <!-- Badge promo Rouge Bordeaux -->
                                <span class="inline-flex items-center px-1.5 py-0.5 rounded text-xs font-bold bg-[#5D0824] text-[#FAF1E3] shadow-sm">
                                    -{{ $article->promotion->amount }}%
                                </span>
                            </div>
                            
                            <!-- Nouveau prix final en Noir -->
                            <div class="flex items-baseline">
                                <span class="text-2xl font-black text-[#0B0A0B]">{{ number_format($article->final_price, 2, ',', ' ') }}</span>
                                <span class="ml-1 text-sm font-medium text-[#41342D]">€</span>
                            </div>

                        @else
                            <!-- Prix normal en Noir -->
                            <div class="flex items-baseline">
                                <span class="text-2xl font-black text-[#0B0A0B]">{{ number_format($article->final_price, 2, ',', ' ') }}</span>
                                <span class="ml-1 text-sm font-medium text-[#41342D]">€</span>
                            </div>
                        @endif
                    </div>
                    
                    <div class="flex flex-col gap-2">
                        <!-- Bouton Ajouter : LE bouton important en Bordeaux (Color 1) -->
                        <button wire:click='addArticleToCart({{ $article->id }})' class="inline-flex items-center justify-center px-3 py-1.5 text-xs font-bold text-[#FAF1E3] bg-[#5D0824] rounded-lg hover:bg-[#0B0A0B] transition-colors shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#5D0824]">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            Ajouter
                        </button>
                        
                        <!-- Bouton Voir : Plus discret (Contour Taupe, texte Moka) -->
                        <a href="{{ route('articleDetail', $article->id) }}" class="inline-flex items-center justify-center px-3 py-1.5 text-xs font-semibold text-[#41342D] bg-white rounded-lg hover:bg-[#FAF1E3] transition-colors border border-[#84796F]/30 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#84796F]">
                            Voir détails
                        </a>
                    </div>
                </div>

            </div>

        </div>
        @endforeach

    </div>

    <!-- ========================================== -->
    <!-- PAGINATION                                 -->
    <!-- ========================================== -->
    @if(method_exists($listArticles, 'hasPages') && $listArticles->hasPages())
        <div class="mt-12 text-[#0B0A0B]">
            {{ $listArticles->links() }}
        </div>
    @endif

</div>