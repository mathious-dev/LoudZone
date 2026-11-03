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
            <x-search :options="$tabSearchPossibility" :listSearch="$listSearch" :search="$search" :searchWichColumn="$searchWichColumn" :showList="$showList" />
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
                            <div class="flex justify-end items-center space-x-4">
                                
                                <!-- Bouton Voir (Bordeaux au survol) -->
                                <a href="{{ route('admin.userDetail', $user->id) }}" class="text-gray-400 hover:text-[#5D0824] transition-colors" title="Voir les détails">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 640 640">
                                        <path d="M320 96C239.2 96 174.5 132.8 127.4 176.6C80.6 220.1 49.3 272 34.4 307.7C31.1 315.6 31.1 324.4 34.4 332.3C49.3 368 80.6 420 127.4 463.4C174.5 507.1 239.2 544 320 544C400.8 544 465.5 507.2 512.6 463.4C559.4 419.9 590.7 368 605.6 332.3C608.9 324.4 608.9 315.6 605.6 307.7C590.7 272 559.4 220 512.6 176.6C465.5 132.9 400.8 96 320 96zM176 320C176 240.5 240.5 176 320 176C399.5 176 464 240.5 464 320C464 399.5 399.5 464 320 464C240.5 464 176 399.5 176 320zM320 256C320 291.3 291.3 320 256 320C244.5 320 233.7 317 224.3 311.6C223.3 322.5 224.2 333.7 227.2 344.8C240.9 396 293.6 426.4 344.8 412.7C396 399 426.4 346.3 412.7 295.1C400.5 249.4 357.2 220.3 311.6 224.3C316.9 233.6 320 244.4 320 256z"/>
                                    </svg>
                                </a>

                                <!-- Bouton Modifier (Indigo au survol) -->
                                <a href="{{ route('admin.userForm.edit', $user) }}" class="text-gray-400 hover:text-indigo-600 transition-colors" title="Modifier">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 640 640">
                                        <path d="M535.6 85.7C513.7 63.8 478.3 63.8 456.4 85.7L432 110.1L529.9 208L554.3 183.6C576.2 161.7 576.2 126.3 554.3 104.4L535.6 85.7zM236.4 305.7C230.3 311.8 225.6 319.3 222.9 327.6L193.3 416.4C190.4 425 192.7 434.5 199.1 441C205.5 447.5 215 449.7 223.7 446.8L312.5 417.2C320.7 414.5 328.2 409.8 334.4 403.7L496 241.9L398.1 144L236.4 305.7zM160 128C107 128 64 171 64 224L64 480C64 533 107 576 160 576L416 576C469 576 512 533 512 480L512 384C512 366.3 497.7 352 480 352C462.3 352 448 366.3 448 384L448 480C448 497.7 433.7 512 416 512L160 512C142.3 512 128 497.7 128 480L128 224C128 206.3 142.3 192 160 192L256 192C273.7 192 288 177.7 288 160C288 142.3 273.7 128 256 128L160 128z"/>
                                    </svg>
                                </a>

                                <!-- Bouton Supprimer (Rouge au survol) -->
                                <button wire:click="delete({{ $user->id }})" wire:confirm="Êtes-vous sûr de supprimer l'utilisateur ?" class="text-gray-400 hover:text-red-600 transition-colors" title="Supprimer">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 640 640">
                                        <path d="M232.7 69.9C237.1 56.8 249.3 48 263.1 48L377 48C390.8 48 403 56.8 407.4 69.9L416 96L512 96C529.7 96 544 110.3 544 128C544 145.7 529.7 160 512 160L128 160C110.3 160 96 145.7 96 128C96 110.3 110.3 96 128 96L224 96L232.7 69.9zM128 208L512 208L512 512C512 547.3 483.3 576 448 576L192 576C156.7 576 128 547.3 128 512L128 208zM216 272C202.7 272 192 282.7 192 296L192 488C192 501.3 202.7 512 216 512C229.3 512 240 501.3 240 488L240 296C240 282.7 229.3 272 216 272zM320 272C306.7 272 296 282.7 296 296L296 488C296 501.3 306.7 512 320 512C333.3 512 344 501.3 344 488L344 296C344 282.7 333.3 272 320 272zM424 272C410.7 272 400 282.7 400 296L400 488C400 501.3 410.7 512 424 512C437.3 512 448 501.3 448 488L448 296C448 282.7 437.3 272 424 272z"/>
                                    </svg>
                                </button>
                                
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