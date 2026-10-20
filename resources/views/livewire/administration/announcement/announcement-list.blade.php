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
    <div class="bg-white rounded-xl shadow-md overflow-visible border border-gray-200">
        <!-- Attention : j'ai retiré overflow-hidden du parent pour que le menu déroulant puisse sortir du tableau -->
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
                                @if($announcement->start_date)
                                    {{ \Carbon\Carbon::parse($announcement->start_date)->format('d/m/Y à H:i') }}
                                @elseif($announcement->is_showing)
                                    <!-- Le message d'erreur en rouge si c'est publié mais vide -->
                                    <span class="text-red-500 font-bold">Problème : Date requise</span>
                                @else
                                    Non définie
                                @endif
                            </td>

                            <!-- Date de fin -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                @if($announcement->end_date)
                                    {{ \Carbon\Carbon::parse($announcement->end_date)->format('d/m/Y à H:i') }}
                                @else
                                    Non définie
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end items-center gap-4">
                                    <!-- Bouton Modifier -->
                                    <a href="{{ route('admin.announcementForm.edit', $announcement) }}" class="text-indigo-600 hover:text-indigo-900 transition-colors">
                                        Modifier
                                    </a>
                                    
                                    <!-- Bouton Supprimer -->
                                    <button wire:click="delete({{ $announcement->id }})" wire:confirm="Êtes-vous sûr de vouloir supprimer cette annonce ?" class="text-red-600 hover:text-red-900 transition-colors">
                                        Supprimer
                                    </button>

                                    <!-- ========================================== -->
                                    <!-- MENU PUBLIER (S'OUVRE SUR LE CÔTÉ GAUCHE)  -->
                                    <!-- ========================================== -->
                                    <div x-data="{ open: false }" class="relative flex items-center">
                                        
                                        <button @click="open = !open" class="text-green-600 hover:text-green-800 font-bold transition-colors">
                                            Publier
                                        </button>
                                        
                                        <!-- Le Popover positionné à gauche (right-[110%]) et centré verticalement (top-1/2 -translate-y-1/2) -->
                                        <div x-show="open" 
                                            x-transition:enter="transition ease-out duration-200"
                                            x-transition:enter-start="opacity-0 translate-x-4"
                                            x-transition:enter-end="opacity-100 translate-x-0"
                                            x-transition:leave="transition ease-in duration-150"
                                            x-transition:leave-start="opacity-100 translate-x-0"
                                            x-transition:leave-end="opacity-0 translate-x-4"
                                            @click.away="open = false"
                                            class="absolute right-[120%] top-1/2 -translate-y-1/2 w-72 p-5 bg-white border border-gray-200 rounded-xl shadow-2xl z-50 text-left"
                                            style="display: none;">
                                            
                                            <!-- Petite flèche décorative qui pointe vers le bouton -->
                                            <div class="absolute top-1/2 -right-2 -translate-y-1/2 w-4 h-4 bg-white border-t border-r border-gray-200 transform rotate-45 z-0"></div>

                                            <div class="relative z-10">
                                                <h4 class="font-bold text-gray-800 mb-4 text-sm border-b pb-2">Période de publication</h4>
                                                
                                                <div class="space-y-4">
                                                    <div>
                                                        <label class="block text-xs font-bold text-gray-700 mb-1">Date de début</label>
                                                        <input type="datetime-local" wire:model="start_date" 
                                                            class="block w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-[#48041B] focus:ring-[#48041B]">
                                                    </div>
                                                    
                                                    <div>
                                                        <label class="block text-xs font-bold text-gray-700 mb-1">Date de fin</label>
                                                        <input type="datetime-local" wire:model="end_date" 
                                                            class="block w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-[#48041B] focus:ring-[#48041B]">
                                                    </div>
                                                    
                                                    <div class="pt-2">
                                                        <button wire:click="publishing({{ $announcement }})" @click="open = false"
                                                                class="w-full flex justify-center items-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-bold text-white bg-[#48041B] hover:bg-[#300211] focus:ring-2 focus:ring-offset-2 focus:ring-[#48041B] transition-all">
                                                            Confirmer
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
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