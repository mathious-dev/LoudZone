<div class="p-6 bg-white rounded-lg shadow-md max-w-5xl mx-auto mt-8">
    
    <!-- En-tête avec titre et bouton d'ajout -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Informations Supplémentaires</h2>
        <a href="{{ route('admin.addInfo.create') }}" 
           class="bg-[rgb(72,6,28)] text-white px-4 py-2 rounded-md font-semibold text-sm shadow-sm hover:bg-opacity-90 transition-colors">
            + Ajouter une info
        </a>
    </div>
    <x-search :options="$tabSearchPossibility"/>
    <x-search-asc-desc :options="$tabSearchAscDescPossibility"/>
    <!-- Tableau -->
    <div class="overflow-x-auto shadow-sm rounded-lg border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Catégories associées</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($listAddInfos as $addInfo)
                    <tr class="hover:bg-gray-50 transition-colors">
                        
                        <!-- Nom de l'info -->
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $addInfo->label }}
                        </td>
                        
                        <!-- Compteur avec un badge -->
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-blue-100 text-blue-800">
                                {{ count($addInfo->supportMessageCategories)?? [] }}
                            </span>
                        </td>
                        
                        <!-- Boutons d'action -->
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-3">
                            <a href="{{ route('admin.addInfo.edit', $addInfo) }}" class="text-indigo-600 hover:text-indigo-900 transition-colors">
                                Modifier
                            </a>
                            <button wire:click="delete({{ $addInfo->id }})" wire:confirm="Êtes-vous sûr de vouloir supprimer cette information ?" class="text-red-600 hover:text-red-900 transition-colors">
                                Supprimer
                            </button>
                        </td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <!-- Zone pour la pagination si tu l'ajoutes plus tard -->
    @if(method_exists($listAddInfos, 'links'))
    <div class="mt-4">
        {{ $listAddInfos->links() }}
    </div>
    @endif
    
</div>