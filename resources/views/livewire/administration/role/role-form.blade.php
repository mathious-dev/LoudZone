<div class="min-h-[80vh] flex flex-col justify-center items-center px-4 sm:px-6 lg:px-8 bg-gray-50 py-10">
    <div class="w-full max-w-2xl bg-white p-8 rounded-xl shadow-lg border border-gray-100">
        
        <!-- En-tête -->
        <div class="mb-8 text-center border-b border-gray-100 pb-5">
            <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900">Gestion du rôle</h2>
            <p class="text-sm text-gray-500 mt-2">Définissez le nom et les accès accordés à ce rôle</p>
        </div>

        <form wire:submit.prevent="saveForm" class="space-y-8">
            
            <!-- Nom du rôle -->
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Nom du rôle <span class="text-red-500">*</span></label>
                <input type="text" wire:model="name" placeholder="Ex: Administrateur, Éditeur..."
                    class="w-full border border-gray-300 rounded-lg shadow-sm py-2.5 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-[rgb(72,6,28)] focus:border-[rgb(72,6,28)] transition-colors">
                @error('name') <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
            </div>

            <!-- Liste des permissions -->
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Permissions accordées</label>
                
                <!-- Conteneur des permissions (Grille + Scroll) -->
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 max-h-72 overflow-y-auto shadow-inner">
                    
                    @if(count($listPermissions) > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            @foreach ($listPermissions as $id => $name)
                                <!-- Label englobe l'input pour rendre toute la ligne cliquable -->
                                <label class="flex items-center space-x-3 p-3 bg-white border border-gray-100 rounded-md cursor-pointer hover:border-[rgb(72,6,28)] hover:shadow-sm transition-all duration-200 group">
                                    
                                    <input type="checkbox" 
                                           wire:model="listPermissionsChoice" 
                                           value="{{ $id }}"
                                           class="w-5 h-5 text-[rgb(72,6,28)] border-gray-300 rounded focus:ring-[rgb(72,6,28)] focus:ring-2">
                                           
                                    <span class="text-sm text-gray-700 font-medium group-hover:text-[rgb(72,6,28)] transition-colors capitalize">
                                        {{ str_replace('_', ' ', $name) }}
                                    </span>
                                    
                                </label>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center text-sm text-gray-400 py-6 italic">
                            Aucune permission disponible dans le système.
                        </div>
                    @endif
                    
                </div>
            </div>

            <!-- Bouton de soumission -->
            <div class="pt-4">
                <button type="submit" 
                    class="w-full flex justify-center items-center bg-[rgb(72,6,28)] text-white font-bold py-3 px-4 rounded-lg shadow-md hover:bg-opacity-90 hover:shadow-lg transition-all focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[rgb(72,6,28)]">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                    </svg>
                    Enregistrer le rôle
                </button>
            </div>
            
        </form>
        
    </div>
</div>