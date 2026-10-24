<div class="max-w-5xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    
    <!-- En-tête du panier -->
    <div class="flex justify-between items-end mb-8 border-b border-gray-200 pb-4">
        <h1 class="text-3xl font-black text-[#0B0A0B]">Mon Panier</h1>
        
        @if($cart && $cart->cartItems->isNotEmpty())
            <!-- Bouton Vider le panier -->
            <button wire:confirm="Êtes-vous sûr de vouloir vider l'intégralité de votre panier ?" 
                    wire:click='deleteItems({{ $cart->id }})' 
                    class="text-sm font-medium text-[#84796F] hover:text-[#5D0824] transition-colors flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                Vider le panier
            </button>
        @endif
    </div>

    <!-- Contenu du panier -->
    @if($cart && $cart->cartItems->isNotEmpty())
        <div class="space-y-6">
            
            @foreach ($cart->cartItems as $item)
                <!-- Carte Détaillée d'un article -->
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between p-5 bg-white rounded-2xl shadow-sm border border-[#84796F]/20 gap-6 transition-all hover:shadow-md">
                    
                    <!-- BLOC GAUCHE : Image + Textes -->
                    <div class="flex flex-col sm:flex-row items-start gap-5 flex-grow w-full">
                        
                        <!-- Image de l'article -->
                        <div class="flex-shrink-0 w-24 h-24 sm:w-32 sm:h-32 bg-[#FAF1E3]/50 rounded-xl overflow-hidden border border-[#84796F]/10">
                            @if($item->article->primary_image)
                                <img src="{{ asset('storage/' . $item->article->primary_image) }}" 
                                     alt="{{ $item->article->title }}" 
                                     class="w-full h-full object-cover">
                            @else
                                <div class="flex items-center justify-center w-full h-full text-[#84796F]/50">
                                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                </div>
                            @endif
                        </div>

                        <!-- Détails (Titre, Description, Prix) -->
                        <div class="flex flex-col flex-grow">
                            <!-- Titre -->
                            <a href="{{ route('articleDetail', $item->article->id) }}" class="text-xl font-bold text-[#0B0A0B] hover:text-[#5D0824] transition-colors">
                                {{ $item->article->title }}
                            </a>
                            
                            <!-- Description (Limitée à 2 ou 3 lignes pour ne pas casser le design) -->
                            <p class="text-sm text-[#84796F] mt-2 line-clamp-3">
                                {{ $item->article->description }}
                            </p>
                            
                            <!-- Prix unitaire -->
                            <div class="mt-3 text-lg font-black text-[#5D0824]">
                                {{ number_format($item->article->final_price, 2, ',', ' ') }} € 
                                <span class="text-xs font-medium text-[#84796F] ml-1">/ unité</span>
                            </div>
                        </div>
                    </div>

                    <!-- BLOC DROIT : Contrôles Quantité & Suppression -->
                    <div class="flex items-center justify-between sm:justify-end gap-6 w-full sm:w-auto mt-2 sm:mt-0 pt-4 sm:pt-0 border-t sm:border-t-0 border-[#84796F]/10">
                        
                        <!-- Sélecteur de quantité stylisé -->
                        <div class="flex items-center bg-[#FAF1E3] rounded-lg border border-[#84796F]/30 overflow-hidden shadow-sm">
                            <button wire:click='addOrRemoveItem({{ $item }}, -1)' 
                                    class="px-3 py-2 text-[#41342D] hover:bg-[#84796F]/20 hover:text-[#5D0824] transition-colors focus:outline-none">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M20 12H4"></path></svg>
                            </button>
                            
                            <span class="px-4 py-2 text-sm font-bold text-[#0B0A0B] bg-white border-x border-[#84796F]/30 w-12 text-center">
                                {{ $item->quantity }}
                            </span>
                            
                            <button wire:click='addOrRemoveItem({{ $item }})' 
                                    class="px-3 py-2 text-[#41342D] hover:bg-[#84796F]/20 hover:text-[#5D0824] transition-colors focus:outline-none">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                            </button>
                        </div>

                        <!-- Bouton Supprimer -->
                        <button wire:click='deleteItem({{ $item->id }})' 
                                class="p-2.5 text-[#84796F] hover:text-[#5D0824] hover:bg-red-50 rounded-full transition-colors focus:outline-none shadow-sm border border-transparent hover:border-red-100"
                                title="Retirer l'article">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                        
                    </div>
                </div>
            @endforeach
            
        </div>
    @else
        <!-- État Panier Vide -->
        <div class="text-center py-16 px-4 bg-white rounded-2xl border border-[#84796F]/20 border-dashed">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-[#FAF1E3] text-[#5D0824] mb-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <h2 class="text-xl font-bold text-[#0B0A0B] mb-2">Votre panier est vide</h2>
            <p class="text-[#84796F] mb-6">On dirait que vous n'avez pas encore trouvé votre bonheur.</p>
            <a href="{{ route('articleListUser') }}" class="inline-flex items-center justify-center px-6 py-3 text-sm font-bold text-[#FAF1E3] bg-[#5D0824] rounded-lg hover:bg-[#0B0A0B] transition-colors shadow-md">
                Découvrir nos articles
            </a>
        </div>
    @endif
</div>