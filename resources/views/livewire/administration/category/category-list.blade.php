<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <!-- En-tête : Titre et Bouton Ajouter -->
    <div class="flex flex-col sm:flex-row justify-between items-center mb-8 gap-4">
        <h1 class="text-2xl font-extrabold text-[#0B0A0B]">Gestion des Catégories</h1>
        
        <a href="{{ route('admin.categoryForm.create') }}" 
           class="inline-flex items-center px-4 py-2 bg-[#5D0824] text-[#FAF1E3] font-bold rounded-lg shadow-sm hover:bg-[#48041B] transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Ajouter une catégorie
        </a>
    </div>

    <!-- Zone de recherche et filtres -->
    <div class="flex flex-col md:flex-row gap-4 mb-6 bg-white p-4 rounded-xl shadow-sm border border-[#84796F]/20">
        <div class="flex-1">
            <x-search :options="$tabSearchPossibility" :listSearch="$listSearch" :search="$search" :searchWichColumn="$searchWichColumn" :showList="$showList" />
        </div>
        <div class="md:w-64">
            <x-search-asc-desc :options="$tabSearchAscDescPossibility"/>
        </div>
    </div>

    <!-- Le Tableau -->
    <div class="bg-white rounded-xl shadow-sm border border-[#84796F]/20 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-[#FAF1E3]/30 border-b border-[#84796F]/20">
                        <th class="px-6 py-4 text-xs font-black text-[#0B0A0B] uppercase tracking-wider">Nom</th>
                        <th class="px-6 py-4 text-xs font-black text-[#0B0A0B] uppercase tracking-wider">Type</th>
                        <th class="px-6 py-4 text-xs font-black text-[#0B0A0B] uppercase tracking-wider text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#84796F]/10">
                    @foreach ($listCategories as $category)
                    <tr class="hover:bg-[#FAF1E3]/10 transition-colors">
                        <td class="px-6 py-4 text-sm font-bold text-[#0B0A0B]">
                            {{ $category->label }}
                        </td>
                        <td class="px-6 py-4">
                            <!-- Petit badge pour le type -->
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-gray-100 text-gray-800 border border-gray-200">
                                {{ $category->type->name ?? $category->type }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right"> 
                            <div class="flex items-center justify-end space-x-3">
                                <!-- Bouton Modifier (Icône Crayon) -->
                                <a href="{{ route('admin.categoryForm.edit', $category) }}" 
                                title="Modifier"
                                class="p-2 text-gray-500 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500/50">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>

                                <!-- Bouton Supprimer (Icône Poubelle) -->
                                <button wire:click="delete({{ $category->id }})" 
                                        title="Supprimer"
                                        class="p-2 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-red-500/50"
                                        onclick="confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?') || event.stopImmediatePropagation()">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
        <div class="mt-6">
            {{ $listCategories->links() }}
        </div>


</div>