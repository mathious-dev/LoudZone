<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    
    <!-- En-tête (Optionnel selon où tu affiches ce tableau, mais garde la cohérence) -->
    <div class="mb-6">
        <h2 class="text-xl font-black text-[#0B0A0B]">Détail des Articles</h2>
        <p class="text-sm text-[#84796F] mt-1">Liste des produits contenus dans la commande.</p>
    </div>

    <!-- Conteneur du tableau -->
    <div class="bg-white rounded-2xl shadow-sm border border-[#84796F]/20 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-[#84796F]/20">
                <thead class="bg-[#FAF1E3]/40">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-black text-[#41342D] uppercase tracking-wider">
                            Numéro de commande
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-black text-[#41342D] uppercase tracking-wider">
                            Article
                        </th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-black text-[#41342D] uppercase tracking-wider">
                            Quantité
                        </th>
                        <th scope="col" class="px-6 py-4 text-right text-xs font-black text-[#41342D] uppercase tracking-wider">
                            Prix unitaire
                        </th>
                        <th scope="col" class="px-6 py-4 text-right text-xs font-black text-[#41342D] uppercase tracking-wider w-32">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#84796F]/10 bg-white">
                    @forelse ($listArticleOrders as $articleOrder)
                        <tr class="hover:bg-[#FAF1E3]/20 transition-colors">
                            
                            <!-- Numéro de commande -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-[#0B0A0B]">
                                {{ $articleOrder->order?->reference ?? 'Commande supprimée' }}
                            </td>
                            
                            <!-- Article -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-[#41342D]">
                                {{ $articleOrder->article?->title ?? 'Article supprimé' }}
                            </td>
                            
                            <!-- Quantité (Badge) -->
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-[#84796F]/10 text-[#41342D] border border-[#84796F]/20">
                                    x {{ $articleOrder->quantity }}
                                </span>
                            </td>
                            
                            <!-- Prix unitaire -->
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-black text-[#5D0824]">
                                {{ number_format($articleOrder->unit_price, 2, ',', ' ') }} €
                            </td>
                            
                            <!-- Actions -->
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end">
                                    <!-- Bouton Supprimer -->
                                    <button wire:click="delete({{ $articleOrder->id }})" 
                                            wire:confirm="Êtes-vous sûr de vouloir retirer cet article de la commande ?" 
                                            class="text-[#84796F] hover:text-red-600 transition-colors" title="Supprimer cet article">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                            
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-[#84796F] italic">
                                Aucun article trouvé.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Pagination (Si besoin) -->
    @if (method_exists($listArticleOrders, 'hasPages') && $listArticleOrders->hasPages())
        <div class="mt-6">
            {{ $listArticleOrders->links() }}
        </div>
    @endif
    
</div>