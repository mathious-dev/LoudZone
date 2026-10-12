<div class="bg-white rounded-lg shadow-md mb-8 overflow-hidden max-w-5xl mx-auto mt-8">
    
    <!-- En-tête avec Titre et Bouton Ajouter -->
    <div class="flex flex-col sm:flex-row justify-between items-center p-6 border-b border-gray-200 bg-white gap-4">
        <h2 class="text-xl font-bold text-gray-800">Catégories de messages support</h2>
        <a href="{{ route('admin.supportMessageCategory.create') }}" 
           class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 transition ease-in-out duration-150 shadow-sm">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Ajouter une catégorie
        </a>
    </div>

    <!-- Conteneur du tableau -->
    <div class="overflow-x-auto">
        <table class="min-w-full text-left text-sm whitespace-nowrap">
            <thead class="bg-gray-100 text-gray-600 uppercase tracking-wider border-b-2 border-gray-200">
                <tr>
                    <th scope="col" class="px-6 py-4 font-semibold">Nom de catégorie</th>
                    <th scope="col" class="px-6 py-4 font-semibold text-center">Infos supplémentaires associées</th>
                    <th scope="col" class="px-6 py-4 font-semibold text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($listSupportMessageCategories as $category)
                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                        
                        <!-- Nom -->
                        <td class="px-6 py-4 font-bold text-gray-800">
                            {{ $category->label }}
                        </td>
                        
                        <!-- Compteur (avec un badge élégant) -->
                        <td class="px-6 py-4 text-center">
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-blue-100 text-blue-800">
                                {{ $category->addInfos?->count() ?? 0 }}
                            </span>
                        </td>
                        
                        <!-- Actions -->
                        <td class="px-6 py-4 text-right text-sm font-medium space-x-3">
                            <a href="{{ route('admin.supportMessageCategory.edit', $category) }}" class="text-indigo-600 hover:text-indigo-900 font-semibold transition-colors">
                                Modifier
                            </a>
                            <button wire:click="delete({{ $category->id }})" wire:confirm="Êtes-vous sûr de vouloir supprimer cette catégorie ?" class="text-red-600 hover:text-red-900 font-semibold transition-colors">
                                Supprimer
                            </button>
                        </td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>