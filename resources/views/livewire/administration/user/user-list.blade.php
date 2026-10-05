
<div class="p-6 bg-white rounded-lg shadow-md max-w-7xl mx-auto mt-8">
    
    <!-- Conteneur avec scroll horizontal si l'écran est trop petit -->
    <div class="overflow-x-auto">
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
                    <th>
                        Actions
                    </th>
                </tr>
            </thead>
            <a href="{{ route('admin.userForm.create') }}">Ajouter un utilisateur</a>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($listUsers as $user)
                <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                     <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                         {{ $user->name }}
                     </td>
                     <!-- Attention ici : c'est bien firstname et mail -->
                     <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                         {{ $user->first_name }}
                     </td>
                     <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                         {{ $user->email }}
                     </td>
                     <td class="px-6 py-4 whitespace-nowrap text-sm">
                        @if($user->news_letter)
                            <!-- Un joli badge vert pour "Oui" -->
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Oui
                            </span>
                        @else
                            <!-- Un badge gris/rouge pour "Non" -->
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                Non
                            </span>
                        @endif
                    </td>
                    @if(auth()->id()!==$user->id)
                    <td><button wire:click="delete({{ $user->id }})">Supprimer</button></td>
                    @endif
                    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Espace pour la pagination -->
    <div class="mt-4">
        {{ $listUsers->links() }}
    </div>
    
</div>