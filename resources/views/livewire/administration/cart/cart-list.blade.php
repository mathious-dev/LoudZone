<div class="bg-white shadow-sm rounded-lg border border-gray-200 overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Utilisateur
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Session ID
                </th>
                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Articles
                </th>
                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Détails
                </th>
            </tr>
        </thead>

        <!-- On crée un tbody par panier pour pouvoir y attacher la variable Alpine 'expanded' -->
        @foreach ($listCarts as $cart)
            <tbody x-data="{ expanded: false }" class="divide-y divide-gray-200 bg-white">
                
                <!-- LIGNE PRINCIPALE (Le Panier) -->
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            @if($cart->user)
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900 flex items-center gap-2">
                                        <span class="text-xs text-gray-400">#{{ $cart->user->id }}</span>
                                        {{ $cart->user->name }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ $cart->user->email }}
                                    </div>
                                </div>
                            @else
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">Visiteur Invité</div>
                                    <div class="text-sm text-gray-400">Pas de compte</div>
                                </div>
                            @endif
                        </div>
                    </td>
                    
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $cart->session_id ?? 'Aucun (Connecté)' }}
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap text-sm text-center font-medium text-gray-900">
                        <span class="inline-flex items-center justify-center px-2.5 py-0.5 rounded-full bg-blue-100 text-blue-800">
                            {{ $cart->cartItems->count() }}
                        </span>
                    </td>
                    
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <!-- Bouton pour ouvrir/fermer avec animation de rotation de la flèche -->
                        <button @click="expanded = !expanded" type="button" class="text-indigo-600 hover:text-indigo-900 focus:outline-none">
                            <svg class="w-5 h-5 inline-block transform transition-transform duration-200" 
                                 :class="{'rotate-180': expanded}" 
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </td>
                </tr>

                <!-- SOUS-LIGNE (Les Articles du Panier) -->
                <!-- x-show affiche cette ligne uniquement si expanded est vrai -->
                <!-- colspan="4" permet à cette ligne de prendre toute la largeur du tableau -->
                <tr x-show="expanded" x-cloak class="bg-gray-50">
                    <td colspan="4" class="px-6 py-4">
                        
                        <div class="border border-gray-200 rounded-lg bg-white overflow-hidden">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600">ID</th>
                                        <th class="px-4 py-2 text-left text-xs font-semibold text-gray-600">Article</th>
                                        <th class="px-4 py-2 text-center text-xs font-semibold text-gray-600">Quantité</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @forelse ($cart->cartItems as $cartItem)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-4 py-2 text-sm text-gray-500">#{{ $cartItem->article_id }}</td>
                                            <td class="px-4 py-2 text-sm font-medium text-gray-900">{{ $cartItem->article->title }}</td>
                                            <td class="px-4 py-2 text-sm text-center text-gray-600">{{ $cartItem->quantity }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="px-4 py-4 text-sm text-center text-gray-500 italic">
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
        @endforeach
    </table>


    <!-- Pagination -->
    <div class="mt-4">
        {{ $listCarts->links() }} 
    </div>
</div>
