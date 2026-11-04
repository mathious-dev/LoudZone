<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    
    <!-- En-tête de la page -->
    <div class="mb-6">
        <h1 class="text-2xl font-black text-[#0B0A0B]">Gestion des Commandes</h1>
        <p class="text-sm text-[#84796F] mt-1">Suivi et administration des commandes clients.</p>
    </div>

    <!-- Espace de recherche et filtres -->
    <div class="flex flex-col sm:flex-row gap-4 mb-6">
        <div class="w-full sm:w-2/3">
            <x-search :options="$tabSearchPossibility" :listSearch="$listSearch" :search="$search" :searchWichColumn="$searchWichColumn" :showList="$showList" />
        </div>
        <div class="w-full sm:w-1/3">
            <x-search-asc-desc :options="$tabSearchAscDescPossibility"/>
        </div>
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
                            Prix total
                        </th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-black text-[#41342D] uppercase tracking-wider">
                            État
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-black text-[#41342D] uppercase tracking-wider">
                            Client
                        </th>
                        <th scope="col" class="px-6 py-4 text-right text-xs font-black text-[#41342D] uppercase tracking-wider w-32">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#84796F]/10 bg-white">
                    @forelse ($listOrders as $order)
                        <tr class="hover:bg-[#FAF1E3]/20 transition-colors">
                            
                            <!-- Numéro de commande -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-[#0B0A0B]">
                                {{ $order->reference }}
                            </td>
                            
                            <!-- Prix Total -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-[#41342D]">
                                {{ number_format($order->total_price, 2, ',', ' ') }} €
                            </td>
                            
                            <!-- Gestion des États (Badges) -->
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm">
                                @if($order->isFinished())
                                    <span class="px-3 py-1 inline-flex text-xs font-bold rounded-full bg-green-50 text-green-700 border border-green-200">
                                        Confirmée
                                    </span>
                                @elseif($order->isWaiting())
                                    <span class="px-3 py-1 inline-flex text-xs font-bold rounded-full bg-orange-50 text-orange-700 border border-orange-200">
                                        En attente
                                    </span>
                                @elseif($order->isRefused())
                                    <span class="px-3 py-1 inline-flex text-xs font-bold rounded-full bg-red-50 text-red-700 border border-red-200">
                                        Refusée / Annulée
                                    </span>
                                @endif
                            </td>
                            
                            <!-- Client -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-[#0B0A0B]">
                                {{ $order->user?->name ?? 'Anonyme (Compte supprimé)' }}
                            </td>
                            
                            <!-- Actions -->
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end gap-3">
                                    <!-- Bouton Annuler (Uniquement si la commande n'est PAS refusée) -->
                                    @if(!$order->isRefused())
                                        <button wire:click="cancelOrder({{ $order->id }})" 
                                                wire:confirm="Êtes-vous sûr de vouloir annuler cette commande ?" 
                                                class="text-[#84796F] hover:text-red-600 transition-colors" title="Annuler la commande">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </button>
                                    @else
                                        <!-- Placeholder vide pour garder l'alignement si annulée -->
                                        <span class="w-5 h-5 inline-block"></span>
                                    @endif
                                </div>
                            </td>
                            
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-[#84796F] italic">
                                Aucune commande n'a été trouvée.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Pagination -->
    @if (method_exists($listOrders, 'hasPages') && $listOrders->hasPages())
        <div class="mt-6">
            {{ $listOrders->links() }}
        </div>
    @endif
    
</div>