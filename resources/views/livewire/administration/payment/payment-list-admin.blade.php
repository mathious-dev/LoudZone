<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    
    <!-- En-tête de la page -->
    <div class="mb-6">
        <h1 class="text-2xl font-black text-[#0B0A0B]">Gestion des Paiements</h1>
        <p class="text-sm text-[#84796F] mt-1">Suivi des transactions et de l'état des paiements.</p>
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
                            Commande
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-black text-[#41342D] uppercase tracking-wider">
                            Méthode
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-black text-[#41342D] uppercase tracking-wider">
                            ID Transaction
                        </th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-black text-[#41342D] uppercase tracking-wider">
                            État
                        </th>
                        <th scope="col" class="px-6 py-4 text-right text-xs font-black text-[#41342D] uppercase tracking-wider">
                            Montant
                        </th>
                        <th scope="col" class="px-6 py-4 text-right text-xs font-black text-[#41342D] uppercase tracking-wider w-32">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#84796F]/10 bg-white">
                    @forelse ($listPayments as $payment)
                        <tr class="hover:bg-[#FAF1E3]/20 transition-colors">
                            
                            <!-- Référence Commande -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-[#0B0A0B]">
                                {{ $payment->order?->reference ?? 'Commande supprimée' }}
                            </td>
                            
                            <!-- Méthode de paiement -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-bold bg-[#84796F]/10 text-[#41342D] border border-[#84796F]/20">
                                    {{ strtoupper($payment->payment_method) }}
                                </span>
                            </td>
                            
                            <!-- ID Transaction -->
                            <td class="px-6 py-4 whitespace-nowrap text-xs font-mono text-[#84796F]">
                                {{ $payment->transaction_id }}
                            </td>
                            
                            <!-- État (Badges) -->
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm">
                                @if($payment->isFinished())
                                    <span class="px-3 py-1 inline-flex text-xs font-bold rounded-full bg-green-50 text-green-700 border border-green-200">
                                        Confirmée
                                    </span>
                                @elseif($payment->isWaiting())
                                    <span class="px-3 py-1 inline-flex text-xs font-bold rounded-full bg-orange-50 text-orange-700 border border-orange-200">
                                        En attente
                                    </span>
                                @elseif($payment->isRefused())
                                    <span class="px-3 py-1 inline-flex text-xs font-bold rounded-full bg-red-50 text-red-700 border border-red-200">
                                        Refusée / Annulée
                                    </span>
                                @endif
                            </td>
                            
                            <!-- Montant -->
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-black text-[#5D0824]">
                                {{ number_format($payment->amount, 2, ',', ' ') }} €
                            </td>
                            
                            <!-- Actions -->
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end">
                                    <button wire:click="delete({{ $payment->id }})" 
                                            wire:confirm="Êtes-vous sûr de vouloir supprimer cette transaction ?" 
                                            class="text-[#84796F] hover:text-red-600 transition-colors" title="Supprimer">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                            
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-[#84796F] italic">
                                Aucun paiement n'a été trouvé.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Pagination (Si disponible) -->
    @if (method_exists($listPayments, 'hasPages') && $listPayments->hasPages())
        <div class="mt-6">
            {{ $listPayments->links() }}
        </div>
    @endif
    
</div>