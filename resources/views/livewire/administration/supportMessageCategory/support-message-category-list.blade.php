<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    
    <!-- En-tête avec Titre et Bouton Ajouter -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <div>
            <h1 class="text-2xl font-black text-[#0B0A0B]">Catégories de Support</h1>
            <p class="text-sm text-[#84796F] mt-1">Gestion des thématiques pour les demandes d'assistance.</p>
        </div>
        <a href="{{ route('admin.supportMessageCategory.create') }}" 
           class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#5D0824] text-[#FAF1E3] text-sm font-bold rounded-lg hover:bg-[#0B0A0B] transition-colors shadow-md">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Ajouter une catégorie
        </a>
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

    <!-- Conteneur du tableau -->
    <div class="bg-white rounded-2xl shadow-sm border border-[#84796F]/20 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-[#84796F]/20">
                <thead class="bg-[#FAF1E3]/40">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-black text-[#41342D] uppercase tracking-wider">
                            Nom de la catégorie
                        </th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-black text-[#41342D] uppercase tracking-wider">
                            Messages associés
                        </th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-black text-[#41342D] uppercase tracking-wider">
                            Infos supplémentaires
                        </th>
                        <th scope="col" class="px-6 py-4 text-right text-xs font-black text-[#41342D] uppercase tracking-wider w-32">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#84796F]/10 bg-white">
                    @forelse ($listSupportMessageCategories as $category)
                        <tr class="hover:bg-[#FAF1E3]/20 transition-colors">
                            
                            <!-- Nom -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-[#0B0A0B]">
                                {{ $category->label }}
                            </td>
                            
                            <!-- Compteur Messages (Badge interactif) -->
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm">
                                <a href="{{ route('admin.supportMessageList', ['support_message_category_id' => $category->id]) }}" class="group">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-[#5D0824]/10 text-[#5D0824] border border-[#5D0824]/20 group-hover:bg-[#5D0824] group-hover:text-[#FAF1E3] transition-colors">
                                        {{ $category->supportMessages?->count() ?? 0 }} messages
                                    </span>
                                </a>
                            </td>
                            
                            <!-- Compteur Infos Supplémentaires (Badge neutre) -->
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-[#84796F]/10 text-[#41342D] border border-[#84796F]/20">
                                    {{ $category->addInfos?->count() ?? 0 }} options
                                </span>
                            </td>
                            
                            <!-- Actions -->
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end gap-3">
                                    <!-- Bouton Modifier -->
                                    <a href="{{ route('admin.supportMessageCategory.edit', $category) }}" 
                                       class="text-[#84796F] hover:text-[#0B0A0B] transition-colors" title="Modifier">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                        </svg>
                                    </a>
                                    
                                    <!-- Bouton Supprimer -->
                                    <button wire:click="delete({{ $category->id }})" 
                                            wire:confirm="Êtes-vous sûr de vouloir supprimer cette catégorie ?" 
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
                            <td colspan="4" class="px-6 py-12 text-center text-[#84796F] italic">
                                Aucune catégorie n'a été créée pour le moment.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>