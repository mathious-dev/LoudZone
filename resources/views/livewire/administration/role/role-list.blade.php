<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    
    <!-- En-tête avec le titre et le bouton d'ajout -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <div>
            <h1 class="text-2xl font-black text-[#0B0A0B]">Gestion des Rôles</h1>
            <p class="text-sm text-[#84796F] mt-1">Liste et configuration des rôles utilisateurs.</p>
        </div>
        
        <a href="{{ route('admin.roleForm.create') }}" 
           class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#5D0824] text-[#FAF1E3] text-sm font-bold rounded-lg hover:bg-[#0B0A0B] transition-colors shadow-md">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Ajouter un rôle
        </a>
    </div>

    <!-- Composant de recherche réutilisable -->
    <div class="mb-6">
        <x-search :options="$tabSearchPossibility" :listSearch="$listSearch" :searchWichColumn="$searchWichColumn" :search="$search" :showList="$showList"/>
    </div>

    <!-- Conteneur du tableau -->
    <div class="bg-white rounded-2xl shadow-sm border border-[#84796F]/20 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-[#84796F]/20">
                <thead class="bg-[#FAF1E3]/40">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-black text-[#41342D] uppercase tracking-wider">
                            Rôle
                        </th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-black text-[#41342D] uppercase tracking-wider">
                            Membres assignés
                        </th>
                        <th scope="col" class="px-6 py-4 text-right text-xs font-black text-[#41342D] uppercase tracking-wider w-32">
                            Actions
                        </th>
                    </tr>
                </thead>
                
                <tbody class="divide-y divide-[#84796F]/10 bg-white">
                    @forelse ($listRoles as $role)
                        <tr class="hover:bg-[#FAF1E3]/20 transition-colors">
                            
                            <!-- Nom du Rôle -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-[#0B0A0B]">
                                {{ $role->name }}
                            </td>
                            
                            <!-- Badge Utilisateurs -->
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm">
                                <a href="{{ route('admin.userList', ['roleId' => $role->id]) }}" class="group">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-[#5D0824]/10 text-[#5D0824] border border-[#5D0824]/20 group-hover:bg-[#5D0824] group-hover:text-[#FAF1E3] transition-colors">
                                        {{ $role->users->count() }} utilisateurs
                                    </span>
                                </a>
                            </td>
                            
                            <!-- Actions (Boutons standardisés) -->
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end gap-3">
                                    
                                    <!-- Bouton Modifier -->
                                    <a href="{{ route('admin.roleForm.edit', $role) }}" 
                                       class="text-[#84796F] hover:text-[#0B0A0B] transition-colors" title="Modifier">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                        </svg>
                                    </a>
                                    
                                    <!-- Bouton Supprimer / État Protégé -->
                                    @if(strtolower($role->name) !== 'admin' && strtolower($role->name) !== 'user')
                                        <button wire:click="delete({{ $role->id }})" 
                                                wire:confirm="Êtes-vous sûr de vouloir supprimer ce rôle ?" 
                                                class="text-[#84796F] hover:text-red-600 transition-colors" title="Supprimer">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    @else
                                        <!-- Icône Cadenas pour les rôles protégés -->
                                        <span class="text-[#84796F]/50 flex items-center justify-center" title="Rôle système protégé">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                            </svg>
                                        </span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-12 text-center text-[#84796F] italic">
                                Aucun rôle n'a été trouvé.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Pagination -->
    @if (method_exists($listRoles, 'hasPages') && $listRoles->hasPages())
        <div class="mt-6">
            {{ $listRoles->links() }}
        </div>
    @endif
</div>