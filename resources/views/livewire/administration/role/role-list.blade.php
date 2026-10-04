<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
    
    <!-- En-tête de la section (optionnel, pour faire propre) -->
    <div class="mb-4 flex justify-between items-center">
        <h3 class="text-lg font-medium text-gray-900">Liste des Rôles</h3>
    </div>

    <!-- Conteneur du tableau -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Rôle
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Nombre de personnes
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($listRoles as $role)
                <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                    
                    <!-- Nom du rôle (en gras) -->
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ ucfirst($role->name) }}
                    </td>
                    
                    <!-- Nombre d'utilisateurs (sous forme de badge bleu) -->
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800">
                            <!-- Note : Si tu as bien gardé le withCount('users') dans le PHP, 
                                 tu peux remplacer $role->users->count() par $role->users_count -->
                            {{ $role->users->count() }}
                        </span>
                    </td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>