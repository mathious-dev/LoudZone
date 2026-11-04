<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    
    <!-- En-tête de la page -->
    <div class="mb-6">
        <h1 class="text-2xl font-black text-[#0B0A0B]">Suivi des Paniers</h1>
        <p class="text-sm text-[#84796F] mt-1">Consultez les paniers en cours des clients et des visiteurs.</p>
    </div>

    <!-- Conteneur du tableau -->
    <div class="bg-white rounded-2xl shadow-sm border border-[#84796F]/20 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-[#84796F]/20">
                <thead class="bg-[#FAF1E3]/40">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-black text-[#41342D] uppercase tracking-wider">
                            Utilisateur
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-black text-[#41342D] uppercase tracking-wider">
                            Session ID
                        </th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-black text-[#41342D] uppercase tracking-wider">
                            Articles
                        </th>
                        <th scope="col" class="px-6 py-4 text-right text-xs font-black text-[#41342D] uppercase tracking-wider">
                            Détails
                        </th>
                    </tr>
                </thead>

                <!-- Un tbody par panier pour Alpine.js -->
                @forelse ($listCarts as $cart)
                    <tbody x-data="{ expanded: false }" class="divide-y divide-[#84796F]/10 bg-white">
                        
                        <!-- LIGNE PRINCIPALE (Le Panier) -->
                        <tr class="hover:bg-[#FAF1E3]/20 transition-colors">
                            
                            <!-- Utilisateur -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    @if($cart->user)
                                        <div>
                                            <div class="text-sm font-bold text-[#0B0A0B] flex items-center gap-2">
                                                <span class="text-xs text-[#84796F]/50">#{{ $cart->user->id }}</span>
                                                {{ $cart->user->name }}
                                            </div>
                                            <div class="text-xs font-medium text-[#84796F]">
                                                {{ $cart->user->email }}
                                            </div>
                                        </div>
                                    @else
                                        <div>
                                            <div class="text-sm font-bold text-[#41342D]">Visiteur Invité</div>
                                            <div class="text-xs italic text-[#84796F]">Pas de compte</div>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            
                            <!-- Session ID -->
                            <td class="px-6 py-4 whitespace-nowrap text-xs font-mono text-[#84796F]">
                                {{ $cart->session_id ?? 'Aucun (Connecté)' }}
                            </td>

                            <!-- Nombre d'articles (Badge) -->
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                <span class="inline-flex items-center justify-center px-3 py-1 rounded-full text-xs font-bold bg-[#5D0824]/10 text-[#5D0824] border border-[#5D0824]/20">
                                    {{ $cart->cartItems->count() }} articles
                                </span>
                            </td>
                            
                            <!-- Bouton Détails (Chevron) -->
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <button @click="expanded = !expanded" 
                                        type="button" 
                                        class="text-[#84796F] hover:text-[#0B0A0B] focus:outline-none p-1 rounded-full hover:bg-[#84796F]/10 transition-colors" 
                                        title="Voir les articles">
                                    <svg class="w-5 h-5 inline-block transform transition-transform duration-200" 
                                         :class="{'rotate-180': expanded}" 
                                         fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                            </td>
                        </tr>

                        <!-- SOUS-LIGNE (Les Articles du Panier) -->
                        <tr x-show="expanded" x-cloak 
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 -translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            class="bg-[#FAF1E3]/20 border-t border-[#84796F]/5">
                            
                            <td colspan="4" class="px-6 py-6">
                                <div class="border border-[#84796F]/20 rounded-xl bg-white shadow-sm overflow-hidden">
                                    <table class="min-w-full divide-y divide-[#84796F]/10">
                                        <thead class="bg-[#FAF1E3]/30">
                                            <tr>
                                                <th class="px-4 py-3 text-left text-xs font-black text-[#41342D]">ID</th>
                                                <th class="px-4 py-3 text-left text-xs font-black text-[#41342D]">Article</th>
                                                <th class="px-4 py-3 text-center text-xs font-black text-[#41342D]">Quantité</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-[#84796F]/10">
                                            @forelse ($cart->cartItems as $cartItem)
                                                <tr class="hover:bg-[#FAF1E3]/10">
                                                    <td class="px-4 py-3 text-xs font-mono text-[#84796F]">#{{ $cartItem->article_id }}</td>
                                                    <td class="px-4 py-3 text-sm font-bold text-[#0B0A0B]">{{ $cartItem->article->title }}</td>
                                                    <td class="px-4 py-3 text-sm text-center font-bold text-[#5D0824]">x {{ $cartItem->quantity }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3" class="px-4 py-6 text-sm text-center text-[#84796F] italic">
                                                        Ce panier est vide.
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                @empty
                    <tbody>
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-[#84796F] italic">
                                Aucun panier trouvé.
                            </td>
                        </tr>
                    </tbody>
                @endforelse
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if (method_exists($listCarts, 'hasPages') && $listCarts->hasPages())
        <div class="mt-6">
            {{ $listCarts->links() }} 
        </div>
    @endif
    
</div>