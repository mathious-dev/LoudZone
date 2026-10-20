<div class="max-w-3xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border-t-4 border-[#48041B]">
        
        <!-- En-tête du formulaire -->
        <div class="px-8 py-6 border-b border-gray-100 bg-gray-50">
            <h2 class="text-xl font-bold text-gray-800">
                Créer / Modifier une annonce
            </h2>
            <p class="text-sm text-gray-500 mt-1">Remplissez les détails de votre annonce ci-dessous.</p>
        </div>

        <form wire:submit="saveForm" class="p-8 space-y-6">
            
            <!-- Titre -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Titre de l'annonce</label>
                <input type="text" wire:model="label" 
                       class="block w-full rounded-md border-gray-300 shadow-sm focus:border-[#48041B] focus:ring focus:ring-[#48041B] focus:ring-opacity-20 transition-colors" 
                       placeholder="Ex: Super Promotion d'hiver">
                @error('label') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Contenu (Remplacé par un textarea) -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Contenu</label>
                <textarea wire:model="content" rows="4" 
                          class="block w-full rounded-md border-gray-300 shadow-sm focus:border-[#48041B] focus:ring focus:ring-[#48041B] focus:ring-opacity-20 transition-colors" 
                          placeholder="Écrivez le message de votre annonce ici..."></textarea>
                @error('content') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Ligne des dates -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Date de début -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Date de début</label>
                    <input type="datetime-local" wire:model="start_date" 
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-[#48041B] focus:ring focus:ring-[#48041B] focus:ring-opacity-20 transition-colors">
                    @error('start_date') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Date de fin -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Date de fin</label>
                    <input type="datetime-local" wire:model="end_date" 
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-[#48041B] focus:ring focus:ring-[#48041B] focus:ring-opacity-20 transition-colors">
                    @error('end_date') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Switch Publié (Checkbox stylisée) -->
            <div class="flex items-center bg-gray-50 p-4 rounded-lg border border-gray-200 mt-4">
                <input type="checkbox" id="is_showing" wire:model="is_showing" 
                       class="h-5 w-5 text-[#48041B] focus:ring-[#48041B] border-gray-300 rounded cursor-pointer transition-colors">
                <div class="ml-3">
                    <label for="is_showing" class="text-sm font-bold text-gray-800 cursor-pointer">Publier immédiatement</label>
                    <p class="text-xs text-gray-500">Si décoché, l'annonce sera sauvegardée comme brouillon.</p>
                </div>
            </div>

            <!-- Actions du formulaire -->
            <div class="pt-6 mt-6 border-t border-gray-100 flex items-center justify-end gap-4">
                <a href="{{ route('admin.announcementForm.create') }}" class="text-sm text-gray-600 hover:text-gray-900 transition-colors font-medium">
                    Annuler
                </a>
                <button type="submit" 
                        class="inline-flex justify-center px-6 py-3 border border-transparent text-sm font-bold rounded-md text-white bg-[#48041B] hover:bg-[#300211] shadow-lg hover:shadow-xl transition-all hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#48041B]">
                    Enregistrer l'annonce
                </button>
            </div>
            
        </form>
    </div>
</div>