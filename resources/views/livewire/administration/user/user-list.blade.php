<div class="p-6 bg-white rounded-lg shadow-md max-w-7xl mx-auto mt-8">
    
    <!-- En-tête avec le titre et le bouton d'ajout -->
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-2xl font-bold text-gray-800">Gestion des utilisateurs</h2>
        <a href="{{ route('admin.userForm.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 transition ease-in-out duration-150 shadow-sm">
            + Ajouter un utilisateur
        </a>
    </div>

    <!-- ========================================== -->
    <!-- BARRE D'OUTILS (Recherche + Tri)           -->
    <!-- ========================================== -->
    <div class="flex flex-col lg:flex-row justify-between items-center gap-4 mb-6 bg-gray-50 p-4 rounded-xl border border-gray-100">
        
        <!-- Le composant de recherche (prend toute la place dispo à gauche) -->
        <div class="w-full lg:w-2/3">
            <x-search :options="$tabSearchPossibility" :listSearch="$listSearch" :search="$search" :searchWichColumn="$searchWichColumn"/>
        </div>

        <!-- Le composant de tri (aligné à droite) -->
        <div class="w-full lg:w-auto flex justify-end">
            <x-search-asc-desc :options="$tabSearchAscDescPossibility"/>
        </div>
        <div>
            <x-search-boolean label-true="Avec NewsLetter" label-false="Sans NewsLetter"/>
        </div>
        <div class="relative w-full md:w-64">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <!-- Icône de filtre/utilisateur -->
                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                </svg>
            </div>
            
            <select wire:model.live='searchRole' 
                    class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#5D0824] focus:border-[#5D0824] block w-full pl-10 p-2.5 shadow-sm transition-colors cursor-pointer appearance-none">
                <option value="">Tous les rôles</option>
                
                <!-- On utilise bien l'objet $role ici -->
                @foreach ($listRoles as $role)
                    <option value="{{ $role->id }}">{{ ucfirst($role->name) }}</option>
                @endforeach
                
            </select>

            <!-- Flèche personnalisée à droite -->
            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-500">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </div>
        </div>
    </div>

    <!-- ========================================== -->
    <!-- LE TABLEAU                                 -->
    <!-- ========================================== -->
    <div class="overflow-x-auto shadow-sm rounded-lg border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prénom</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NewsLetter</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rôle</th>
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
                    <td>
                        {{ $user->roles->pluck('name')->implode(', ') }}
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