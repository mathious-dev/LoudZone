<div class="p-6 bg-white rounded-lg shadow-md max-w-7xl mx-auto mt-8">
    
    <!-- En-tête avec le titre et le bouton d'ajout bien alignés -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold text-gray-800">Gestion des utilisateurs</h2>
        <a href="{{ route('admin.userForm.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 transition ease-in-out duration-150">
            + Ajouter un utilisateur
        </a>
    </div>

    <!-- Conteneur avec scroll horizontal si l'écran est trop petit -->
    <div class="overflow-x-auto shadow-sm rounded-lg border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Nom
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Prénom
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        NewsLetter
                    </th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($listUsers as $user)
                <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                     <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                         {{ $user->name }}
                     </td>
                     <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                         {{ $user->first_name }}
                     </td>
                     <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                         {{ $user->email }}
                     </td>
                     <td class="px-6 py-4 whitespace-nowrap text-sm">
                        @if($user->news_letter)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Oui
                            </span>
                        @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                Non
                            </span>
                        @endif
                    </td>
                    
                    <!-- Colonne Actions regroupée -->
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        @if(auth()->id() !== $user->id)
                            <div class="flex justify-end space-x-3">
                                <a href="{{ route('admin.userForm.edit', $user) }}" class="text-indigo-600 hover:text-indigo-900 transition duration-150">
                                    Modifier
                                </a>
                                <button wire:click="delete({{ $user->id }})" wire:confirm="êtes-vous sûr de supprimer l'utilisateur?" class="text-red-600 hover:text-red-900 transition duration-150">
                                    Supprimer
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

    <!-- Espace pour la pagination -->
    <div class="mt-6">
        {{ $listUsers->links() }}
    </div>
    
</div>