<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    
    <!-- En-tête de la page -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <div>
            <h1 class="text-2xl font-black text-[#0B0A0B]">Gestion des Permissions</h1>
            <p class="text-sm text-[#84796F] mt-1">Liste des droits d'accès disponibles sur l'application.</p>
        </div>
        
        <a href="{{ route('admin.permissionForm.create') }}" 
           class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#5D0824] text-[#FAF1E3] text-sm font-bold rounded-lg hover:bg-[#0B0A0B] transition-colors shadow-md">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Ajouter une permission
        </a>
    </div>

    <!-- Tableau -->
    <div class="bg-white rounded-2xl shadow-sm border border-[#84796F]/20 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-[#84796F]/20">
                <thead class="bg-[#FAF1E3]/40">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-black text-[#41342D] uppercase tracking-wider">
                            Nom de la permission
                        </th>
                        <th scope="col" class="px-6 py-4 text-right text-xs font-black text-[#41342D] uppercase tracking-wider w-32">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#84796F]/10 bg-white">
                    
                    @forelse ($listPermissions as $permission)
                        <tr class="hover:bg-[#FAF1E3]/20 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-[#84796F]/10 text-[#41342D] border border-[#84796F]/20">
                                    {{ $permission->name }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end gap-3">
                                    <!-- Bouton Modifier -->
                                    <a href="{{ route('admin.permissionForm.edit', $permission->id) }}" 
                                       class="text-[#84796F] hover:text-[#0B0A0B] transition-colors" title="Modifier">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </a>
                                    
                                    <!-- Bouton Supprimer -->
                                    <button wire:click='delete({{ $permission->id }})' 
                                            wire:confirm="Êtes-vous sûr de vouloir supprimer la permission '{{ $permission->name }}' ?"
                                            class="text-[#84796F] hover:text-red-600 transition-colors" title="Supprimer">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="px-6 py-12 text-center text-[#84796F] italic">
                                Aucune permission n'a été créée pour le moment.
                            </td>
                        </tr>
                    @endforelse
                    
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $listPermissions->links() }}
    </div>
</div>