<div class="overflow-x-auto bg-white rounded-lg shadow-md mb-8">
    <table class="min-w-full text-left text-sm whitespace-nowrap">
        <thead class="bg-gray-100 text-gray-600 uppercase tracking-wider border-b-2 border-gray-200">
            <tr>
                <th scope="col" class="px-6 py-4 font-semibold">Numéro de commande</th>
                <th scope="col" class="px-6 py-4 font-semibold">Article</th>
                <th scope="col" class="px-6 py-4 font-semibold text-center">Quantité</th>
                <th scope="col" class="px-6 py-4 font-semibold text-right">Prix unitaire</th>
                <th scope="col" class="px-6 py-4 font-semibold text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach ($listArticleOrders as $articleOrder)
                <tr class="hover:bg-gray-50 transition-colors duration-200">
                    <td class="px-6 py-4 text-gray-600">
                        {{ $articleOrder->order?->reference ?? 'Commande supprimée' }}
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-900">
                        {{ $articleOrder->article?->title ?? 'Article supprimé' }}
                    </td>
                    <td class="px-6 py-4 text-center font-bold text-blue-600">{{ $articleOrder->quantity }}</td>
                    <td class="px-6 py-4 text-right">{{ number_format($articleOrder->unit_price, 2, ',', ' ') }} €</td>
                    <td class="px-6 py-4 text-right">
                        <button wire:click="delete({{ $articleOrder->id }})" wire:confirm="Êtes-vous sûr de vouloir supprimer cette information ?" class="text-red-600 hover:text-red-900 font-semibold transition-colors">
                            Supprimer
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>