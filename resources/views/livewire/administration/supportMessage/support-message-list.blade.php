<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    
    <!-- En-tête -->
    <div class="mb-6">
        <h1 class="text-2xl font-black text-[#0B0A0B]">Messages de Support</h1>
        <p class="text-sm text-[#84796F] mt-1">Gestion et suivi des demandes d'assistance des utilisateurs.</p>
    </div>

    <!-- Espace de recherche et filtres -->
    <div class="flex flex-col sm:flex-row gap-4 mb-6">
        <div class="w-full sm:w-1/2">
            <x-search :options="$tabSearchPossibility" :listSearch="$listSearch" :search="$search" :searchWichColumn="$searchWichColumn" :showList="$showList" />
        </div>
        <div class="w-full sm:w-1/2">
            <x-search-asc-desc :options="$tabSearchAscDescPossibility"/>
        </div>
        <div>
            <x-search-category :options="$tabSearchCategoryPossibility"/>
        </div>
    </div>

    <!-- Tableau -->
    <div class="bg-white rounded-2xl shadow-sm border border-[#84796F]/20 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-left border-collapse">
                <thead class="bg-[#FAF1E3]/40 border-b border-[#84796F]/20">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-xs font-black text-[#41342D] uppercase tracking-wider">Date</th>
                        <th scope="col" class="px-6 py-4 text-xs font-black text-[#41342D] uppercase tracking-wider">Demande</th>
                        <th scope="col" class="px-6 py-4 text-xs font-black text-[#41342D] uppercase tracking-wider">Utilisateur</th>
                        <th scope="col" class="px-6 py-4 text-xs font-black text-[#41342D] uppercase tracking-wider">Catégorie</th>
                        <th scope="col" class="px-6 py-4 text-xs font-black text-[#41342D] uppercase tracking-wider">Précision</th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-black text-[#41342D] uppercase tracking-wider">État</th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-black text-[#41342D] uppercase tracking-wider">Actions</th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-black text-[#41342D] uppercase tracking-wider">Détails</th>
                    </tr>
                </thead>
                
                @forelse ($listSupportMessages as $supportMessage)
                <!-- Alpine.js gère l'accordéon au niveau du <tbody> -->
                <tbody x-data="{ expanded: false }" class="border-b border-[#84796F]/10 last:border-0 bg-white">
                    
                    <!-- LIGNE PRINCIPALE -->
                    <tr wire:key="msg-{{ $supportMessage->id }}" class="hover:bg-[#FAF1E3]/20 transition-colors">
                        
                        <!-- Date et Heure -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-bold text-[#0B0A0B]">{{ $supportMessage->created_at->format('d/m/Y') }}</div>
                            <div class="text-xs font-medium text-[#84796F]">{{ $supportMessage->created_at->format('H:i') }}</div>
                        </td>
                        
                        <!-- Demande (Titre et aperçu) -->
                        <td class="px-6 py-4 w-1/3">
                            <div class="text-sm font-bold text-[#0B0A0B] mb-0.5">{{ $supportMessage->title }}</div>
                            <div class="text-xs text-[#84796F] line-clamp-1" title="{{ $supportMessage->content }}">{{ $supportMessage->content }}</div>
                        </td>
                        
                        <!-- Utilisateur -->
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-[#0B0A0B]">
                            {{ $supportMessage->user ? $supportMessage->user->name . ' ' . $supportMessage->user->first_name : 'Utilisateur supprimé' }}
                        </td>
                        
                        <!-- Catégorie -->
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-[#5D0824]">
                            {{ $supportMessage->category?->label ?? 'Catégorie supprimée' }}
                        </td>
                        
                        <!-- Précision (Badge) -->
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            @if($supportMessage->addInfo)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#84796F]/10 text-[#41342D] border border-[#84796F]/20">
                                    {{ $supportMessage->addInfo->label }}
                                </span>
                            @else
                                <span class="text-[#84796F]/60 italic text-xs">Aucune</span>
                            @endif
                        </td>
                        
                        <!-- État -->
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            @if($supportMessage->state)
                                <span class="px-3 py-1 inline-flex text-xs font-bold rounded-full bg-green-50 text-green-700 border border-green-200">
                                    Fini
                                </span>
                            @else
                                <button wire:click="messageTreat({{ $supportMessage->id }})" 
                                        class="px-3 py-1 inline-flex text-xs font-bold rounded-full bg-[#5D0824]/10 text-[#5D0824] border border-[#5D0824]/20 hover:bg-[#5D0824] hover:text-[#FAF1E3] transition-colors focus:outline-none">
                                    En attente
                                </button>
                            @endif
                        </td>
                        
                        <!-- Actions (Supprimer) -->
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                            @if($supportMessage->state)
                            <button wire:click="delete({{ $supportMessage->id }})" 
                                    wire:confirm="Êtes-vous sûr de vouloir supprimer définitivement ce message ?" 
                                    class="text-[#84796F] hover:text-red-600 transition-colors inline-flex items-center justify-center" title="Supprimer">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                            @endif
                        </td>

                        <!-- Détails (Chevron Alpine.js) -->
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <button @click="expanded = !expanded" 
                                    class="text-[#84796F] hover:text-[#0B0A0B] focus:outline-none transition-transform duration-200 p-1 rounded-full hover:bg-[#84796F]/10" 
                                    :class="{'rotate-180': expanded}" title="Voir les détails">
                                <svg class="w-5 h-5 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                        </td>
                    </tr>

                    <!-- LIGNE DÉROULANTE (Accordéon) -->
                    <tr x-cloak x-show="expanded" x-transition.opacity class="bg-[#FAF1E3]/20 border-t border-[#84796F]/5">
                        <td colspan="8" class="px-6 py-6">
                            <div class="p-5 border border-[#84796F]/20 rounded-xl bg-white shadow-sm">
                                <div class="flex items-center justify-between mb-3 border-b border-[#84796F]/10 pb-3">
                                    <h4 class="font-black text-lg text-[#0B0A0B]">Détail de la demande</h4>
                                </div>
                                <p class="whitespace-pre-line leading-relaxed text-sm text-[#41342D]">
                                    {!! nl2br(e($supportMessage->content)) !!}
                                </p>
                            </div>
                        </td>
                    </tr>
                    
                </tbody>
                @empty
                    <tbody>
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center text-[#84796F] italic bg-white">
                                Aucun message de support à afficher.
                            </td>
                        </tr>
                    </tbody>
                @endforelse
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if (method_exists($listSupportMessages, 'hasPages') && $listSupportMessages->hasPages())
        <div class="mt-6">
            {{ $listSupportMessages->links() }}
        </div>
    @endif
    
</div>