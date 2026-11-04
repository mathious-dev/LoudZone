<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    
    <!-- En-tête avec le Titre et le Bouton d'ajout -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <div>
            <h1 class="text-2xl font-black text-[#0B0A0B]">Gestion des Annonces</h1>
            <p class="text-sm text-[#84796F] mt-1">Gérez les bandeaux et messages d'information du site.</p>
        </div>
        <a href="{{ route('admin.announcementForm.create') }}" 
           class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#5D0824] text-[#FAF1E3] text-sm font-bold rounded-lg hover:bg-[#0B0A0B] transition-colors shadow-md">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Ajouter une annonce
        </a>
    </div>

    <!-- Le Tableau de bord -->
    <div class="bg-white rounded-2xl shadow-sm overflow-visible border border-[#84796F]/20">
        <!-- Attention : overflow-visible sur le parent pour le popover Alpine -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-[#84796F]/20">
                <thead class="bg-[#FAF1E3]/40">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-black text-[#41342D] uppercase tracking-wider">Titre</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-black text-[#41342D] uppercase tracking-wider">Contenu</th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-black text-[#41342D] uppercase tracking-wider">Statut</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-black text-[#41342D] uppercase tracking-wider">Début</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-black text-[#41342D] uppercase tracking-wider">Fin</th>
                        <th scope="col" class="px-6 py-4 text-right text-xs font-black text-[#41342D] uppercase tracking-wider w-32">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#84796F]/10 bg-white">
                    @forelse ($listAnnouncements as $announcement)
                        <tr class="hover:bg-[#FAF1E3]/20 transition-colors">
                            
                            <!-- Titre -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-[#0B0A0B]">
                                {{ $announcement->label }}
                            </td>
                            
                            <!-- Contenu -->
                            <td class="px-6 py-4 text-sm text-[#41342D] max-w-[200px] truncate" title="{{ $announcement->content }}">
                                {{ $announcement->content }}
                            </td>
                            
                            <!-- Statut (Badge) -->
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm">
                                @if($announcement->is_showing)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-50 text-green-700 border border-green-200">
                                        Publié
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-[#84796F]/10 text-[#41342D] border border-[#84796F]/20">
                                        Masqué
                                    </span>
                                @endif
                            </td>
                            
                            <!-- Date de début -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-[#41342D] font-medium">
                                @if($announcement->start_date)
                                    {{ \Carbon\Carbon::parse($announcement->start_date)->format('d/m/Y H:i') }}
                                @elseif($announcement->is_showing)
                                    <span class="text-red-500 font-bold text-xs bg-red-50 px-2 py-1 rounded border border-red-200">Date requise !</span>
                                @else
                                    <span class="text-[#84796F]/60 italic text-xs">Non définie</span>
                                @endif
                            </td>

                            <!-- Date de fin -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-[#41342D] font-medium">
                                @if($announcement->end_date)
                                    {{ \Carbon\Carbon::parse($announcement->end_date)->format('d/m/Y H:i') }}
                                @else
                                    <span class="text-[#84796F]/60 italic text-xs">Non définie</span>
                                @endif
                            </td>
                            
                            <!-- Actions -->
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end items-center gap-3">
                                    
                                    <!-- ========================================== -->
                                    <!-- MENU PUBLIER (POPOVER ALPINE)              -->
                                    <!-- ========================================== -->
                                    <div x-data="{ open: false }" class="relative flex items-center">
                                        <button @click="open = !open" 
                                                class="font-black text-xs uppercase tracking-wide transition-colors {{ $announcement->is_showing ? 'text-green-600 hover:text-green-800' : 'text-[#84796F] hover:text-[#5D0824]' }}">
                                            {{ $announcement->is_showing ? 'Dépublier' : 'Publier' }}
                                        </button>
                                        
                                        <!-- Le Popover (Reste inchangé dans sa logique) -->
                                        <div x-cloak x-show="open" 
                                            x-transition:enter="transition ease-out duration-200"
                                            x-transition:enter-start="opacity-0 translate-x-4"
                                            x-transition:enter-end="opacity-100 translate-x-0"
                                            x-transition:leave="transition ease-in duration-150"
                                            x-transition:leave-start="opacity-100 translate-x-0"
                                            x-transition:leave-end="opacity-0 translate-x-4"
                                            @click.away="open = false"
                                            class="absolute right-[120%] top-1/2 -translate-y-1/2 w-72 p-5 bg-white border border-[#84796F]/20 rounded-xl shadow-xl z-50 text-left">
                                            
                                            <!-- Petite flèche décorative -->
                                            <div class="absolute top-1/2 -right-2 -translate-y-1/2 w-4 h-4 bg-white border-t border-r border-[#84796F]/20 transform rotate-45 z-0"></div>

                                            <div class="relative z-10">
                                                <h4 class="font-black text-[#0B0A0B] mb-4 text-sm border-b border-[#84796F]/10 pb-2">Période de publication</h4>
                                                
                                                <div class="space-y-4">
                                                    <div>
                                                        <label class="block text-xs font-bold text-[#41342D] mb-1">Date de début</label>
                                                        <input type="datetime-local" wire:model="start_date" 
                                                            class="block w-full text-sm rounded-lg border-[#84796F]/30 shadow-sm focus:border-[#5D0824] focus:ring-[#5D0824] bg-[#FAF1E3]/20">
                                                    </div>
                                                    
                                                    <div>
                                                        <label class="block text-xs font-bold text-[#41342D] mb-1">Date de fin (Optionnelle)</label>
                                                        <input type="datetime-local" wire:model="end_date" 
                                                            class="block w-full text-sm rounded-lg border-[#84796F]/30 shadow-sm focus:border-[#5D0824] focus:ring-[#5D0824] bg-[#FAF1E3]/20">
                                                    </div>
                                                    
                                                    <div class="pt-2">
                                                        <button wire:click="publishing({{ $announcement }})" @click="open = false"
                                                                class="w-full flex justify-center items-center py-2 px-4 rounded-lg shadow-sm text-sm font-bold text-[#FAF1E3] bg-[#5D0824] hover:bg-[#0B0A0B] focus:outline-none transition-colors">
                                                            Confirmer
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Fin Menu Publier -->

                                    <!-- Bouton Modifier (SVG) -->
                                    <a href="{{ route('admin.announcementForm.edit', $announcement) }}" 
                                       class="text-[#84796F] hover:text-[#0B0A0B] transition-colors" title="Modifier">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                        </svg>
                                    </a>
                                    
                                    <!-- Bouton Supprimer (SVG) -->
                                    <button wire:click="delete({{ $announcement->id }})" 
                                            wire:confirm="Êtes-vous sûr de vouloir supprimer cette annonce ?" 
                                            class="text-[#84796F] hover:text-red-600 transition-colors" title="Supprimer">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-[#84796F] italic">
                                Aucune annonce trouvée. Créez votre première annonce !
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if (method_exists($listAnnouncements, 'hasPages') && $listAnnouncements->hasPages())
            <div class="px-6 py-4 border-t border-[#84796F]/10 bg-white">
                {{ $listAnnouncements->links() }}
            </div>
        @endif

    </div>
</div>