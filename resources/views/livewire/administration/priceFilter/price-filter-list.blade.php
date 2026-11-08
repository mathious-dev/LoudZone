<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <!-- En-tête : Titre et Bouton Ajouter -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-[#0B0A0B]">Gestion des filtres de prix</h1>
            <p class="text-sm text-gray-500 mt-1">Créez des tranches de prix pour faciliter la recherche de vos clients.</p>
        </div>
        
        <a href="{{ route('admin.priceFilterForm.create') }}" 
           class="inline-flex items-center px-4 py-2 bg-[#5D0824] text-[#FAF1E3] font-bold rounded-lg shadow-sm hover:bg-[#48041B] transition-colors whitespace-nowrap">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Ajouter un filtre
        </a>
    </div>

    <!-- Barre d'outils (Recherche & Tris) -->
    <div class="flex flex-col lg:flex-row gap-4 mb-6 bg-white p-4 rounded-xl shadow-sm border border-[#84796F]/20">
        <!-- Barre de recherche -->
        <div class="w-full lg:flex-1">
            <x-search :options="$tabSearchPossibility" :listSearch="$listSearch" :search="$search" :searchWichColumn="$searchWichColumn" :showList="$showList" />
        </div>
        
        <!-- Sélecteur de tri (ASC/DESC) -->
        <div class="w-full lg:w-56 shrink-0">
            <x-search-asc-desc :options="$tabSearchAscDescPossibility"/>
        </div>
    </div>

    <!-- Le Tableau -->
    <div class="bg-white rounded-xl shadow-sm border border-[#84796F]/20 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-[#FAF1E3]/30 border-b border-[#84796F]/20">
                        <th class="px-6 py-4 text-xs font-black text-[#0B0A0B] uppercase tracking-wider">Nom du filtre</th>
                        <th class="px-6 py-4 text-xs font-black text-[#0B0A0B] uppercase tracking-wider">Prix min</th>
                        <th class="px-6 py-4 text-xs font-black text-[#0B0A0B] uppercase tracking-wider">Prix max</th>
                        <th class="px-6 py-4 text-xs font-black text-[#0B0A0B] uppercase tracking-wider">Statut</th>
                        <th class="px-6 py-4 text-xs font-black text-[#0B0A0B] uppercase tracking-wider text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#84796F]/10">
                    @forelse ($listPriceFilters as $priceFilter)
                        <tr class="hover:bg-[#FAF1E3]/10 transition-colors">
                            
                            <td class="px-6 py-4 text-sm font-bold text-[#0B0A0B]">
                                {{ $priceFilter->label }}
                            </td>
                            
                            <td class="px-6 py-4 text-sm font-semibold">
                                @if($priceFilter->min_price)
                                    {{ $priceFilter->min_price }} €
                                @else
                                    <span class="text-gray-400 text-xs italic font-normal">Pas de limite</span>
                                @endif
                            </td>
                            
                            <td class="px-6 py-4 text-sm font-semibold">
                                @if($priceFilter->max_price)
                                    {{ $priceFilter->max_price }} €
                                @else
                                    <span class="text-gray-400 text-xs italic font-normal">Pas de limite</span>
                                @endif
                            </td>
                            
                            <td class="px-6 py-4">
                                @if($priceFilter->is_active)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-green-100 text-green-800 border border-green-200">
                                        Publié
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-gray-100 text-gray-600 border border-gray-200">
                                        Non publié
                                    </span>
                                @endif
                            </td>
                            
                            <!-- Actions avec les Icônes Crayon et Poubelle -->
                            <td class="px-6 py-4 text-right"> 
                                <div class="flex items-center justify-end space-x-3">
                                    <a href="{{ route('admin.priceFilterForm.edit', $priceFilter) }}" 
                                       title="Modifier"
                                       class="p-2 text-gray-500 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500/50">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>

                                    <button wire:click="delete({{ $priceFilter->id }})" 
                                            title="Supprimer"
                                            class="p-2 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-red-500/50"
                                            onclick="confirm('Êtes-vous sûr de vouloir supprimer ce filtre ?') || event.stopImmediatePropagation()">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-500 text-sm italic">
                                Aucun filtre de prix ne correspond à votre recherche.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $listPriceFilters->links() }}
    </div>

</div>