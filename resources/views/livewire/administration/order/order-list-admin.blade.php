<div class="overflow-x-auto bg-white rounded-lg shadow-md mb-8">
    <x-search :options="$tabSearchPossibility"/>
    <x-search-asc-desc :options="$tabSearchAscDescPossibility"/>
    
    <table class="min-w-full text-left text-sm whitespace-nowrap">
        <thead class="bg-gray-100 text-gray-600 uppercase tracking-wider border-b-2 border-gray-200">
            <tr>
                <th scope="col" class="px-6 py-4 font-semibold">Numéro de commande</th>
                <th scope="col" class="px-6 py-4 font-semibold">Prix total</th>
                <th scope="col" class="px-6 py-4 font-semibold">État</th>
                <th scope="col" class="px-6 py-4 font-semibold">Client</th>
                <th scope="col" class="px-6 py-4 font-semibold text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach ($listOrders as $order)
                <tr class="hover:bg-gray-50 transition-colors duration-200">
                    <td class="px-6 py-4 font-bold text-gray-800">{{ $order->reference }}</td>
                    <td class="px-6 py-4">{{ number_format($order->total_price, 2, ',', ' ') }} €</td>
                    
                    <!-- Gestion des États avec nos belles méthodes du Modèle -->
                    <td class="px-6 py-4">
                        @if($order->isFinished())
                            <span class="px-2 py-1 text-xs font-medium text-green-700 bg-green-100 rounded-full">Confirmée</span>
                        @elseif($order->isWaiting())
                            <span class="px-2 py-1 text-xs font-medium text-yellow-700 bg-yellow-100 rounded-full">En attente</span>
                        @elseif($order->isRefused())
                            <span class="px-2 py-1 text-xs font-medium text-red-700 bg-red-100 rounded-full">Refusée / Annulée</span>
                        @endif
                    </td>
                    
                    <td class="px-6 py-4 text-gray-600">
                        {{ $order->user?->name ?? 'Anonyme (Compte supprimé)' }}
                    </td>
                    
                    <!-- ACTIONS -->
                    <td class="px-6 py-4 text-right">
                        <!-- Bouton Détails pour voir les articles -->
                        <button wire:click="show({{ $order->id }})" class="text-indigo-600 hover:text-indigo-900 font-semibold transition-colors mr-3">
                            Détails
                        </button>
                        
                        <!-- Bouton Annuler (Uniquement si la commande n'est PAS refusée) -->
                        @if(!$order->isRefused()) <!-- 👈 La méthode est super propre ici aussi ! -->
                            <button wire:click="cancelOrder({{ $order->id }})" wire:confirm="Êtes-vous sûr de vouloir annuler cette commande ?" class="text-red-600 hover:text-red-900 font-semibold transition-colors">
                                Annuler
                            </button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>