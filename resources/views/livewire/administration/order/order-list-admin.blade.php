<div class="overflow-x-auto bg-white rounded-lg shadow-md mb-8">
    <x-search :options="$tabSearchPossibility"/>
    <x-search-asc-desc :options="$tabSearchAscDescPossibility"/>
    <table class="min-w-full text-left text-sm whitespace-nowrap">
        <!-- THEAD... -->
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
                    <td class="px-6 py-4">
                        @if($order->state)
                            <span class="px-2 py-1 text-xs font-medium text-green-700 bg-green-100 rounded-full">Validée</span>
                        @else
                            <span class="px-2 py-1 text-xs font-medium text-yellow-700 bg-yellow-100 rounded-full">En attente</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-gray-600">
                        {{ $order->user?->name ?? 'Anonyme (Compte supprimé)' }}
                    </td>
                    <td class="px-6 py-4 text-right">
                        <button wire:click="delete({{ $order->id }})" wire:confirm="Êtes-vous sûr de vouloir supprimer cette information ?" class="text-red-600 hover:text-red-900 font-semibold transition-colors">
                            Supprimer
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>