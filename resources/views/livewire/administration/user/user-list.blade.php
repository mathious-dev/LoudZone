<div class="p-6 bg-white rounded-lg shadow-md max-w-7xl mx-auto mt-8">
    
    <!-- En-tête avec le titre et le bouton d'ajout -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <h2 class="text-2xl font-bold text-gray-800">Gestion des utilisateurs</h2>
        <a href="{{ route('admin.userForm.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 transition ease-in-out duration-150 shadow-sm">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Ajouter un utilisateur
        </a>
    </div>

    <!-- ========================================== -->
    <!-- BARRE DE RECHERCHE ET FILTRES              -->
    <!-- ========================================== -->
    <div class="mb-6 bg-gray-50 p-4 rounded-lg border border-gray-200 flex flex-col md:flex-row gap-4 items-center justify-between">
        
        <!-- Le groupe "Filtre + Recherche" fusionné -->
        <div class="flex w-full md:w-2/3 shadow-sm rounded-md">
            
            <!-- 1. Le sélecteur de colonne (à gauche, attaché à l'input) -->
            <select wire:model.live="searchWichColumn" 
                    class="block w-1/3 md:w-48 pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-l-md bg-gray-100 text-gray-700 font-medium">
                @foreach ($tabSearchPossibility as $possibility => $label)
                    <option value="{{ $possibility }}">{{ $label }}</option>
                @endforeach
            </select>
            
            <!-- 2. Le champ de texte (à droite) -->
            <div class="relative flex-grow focus-within:z-10">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input wire:model.live.debounce.300ms="search" 
                       type="text" 
                       placeholder="Rechercher..." 
                       class="block w-full pl-10 pr-3 py-2 border-l-0 border-gray-300 rounded-none rounded-r-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            
        </div>
        
        <!-- Petit texte d'information (Optionnel, disparaît sur mobile) -->
        <div class="hidden md:block text-sm text-gray-500">
            {{ $listUsers->total() }} utilisateur(s) trouvé(s)
        </div>
        
    </div>

    <!-- ========================================== -->
    <!-- LE TABLEAU (Ton code intact)               -->
    <!-- ========================================== -->
    <div class="overflow-x-auto shadow-sm rounded-lg border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prénom</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NewsLetter</th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($listUsers as $user)
                <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                     <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $user->name }}</td>
                     <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $user->first_name }}</td>
                     <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $user->email }}</td>
                     <td class="px-6 py-4 whitespace-nowrap text-sm">
                        @if($user->news_letter)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Oui</span>
                        @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Non</span>
                        @endif
                    </td>
                    
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        @if(auth()->id() !== $user->id)
                            <div class="flex justify-end space-x-3">
                                <a href="{{ route('admin.userForm.edit', $user) }}" class="text-indigo-600 hover:text-indigo-900 transition duration-150">Modifier</a>
                                <button wire:click="delete({{ $user->id }})" wire:confirm="Êtes-vous sûr de supprimer l'utilisateur ?" class="text-red-600 hover:text-red-900 transition duration-150">Supprimer</button>
                            </div>
                        @else
                            <span class="text-gray-400 italic text-xs">Vous-même</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $listUsers->links() }}
    </div>
    
</div>