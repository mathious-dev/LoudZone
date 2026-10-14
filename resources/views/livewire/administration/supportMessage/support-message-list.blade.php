<div class="p-6 bg-white rounded-lg shadow-md max-w-7xl mx-auto mt-8">
    
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Messages de Support</h2>
    </div>

    <!-- Espace de recherche et filtres -->
    <div class="flex flex-col sm:flex-row gap-4 mb-6">
        <div class="w-full sm:w-1/2">
            <x-search :options="$tabSearchPossibility"/>
        </div>
        <div class="w-full sm:w-1/2">
            <x-search-asc-desc :options="$tabSearchAscDescPossibility"/>
        </div>
        <div>
            <x-search-category :options="$tabSearchCategoryPossibility"/>
        </div>
    </div>

    <!-- Tableau -->
    <div class="overflow-x-auto shadow-sm rounded-lg border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Demande</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Utilisateur</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Catégorie</th>
                    <!-- 1. NOUVELLE COLONNE EN-TÊTE -->
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Précision</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">État</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Détails</th>
                </tr>
            </thead>
            
            @foreach ($listSupportMessages as $supportMessage)
            <!-- Alpine.js gère l'accordéon au niveau du <tbody> -->
            <tbody x-data="{ expanded: false }" class="bg-white divide-y divide-gray-200">
                
                <!-- LIGNE PRINCIPALE -->
                <tr wire:key="msg-{{ $supportMessage->id }}" class="hover:bg-gray-50 transition duration-150 ease-in-out">
                    
                    <!-- Date et Heure -->
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <div class="font-medium text-gray-900">{{ $supportMessage->created_at->format('d/m/Y') }}</div>
                        <div class="text-xs text-gray-400">{{ $supportMessage->created_at->format('H:i') }}</div>
                    </td>
                    
                    <td class="px-6 py-4 text-sm text-gray-900 w-1/3">
                        <div class="font-bold text-gray-800 mb-1">{{ $supportMessage->title }}</div>
                        <div class="text-gray-500 line-clamp-1">{{ $supportMessage->content }}</div>
                    </td>
                    
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $supportMessage->user ? $supportMessage->user->name . ' ' . $supportMessage->user->first_name : 'Utilisateur supprimé' }}
                    </td>
                    
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-indigo-600 font-medium">
                        {{ $supportMessage->supportMessageCategory?->label ?? 'Catégorie supprimée' }}
                    </td>
                    
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        @if($supportMessage->addInfo) <!-- Singulier ! -->
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                {{ $supportMessage->addInfo->label }}
                            </span>
                        @else
                            <span class="text-gray-400 italic text-xs">Aucune</span>
                        @endif
                    </td>
                    
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        @if($supportMessage->state)
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Fini
                            </span>
                        @else
                            <button wire:click="messageTreat({{ $supportMessage->id }})" class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-orange-100 text-orange-800 hover:bg-orange-200 transition-colors">
                                En attente
                            </button>
                        @endif
                    </td>
                    
                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                        @if($supportMessage->state)
                        <button wire:click="delete({{ $supportMessage->id }})" wire:confirm="Êtes-vous sûr de vouloir supprimer définitivement ce message ?" class="text-red-600 hover:text-red-900 transition-colors">
                            Supprimer
                        </button>
                        @endif
                    </td>

                    <!-- Bouton flèche (Alpine.js) -->
                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                        <button @click="expanded = !expanded" class="text-gray-500 hover:text-gray-900 focus:outline-none transition-transform duration-200" :class="{'rotate-180': expanded}">
                            <svg class="w-6 h-6 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                    </td>
                </tr>

                <!-- LIGNE DÉROULANTE (Accordéon) -->
                <tr x-cloak x-show="expanded" x-transition.opacity class="bg-gray-50">
                    <!-- 3. MODIFICATION DU COLSPAN DE 7 à 8 -->
                    <td colspan="8" class="px-8 py-6 border-t-0">
                        <div class="text-sm text-gray-800 p-5 border border-indigo-100 rounded-lg bg-white shadow-sm">
                            <div class="flex items-center justify-between mb-3 border-b border-gray-100 pb-2">
                                <h4 class="font-bold text-lg text-indigo-900">Détail de la demande</h4>
                            </div>
                            <p class="whitespace-pre-line leading-relaxed text-gray-700">
                                {!! nl2br(e($supportMessage->content)) !!}
                            </p>
                        </div>
                    </td>
                </tr>
                
            </tbody>
            @endforeach
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $listSupportMessages->links() }}
    </div>
    
</div>