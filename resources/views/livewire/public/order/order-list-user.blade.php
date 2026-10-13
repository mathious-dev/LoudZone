<div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    
    <!-- En-tête de la page -->
    <div class="text-center mb-10">
        <h1 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">Historique de vos commandes</h1>
        <p class="mt-3 text-lg text-gray-500">Consultez l'état et le résumé de vos achats récents.</p>
    </div>

    <!-- Vérification : y a-t-il des commandes ? -->
    @if(count($listOrders) > 0)
        <!-- Le Tableau des commandes -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Référence</th>
                            <th scope="col" class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">État</th>
                            <th scope="col" class="px-6 py-4 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Prix Total</th>
                            <!-- Colonne prête pour quand tu ajouteras les détails -->
                            <th scope="col" class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Détails</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($listOrders as $order)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                
                                <!-- Référence -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-800">
                                    {{ $order->reference }}
                                </td>
                                
                                <!-- État (avec un style badge) -->
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        {{ $order->state }}
                                    </span>
                                </td>
                                
                                <!-- Prix Total -->
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-bold text-gray-900">
                                    {{ number_format($order->total_price, 2, ',', ' ') }} €
                                </td>
                                
                                <!-- Bouton pour voir les articles (À lier plus tard) -->
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <button class="text-indigo-600 hover:text-indigo-900 underline transition-colors">
                                        Voir les articles
                                    </button>
                                </td>
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    @else
        <!-- Design "Empty State" (Quand il n'y a aucune commande) -->
        <div class="text-center bg-white shadow-md rounded-lg p-12 border-2 border-dashed border-gray-300">
            <!-- Icône panier vide -->
            <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
            </svg>
            <h3 class="mt-4 text-lg font-bold text-gray-900">Aucune commande pour le moment</h3>
            <p class="mt-2 text-sm text-gray-500">Vous n'avez pas encore effectué d'achat sur notre boutique.</p>
            
            <div class="mt-8">
                <!-- Lien vers la boutique (modifie la route selon ton projet) -->
                <a href="{{ route('articleListPublic') }}" class="inline-flex items-center px-6 py-3 border border-transparent shadow-sm text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 transition-colors">
                    Découvrir nos articles
                </a>
            </div>
        </div>
    @endif
    
</div>