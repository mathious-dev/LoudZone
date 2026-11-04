<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    
    <!-- En-tête de la page -->
    <div class="mb-6">
        <h1 class="text-2xl font-black text-[#0B0A0B]">Liste des événements</h1>
        <p class="text-sm text-[#84796F] mt-1">Gestion des événements, dates et mises en avant.</p>
    </div>

    <!-- Espace de recherche et filtres -->
    <div class="flex flex-col sm:flex-row gap-4 mb-6">
        <div class="w-full sm:w-2/3">
            <x-search :options="$tabSearchPossibility" :listSearch="$listSearch" :search="$search" :searchWichColumn="$searchWichColumn" :showList="$showList" />
        </div>
        <div class="w-full sm:w-1/3">
            <x-search-asc-desc :options="$tabSearchAscDescPossibility"/>
        </div>
    </div>
    
    <!-- Bouton Ajouter placé au-dessus du tableau pour plus de lisibilité -->
    <div class="flex justify-end mb-6">
        <a href="{{ route('admin.eventForm.create') }}" 
           class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#5D0824] text-[#FAF1E3] text-sm font-bold rounded-lg hover:bg-[#0B0A0B] transition-colors shadow-md">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Ajouter un événement
        </a>
    </div>

    <!-- Conteneur du tableau -->
    <div class="bg-white rounded-2xl shadow-sm border border-[#84796F]/20 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-[#84796F]/20">
                <thead class="bg-[#FAF1E3]/40">
                    <tr>
                        <!-- Nouvelle colonne vide pour la flèche -->
                        <th scope="col" class="px-4 py-4 w-10 text-center text-xs font-black text-[#41342D] uppercase tracking-wider"></th> 
                        <th scope="col" class="px-6 py-4 text-left text-xs font-black text-[#41342D] uppercase tracking-wider">Nom</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-black text-[#41342D] uppercase tracking-wider">Description</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-black text-[#41342D] uppercase tracking-wider">Début</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-black text-[#41342D] uppercase tracking-wider">Fin</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-black text-[#41342D] uppercase tracking-wider">Adresse</th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-black text-[#41342D] uppercase tracking-wider">Statut</th>
                        <th scope="col" class="px-6 py-4 text-right text-xs font-black text-[#41342D] uppercase tracking-wider w-32">Actions</th>
                    </tr>
                </thead>
                
                @forelse ($listEvents as $event)
                    <!-- On retire le tbody global et on en crée un par élément avec AlpineJS -->
                    <tbody x-data="{ open: false }" class="divide-y divide-[#84796F]/10 bg-white">
                        
                        <!-- Ligne Principale -->
                        <tr class="hover:bg-[#FAF1E3]/20 transition-colors">
                            
                            <!-- Flèche de déroulement -->
                            <td class="px-4 py-4 text-center">
                                <button @click="open = !open" type="button" class="text-[#84796F] hover:text-[#0B0A0B] focus:outline-none transition-colors p-1 rounded-full hover:bg-[#84796F]/10" title="Voir l'image">
                                    <svg class="w-5 h-5 transform transition-transform duration-200" 
                                         :class="{ 'rotate-90': open }" 
                                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </button>
                            </td>

                            <!-- Nom -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-[#0B0A0B]">
                                {{ $event->label }}
                            </td>
                            
                            <!-- Description -->
                            <td class="px-6 py-4 text-sm text-[#41342D] truncate max-w-[200px]" title="{{ $event->description }}">
                                {{ $event->description }}
                            </td>
                            
                            <!-- Dates -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-black text-[#5D0824]">
                                {{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-black text-[#84796F]">
                                {{ \Carbon\Carbon::parse($event->end_date)->format('d/m/Y H:i') }}
                            </td>
                            
                            <!-- Adresse -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                @if($event->address)
                                    <div class="font-bold text-[#0B0A0B]">{{ $event->address->city }} ({{ $event->address->postal_code }})</div>
                                    <div class="text-xs text-[#84796F] mt-1">{{ $event->address->street ?? 'Rue non spécifiée' }}</div>
                                @else
                                    <span class="text-[#84796F]/60 italic text-xs">Aucune adresse</span>
                                @endif
                            </td>
                            
                            <!-- Statut (Mise en avant) -->
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm">
                                @if($event->is_important)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-[#5D0824]/10 text-[#5D0824] border border-[#5D0824]/20">
                                        En avant
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-[#84796F]/10 text-[#41342D] border border-[#84796F]/20">
                                        Standard
                                    </span>
                                @endif
                            </td>
                            
                            <!-- Actions -->
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end gap-3">
                                    
                                    <!-- Bouton Mettre en avant / Dépublier -->
                                    <button wire:click="changePublish({{ $event->id }})" 
                                            class="focus:outline-none transition-transform hover:scale-110 {{ $event->is_important ? 'text-[#5D0824]' : 'text-[#84796F] hover:text-[#5D0824]' }}" 
                                            title="{{ $event->is_important ? 'Retirer la mise en avant' : 'Mettre en avant' }}">
                                        @if($event->is_important)
                                            <!-- Icône Étoile pleine (Dépublier) -->
                                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                            </svg>
                                        @else
                                            <!-- Icône Étoile vide (Mettre en avant) -->
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                            </svg>
                                        @endif
                                    </button>

                                    <!-- Bouton Modifier -->
                                    <a href="{{ route('admin.eventForm.edit', $event) }}" 
                                       class="text-[#84796F] hover:text-[#0B0A0B] transition-colors" title="Modifier">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                        </svg>
                                    </a>
                                    
                                    <!-- Bouton Supprimer -->
                                    <button wire:click="delete({{ $event->id }})" 
                                            wire:confirm="Êtes-vous sûr de vouloir supprimer cet événement ?" 
                                            class="text-[#84796F] hover:text-red-600 transition-colors" title="Supprimer">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Ligne Déroulante (Image) via AlpineJS -->
                        <tr x-cloak x-show="open" 
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 -translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            class="bg-[#FAF1E3]/20 border-t border-[#84796F]/5">
                            
                            <!-- Colspan 8 pour prendre toute la largeur du tableau -->
                            <td colspan="8" class="px-6 py-6">
                                @if($event->primary_image)
                                    <div class="flex items-start gap-6 p-4 border border-[#84796F]/20 rounded-xl bg-white shadow-sm">
                                        <img src="{{ asset('storage/'.$event->primary_image) }}" 
                                             alt="Image de {{ $event->label }}" 
                                             class="h-32 w-auto object-cover rounded-lg border border-[#84796F]/10">
                                        <div class="text-sm text-[#41342D]">
                                            <p class="font-black text-[#0B0A0B] text-lg mb-1">Aperçu visuel</p>
                                            <p class="text-[#84796F]">Il s'agit de l'image principale mise en avant sur la page de l'événement.</p>
                                        </div>
                                    </div>
                                @else
                                    <div class="p-6 border border-[#84796F]/20 rounded-xl bg-white shadow-sm flex flex-col items-center justify-center text-center">
                                        <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-[#FAF1E3] text-[#84796F] mb-3">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                        <p class="text-[#41342D] font-bold">Aucune image principale</p>
                                        <p class="text-[#84796F] text-sm mt-1">Éditez l'événement pour y ajouter un visuel.</p>
                                    </div>
                                @endif
                            </td>
                        </tr>

                    </tbody>
                @empty
                    <tbody>
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center text-[#84796F] italic">
                                Aucun événement n'a été créé pour le moment.
                            </td>
                        </tr>
                    </tbody>
                @endforelse
            </table>
        </div>
    </div>
    
    <!-- Pagination -->
    @if (method_exists($listEvents, 'hasPages') && $listEvents->hasPages())
        <div class="mt-6">
            {{ $listEvents->links() }}
        </div>
    @endif
    
</div>