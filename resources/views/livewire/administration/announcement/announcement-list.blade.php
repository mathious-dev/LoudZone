<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    
    <!-- En-tête avec le Titre et le Bouton d'ajout -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Gestion des Annonces</h2>
        <a href="{{ route('admin.announcementForm.create') }}" 
           class="inline-flex items-center px-4 py-2 bg-[#48041B] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#300211] shadow-sm transition-all">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Ajouter une annonce
        </a>
    </div>

    <!-- Le Tableau de bord -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Titre</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Contenu</th>
                        <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Statut</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Début</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Fin</th>
                        <th scope="col" class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($listAnnouncements as $announcement)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $announcement->label }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600 max-w-xs truncate">
                                {{ $announcement->content }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm">
                                <!-- Badge stylisé pour le statut de publication -->
                                @if($announcement->is_showing)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                                        Publié
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 border border-gray-200">
                                        Masqué
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $announcement->start_date }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $announcement->end_date }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end gap-3">
                                    <!-- Bouton Modifier -->
                                    <a href="{{ route('admin.announcementForm.edit', $announcement) }}" class="text-indigo-600 hover:text-indigo-900 transition-colors">
                                        Modifier
                                    </a>
                                    <!-- Bouton Supprimer -->
                                    <button wire:click="delete({{ $announcement->id }})" wire:confirm="Êtes-vous sûr de vouloir supprimer cette annonce ?" class="text-red-600 hover:text-red-900 transition-colors">
                                        Supprimer
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div>
            {{ $listAnnouncements->links() }}
        </div>
        <!-- Message si aucune annonce -->
        @if($listAnnouncements->isEmpty())
            <div class="px-6 py-10 text-center text-gray-500">
                Aucune annonce trouvée. Créez votre première annonce !
            </div>
        @endif
    </div>
</div>