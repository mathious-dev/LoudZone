<div class="p-6 bg-white rounded-lg shadow-md max-w-7xl mx-auto mt-8">
    
    <!-- En-tête avec le titre et le bouton d'ajout -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
        <h2 class="text-2xl font-bold text-gray-800">Gestion des Rôles</h2>
        <!-- Le bouton était mal placé dans le tableau, il est maintenant à sa bonne place ! -->
        <a href="{{ route('admin.roleForm.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 transition ease-in-out duration-150 shadow-sm">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Ajouter un rôle
        </a>
    </div>

    <!-- Composant de recherche réutilisable -->
    <x-search :options="$tabSearchPossibility" />

    <!-- Conteneur du tableau -->
    <div class="overflow-x-auto shadow-sm rounded-lg border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rôle</th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Membres assignés</th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($listRoles as $role)
                <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                    
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                        {{ ucfirst($role->name) }}
                    </td>
                    
                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-700">
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-indigo-100 text-indigo-800">
                            {{ $role->users->count() }} utilisateurs
                        </span>
                    </td>
                    
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex justify-end space-x-4">
                            <a href="{{ route('admin.roleForm.edit', $role) }}" class="text-indigo-600 hover:text-indigo-900 transition duration-150">
                                Modifier
                            </a>
                            <!-- J'ai bloqué la suppression si c'est le rôle Admin pour éviter de casser le site -->
                            @if(strtolower($role->name) !== 'admin')
                                <button wire:click="delete({{ $role->id }})" wire:confirm="Êtes-vous sûr de vouloir supprimer ce rôle ?" class="text-red-600 hover:text-red-900 transition duration-150">
                                    Supprimer
                                </button>
                            @else
                                <span class="text-gray-400 italic text-xs">Protégé</span>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    @if (method_exists($listRoles, 'hasPages') && $listRoles->hasPages())
        <div class="mt-6">
            {{ $listRoles->links() }}
        </div>
    @endif
</div>