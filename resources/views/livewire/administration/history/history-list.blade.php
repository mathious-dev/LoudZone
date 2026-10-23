<div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
    <!-- En-tête de la carte -->
    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
        <h2 class="text-xl font-semibold text-gray-800">Historique des actions</h2>
        <span class="text-xs font-medium bg-indigo-100 text-indigo-800 px-3 py-1 rounded-full">MongoDB</span>
    </div>
        
    <x-search :options="$tabSearchPossibility" :listSearch="$listSearch" :search="$search" :searchWichColumn="$searchWichColumn"/>
    <x-search-asc-desc :options="$tabSearchAscDescPossibility"/>
    <!-- Conteneur avec scroll horizontal pour petits écrans -->
    <div class="overflow-x-auto">
        <table class="w-full whitespace-nowrap text-left border-collapse">
            
            <!-- En-tête du tableau -->
            <thead class="bg-gray-50 border-b border-gray-200 text-xs uppercase text-gray-500 tracking-wider">
                <tr>
                    <th class="px-6 py-4 font-medium">Date</th>
                    <th class="px-6 py-4 font-medium text-center">ID Utilisateur</th>
                    <th class="px-6 py-4 font-medium">Nom d'utilisateur</th>
                    <th class="px-6 py-4 font-medium">Action</th>
                    <th></th>
                </tr>
            </thead>
            
            <!-- Corps du tableau -->
            <tbody class="divide-y divide-gray-200">
                @foreach ($listHistories as $history)
                <tr class="hover:bg-gray-50 transition-colors duration-200">
                    
                    <!-- Date discrète -->
                    <td class="px-6 py-4 text-sm text-gray-500">
                        {{ $history->created_at->format('d/m/Y') }} 
                        <span class="text-gray-400 ml-1">{{ $history->created_at->format('H:i') }}</span>
                    </td>
                    
                    <!-- ID formaté comme une référence (police monospace) -->
                    <td class="px-6 py-4 text-sm text-gray-400 text-center font-mono">
                        #{{ $history->user_id }}
                    </td>
                    
                    <!-- Nom mis en évidence -->
                    <td class="px-6 py-4 text-sm font-semibold text-gray-900">
                        {{ $history->user_name }}
                    </td>
                    
                    <!-- Action colorée pour être lisible rapidement -->
                    <td class="px-6 py-4 text-sm text-indigo-600 font-medium">
                        {{ $history->action }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <button wire:click="delete('{{ $history->_id }}')" wire:confirm="Êtes-vous sûr de vouloir supprimer cette information ?"
                                class="inline-flex items-center px-3 py-1.5 bg-red-50 text-red-600 hover:bg-red-600 hover:text-white rounded-md text-xs font-bold uppercase tracking-wider transition-colors duration-200 shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Supprimer
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-12">
        {{ $listHistories->links() }}
    </div>
</div>