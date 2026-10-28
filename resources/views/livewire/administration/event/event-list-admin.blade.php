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

    <!-- Zone de Recherche et Filtres (Avec un fond légèrement gris et du padding) -->
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
                    <th scope="col" class="px-6 py-4 font-semibold">Nom</th>
                    <th scope="col" class="px-6 py-4 font-semibold">Description</th>
                    <th scope="col" class="px-6 py-4 font-semibold">Date de début</th>
                    <th scope="col" class="px-6 py-4 font-semibold">Date de fin</th>
                    <th scope="col" class="px-6 py-4 font-semibold">Adresse</th>
                    <th scope="col" class="px-6 py-4 font-semibold text-center">Statut</th>
                    <th scope="col" class="px-6 py-4 font-semibold text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($listEvents as $event)
                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                        
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
                            {{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y à H:i') }}
                        </td>
                        <td class="px-6 py-4 text-red-600 font-medium">
                            {{ \Carbon\Carbon::parse($event->end_date)->format('d/m/Y à H:i') }}
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
                        
                        <!-- Statut (Important / Publié) avec des badges visuels -->
                        <td class="px-6 py-4 text-center">
                            @if($event->is_important)
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800 border border-green-200">
                                    En avant (Accueil)
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600 border border-gray-200">
                                    Standard
                                </span>
                            @endif
                        </td>

                        <!-- Actions -->
                        <td class="px-6 py-4 text-right text-sm font-medium space-x-3">
                            
                            <!-- Bouton Dynamique Publier / Dépublier -->
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
                @endforeach
            </tbody>
        </table>
    </div>
    
    <!-- Pagination (avec un peu d'espace autour) -->
    <div class="p-4 bg-white border-t border-gray-200">
        {{ $listEvents->links() }}
    </div>
</div>