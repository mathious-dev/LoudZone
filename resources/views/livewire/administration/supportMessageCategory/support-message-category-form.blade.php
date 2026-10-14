<div class="max-w-2xl mx-auto p-8 bg-white rounded-xl shadow-lg mt-8">
    
    <!-- En-tête de la page -->
    <div class="mb-8 border-b border-gray-100 pb-5">
        <h1 class="text-2xl font-bold text-gray-800">
            Catégorie de message support
        </h1>
        <p class="text-sm text-gray-500 mt-2">Définissez le nom de la catégorie et les informations requises pour classer les requêtes de vos clients.</p>
    </div>

    <!-- Formulaire -->
    <form wire:submit="saveForm" class="space-y-8">
        
        <!-- Section 1 : Informations de base -->
        <div>
            <label for="label" class="block text-sm font-medium text-gray-700 mb-2">
                Nom de la catégorie <span class="text-red-500">*</span>
            </label>
            <input type="text" id="label" wire:model="label" placeholder="Ex: Problème de livraison..."
                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-2 transition-colors">
            @error('label') <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
        </div>

        <!-- Section 2 : Checkboxes (Dans un encart gris clair pour bien séparer visuellement) -->
        <div class="bg-gray-50 p-5 rounded-lg border border-gray-200">
            <div class="mb-4">
                <h3 class="text-sm font-bold text-gray-800">Informations supplémentaires</h3>
                <p class="text-xs text-gray-500 mt-1">Cochez les informations que le client devra obligatoirement fournir pour cette catégorie.</p>
            </div>

            <!-- Grille sur 1 colonne sur mobile, 2 colonnes sur PC -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @foreach ($listAddInfos as $addInfoId => $addInfolabel)
                    <!-- On englobe l'input dans le label : toute la ligne devient cliquable ! -->
                    <label class="relative flex items-start cursor-pointer group p-2 hover:bg-white rounded-md transition-colors">
                        <div class="flex items-center h-5">
                            <input type="checkbox" wire:model="listAddInfosChoice" value="{{ $addInfoId }}"
                                class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500 cursor-pointer">
                        </div>
                        <div class="ml-3 text-sm">
                            <span class="font-medium text-gray-700 group-hover:text-indigo-600 transition-colors">{{ $addInfolabel }}</span>
                        </div>
                    </label>
                @endforeach
            </div>
        </div>

        <!-- Boutons d'action -->
        <div class="flex justify-end items-center pt-6 border-t border-gray-100">
            <button type="submit" class="inline-flex justify-center items-center px-6 py-2.5 border border-transparent rounded-md shadow-sm text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                
                <!-- État normal -->
                <span wire:loading.remove wire:target="saveForm">Confirmer</span>
                
                <!-- État de chargement (avec petit spinner SVG) -->
                <span wire:loading wire:target="saveForm" class="flex items-center">
                    <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Sauvegarde...
                </span>
                
            </button>
        </div>

    </form>
</div>