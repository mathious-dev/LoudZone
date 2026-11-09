<!-- Fond de page en Crème (Color 3) pour la lumière et le côté luxe -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 bg-[#FAF1E3] min-h-screen rounded-xl">

    <!-- ========================================== -->
    <!-- ÉVÉNEMENT À LA UNE (Bannière pleine largeur) -->
    <!-- ========================================== -->
    @if ($importantEvent)
    <a href="{{ route('eventDetail',$importantEvent) }}">
    <div class="w-full mb-10 bg-[#5D0824] bg-cover bg-center text-[#FAF1E3] rounded-xl shadow-lg p-6 md:p-10 relative overflow-hidden flex flex-col justify-center border border-[#41342D]/20"
         @if($importantEvent->primary_image) style="background-image: url('{{ asset('storage/' . $importantEvent->primary_image) }}');" @endif>

        <!-- Filtre de couleur bordeaux semi-transparent -->
        @if($importantEvent->primary_image)
            <div class="absolute inset-0 bg-[#5D0824] opacity-85"></div>
        @endif

        <!-- Effet de lumière -->
        <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-white opacity-10 rounded-full blur-3xl pointer-events-none z-0"></div>

        <div class="relative z-10">
            <!-- Badge -->
            <div class="mb-4">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-black bg-[#FAF1E3] text-[#5D0824] uppercase tracking-wider shadow-sm">
                    ✨ Événement spécial
                </span>
            </div>

            <!-- Titre -->
            <h1 class="text-3xl md:text-4xl font-black mb-4 leading-tight drop-shadow-lg">
                {{ $importantEvent->label }}
            </h1>

            <!-- Description -->
            <p class="text-base md:text-lg text-gray-100 opacity-100 max-w-3xl leading-relaxed drop-shadow-md">
                {{ $importantEvent->description }}
            </p>
        </div>
    </div>
    </a>
    @endif

    <!-- ========================================== -->
    <!-- BARRE D'OUTILS (Recherche + Filtres + Tri) -->
    <!-- ========================================== -->
    <div class="mb-10 bg-white p-6 rounded-xl border border-[#84796F]/30 shadow-sm flex flex-col gap-6">

        <!-- LIGNE 1 : Recherche + Catégories + Tri -->
        <div class="flex flex-col md:flex-row items-end md:items-center gap-4 w-full">

            <!-- Barre de recherche -->
            <div class="flex-grow w-full md:w-auto text-[#0B0A0B]">
                <x-search :options="$tabSearchPossibility" :listSearch="$listSearch" :search="$search" :searchWichColumn="$searchWichColumn" :showList="$showList" />
            </div>

            <div class="flex flex-col sm:flex-row gap-4 w-full md:w-auto shrink-0">
                <!-- Filtre Catégorie -->
                <div class="w-full sm:w-56 text-[#0B0A0B]">
                    <x-search-category :options="$tabSearchCategoryPossibility"/>
                </div>

                <!-- Tri Asc/Desc -->
                <div class="w-full sm:w-48 text-[#0B0A0B]">
                    <x-search-asc-desc :options="$tabSearchAscDescPossibility"/>
                </div>
            </div>
        </div>

        <!-- LIGNE 2 : Filtres de prix -->
        <div class="pt-4 border-t border-[#84796F]/10">
            <x-search-price-filter :listPriceFilters="$listPriceFilters"/>
        </div>

    </div>

    <!-- ========================================== -->
    <!-- GRILLE DES ARTICLES                        -->
    <!-- ========================================== -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

        @foreach ($listArticles as $article)
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
                    <h3 class="text-xl font-bold text-[#0B0A0B] line-clamp-2 group-hover:text-[#5D0824] transition-colors duration-200">
                        {{ $article->title }}
                    </h3>
                </a>

                <div class="mb-4">
                    @if($article->category)
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#41342D] text-[#FAF1E3]">
                            {{ $article->category->label }}
                        </span>
                    @else
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#84796F]/10 text-[#84796F] border border-[#84796F]/20">
                            Pas de catégorie
                        </span>
                    @endif
                </div>

                @if ($article->clothes->isNotEmpty())
                    <div class="mb-4 text-sm text-[#41342D]">
                        <strong class="text-[#0B0A0B]">Modèles disponibles :</strong>
                        <ul class="mt-1 space-y-1">
                            @foreach($article->clothes as $clothe)
                                <li class="text-xs">
                                    <span class="font-semibold">Taille:</span> {{ $clothe->size ?? "Unique" }}
                                    <span class="text-[#84796F] mx-1">|</span>
                                    <span class="font-semibold">Couleur:</span> {{ $clothe->color ?? "Standard" }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mt-auto pt-6 flex items-end justify-between gap-2 border-t border-[#84796F]/10">

                    <!-- Zone de Prix -->
                    <div class="flex flex-col">
                        @if($article->promotion)
                            <div class="flex items-center gap-2 mb-1">
                                <span class="text-sm font-medium text-[#84796F] line-through">
                                    {{ number_format($article->price_with_tva, 2, ',', ' ') }} €
                                </span>
                                <span class="inline-flex items-center px-1.5 py-0.5 rounded text-xs font-bold bg-[#5D0824] text-[#FAF1E3] shadow-sm">
                                    -{{ $article->promotion->amount }}%
                                </span>
                            </div>
                            <div class="flex items-baseline">
                                <span class="text-2xl font-black text-[#0B0A0B]">{{ number_format($article->final_price, 2, ',', ' ') }}</span>
                                <span class="ml-1 text-sm font-medium text-[#41342D]">€</span>
                            </div>
                        @else
                            <div class="flex items-baseline">
                                <span class="text-2xl font-black text-[#0B0A0B]">{{ number_format($article->final_price, 2, ',', ' ') }}</span>
                                <span class="ml-1 text-sm font-medium text-[#41342D]">€</span>
                            </div>
                        @endif
                    </div>

                    <div class="flex flex-col gap-2">
                        <button wire:click='addArticleToCart({{ $article->id }})' class="inline-flex items-center justify-center px-3 py-1.5 text-xs font-bold text-[#FAF1E3] bg-[#5D0824] rounded-lg hover:bg-[#0B0A0B] transition-colors shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#5D0824]">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            Ajouter
                        </button>

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
