<div class="bg-white rounded-lg shadow-md mb-8 overflow-hidden">
    
    <!-- En-tête avec Titre et Bouton Ajouter -->
    <div class="flex flex-col sm:flex-row justify-between items-center p-6 border-b border-gray-200 bg-white gap-4">
        <h2 class="text-xl font-bold text-gray-800">Liste des événements</h2>
        <a href="{{ route('admin.eventForm.create') }}" 
           class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 transition ease-in-out duration-150 shadow-sm">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Ajouter un événement
        </a>
    </div>

    <!-- Zone de Recherche et Filtres -->
    <div class="p-4 bg-gray-50 border-b border-gray-200 flex flex-col md:flex-row gap-4 items-center">
        <div class="w-full md:w-2/3">
            <x-search :options="$tabSearchPossibility" :listSearch="$listSearch" :search="$search" :searchWichColumn="$searchWichColumn"/>
        </div>
        <div class="w-full md:w-1/3 flex justify-end">
            <x-search-asc-desc :options="$tabSearchAscDescPossibility"/>
        </div>
    </div>

    <!-- Conteneur du tableau -->
    <div class="overflow-x-auto">
        <table class="min-w-full text-left text-sm whitespace-nowrap">
            <thead class="bg-gray-100 text-gray-600 uppercase tracking-wider border-b-2 border-gray-200">
                <tr>
                    <!-- 1. Nouvelle colonne vide pour la flèche -->
                    <th scope="col" class="px-4 py-4 w-10"></th> 
                    <th scope="col" class="px-6 py-4 font-semibold">Nom</th>
                    <th scope="col" class="px-6 py-4 font-semibold">Description</th>
                    <th scope="col" class="px-6 py-4 font-semibold">Début</th>
                    <th scope="col" class="px-6 py-4 font-semibold">Fin</th>
                    <th scope="col" class="px-6 py-4 font-semibold">Adresse</th>
                    <th scope="col" class="px-6 py-4 font-semibold text-center">Statut</th>
                    <!-- L'ancienne colonne Image principale est supprimée ici -->
                    <th scope="col" class="px-6 py-4 font-semibold text-right">Actions</th>
                </tr>
            </thead>
            
            <!-- 2. On retire le tbody global et on en crée un par élément avec AlpineJS -->
            @foreach ($listEvents as $event)
                <tbody x-data="{ open: false }" class="border-b border-gray-100">
                    
                    <!-- Ligne Principale -->
                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                        
                        <!-- Flèche de déroulement -->
                        <td class="px-4 py-4 text-center">
                            <button @click="open = !open" type="button" class="text-gray-500 hover:text-indigo-600 focus:outline-none transition-colors">
                                <svg class="w-5 h-5 transform transition-transform duration-200" 
                                     :class="{ 'rotate-90': open }" 
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </td>

                        <!-- Nom -->
                        <td class="px-6 py-4 font-bold text-gray-800">
                            {{ $event->label }}
                        </td>
                        
                        <!-- Description -->
                        <td class="px-6 py-4 text-gray-600 truncate max-w-xs" title="{{ $event->description }}">
                            {{ $event->description }}
                        </td>
                        
                        <!-- Dates -->
                        <td class="px-6 py-4 text-blue-600 font-medium">
                            {{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y H:i') }}
                        </td>
                        <td class="px-6 py-4 text-red-600 font-medium">
                            {{ \Carbon\Carbon::parse($event->end_date)->format('d/m/Y H:i') }}
                        </td>
                        
                        <!-- Adresse -->
                        <td class="px-6 py-4">
                            @if($event->address)
                                <div class="text-gray-900 font-medium">{{ $event->address->city }} ({{ $event->address->postal_code }})</div>
                                <div class="text-gray-500 text-xs mt-1">{{ $event->address->street ?? 'Rue non spécifiée' }}</div>
                            @else
                                <span class="text-gray-400 italic text-xs">Aucune adresse</span>
                            @endif
                        </td>
                        
                        <!-- Statut -->
                        <td class="px-6 py-4 text-center">
                            @if($event->is_important)
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800 border border-green-200">
                                    En avant
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600 border border-gray-200">
                                    Standard
                                </span>
                            @endif
                        </td>
                        
                        <!-- Actions -->
                        <td class="px-6 py-4 text-right text-sm font-medium space-x-3">
                            <button wire:click="changePublish({{ $event->id }})" 
                                    class="font-semibold transition-colors focus:outline-none {{ $event->is_important ? 'text-orange-600 hover:text-orange-900' : 'text-green-600 hover:text-green-900' }}">
                                {{ $event->is_important ? 'Dépublier' : 'Mettre en avant' }}
                            </button>

                            <a href="{{ route('admin.eventForm.edit', $event) }}" class="text-indigo-600 hover:text-indigo-900 font-semibold transition-colors">
                                Modifier
                            </a>
                            
                            <button wire:click="delete({{ $event->id }})" wire:confirm="Êtes-vous sûr de vouloir supprimer cet événement ?" class="text-red-600 hover:text-red-900 font-semibold transition-colors focus:outline-none">
                                Supprimer
                            </button>
                        </td>
                    </tr>

                    <!-- 3. Ligne Déroulante (Image) -->
                    <tr x-show="open" 
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 -translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        style="display: none;" 
                        class="bg-gray-50">
                        
                        <!-- Colspan 8 pour prendre toute la largeur du tableau -->
                        <td colspan="8" class="px-6 py-4 border-t border-gray-100">
                            @if($event->primary_image)
                                <div class="flex items-center gap-6">
                                    <img src="{{ asset('storage/'.$event->primary_image) }}" alt="Image de {{ $event->label }}" class="h-32 w-auto object-cover rounded-md shadow border border-gray-200">
                                    <div class="text-sm text-gray-500">
                                        <p class="font-semibold text-gray-700">Image principale de l'événement</p>
                                        <p>Cliquez sur modifier pour la remplacer.</p>
                                    </div>
                                </div>
                            @else
                                <div class="text-gray-400 italic text-sm py-4 flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    Aucune image principale associée à cet événement.
                                </div>
                            @endif
                        </td>
                    </tr>

                </tbody>
            @endforeach
        </table>
    </div>
    
    <!-- Pagination -->
    <div class="p-4 bg-white border-t border-gray-200">
        {{ $listEvents->links() }}
    </div>
</div>