<div class="bg-white rounded-lg shadow-md mb-8">
    <!-- En-tête avec le bouton Ajouter -->
    <div class="p-6 border-b border-gray-200 flex justify-between items-center">
        <h2 class="text-xl font-bold text-gray-800">Gestion des Promotions</h2>
        <a href="{{ route('admin.promotionForm.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-md transition-colors shadow-sm">
            + Ajouter une promotion
        </a>
    </div>

    <!-- Tableau -->
    <div class="overflow-x-auto">
        <table class="min-w-full text-left text-sm whitespace-nowrap">
            <thead class="bg-gray-100 text-gray-600 uppercase tracking-wider border-b-2 border-gray-200">
                <tr>
                    <th scope="col" class="px-6 py-4 font-semibold">Nom</th>
                    <th scope="col" class="px-6 py-4 font-semibold">Montant</th>
                    <th scope="col" class="px-6 py-4 font-semibold">Date de début</th>
                    <th scope="col" class="px-6 py-4 font-semibold">Date de fin</th>
                    <th scope="col" class="px-6 py-4 font-semibold text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($listPromotions as $promotion)
                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                        
                        <!-- Nom -->
                        <td class="px-6 py-4 font-medium text-gray-900">
                            {{ $promotion->label ?: 'Non défini' }}
                        </td>

                        <!-- Montant -->
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs font-bold text-red-700 bg-red-100 rounded-full">
                                -{{ number_format($promotion->amount, 0) }} %
                            </span>
                        </td>

                        <!-- Date de début (Formatée en JJ/MM/AAAA) -->
                        <td class="px-6 py-4 text-gray-700">
                            {{ $promotion->start_date->format('d/m/Y') }}
                        </td>

                        <!-- Date de fin -->
                        <td class="px-6 py-4 text-gray-700">
                            @if($promotion->end_date)
                                {{ $promotion->end_date->format('d/m/Y') }}
                            @else
                                <span class="text-gray-400 italic">Indéfini</span>
                            @endif
                        </td>

                        <!-- Actions -->
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end space-x-3 items-center">
                                <a href="{{ route('admin.promotionForm.edit', $promotion) }}" class="text-indigo-600 hover:text-indigo-900 font-semibold transition-colors">
                                    Modifier
                                </a>
                                
                                <button wire:click="deleteProm({{ $promotion->id }})" wire:confirm="Êtes-vous sûr de vouloir supprimer cette promotion ?" class="text-red-600 hover:text-red-900 font-semibold transition-colors">
                                    Supprimer
                                </button>
                            </div>
                            
                            <!-- Affichage de l'erreur -->
                            @if(isset($isDeleting) && $isDeleting === false)
                                <p class="text-xs text-red-600 mt-2">
                                    Impossible : des articles y sont liés.
                                </p>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>