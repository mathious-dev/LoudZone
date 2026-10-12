<div class="max-w-2xl mx-auto p-8 bg-white rounded-xl shadow-lg mt-8">
    
    <!-- En-tête de la page -->
    <div class="mb-8 border-b pb-4">
        <h1 class="text-2xl font-bold text-gray-800">
            Catégorie de message support
        </h1>
        <p class="text-sm text-gray-500 mt-1">Définissez le nom de la catégorie pour classer les requêtes de vos clients.</p>
    </div>

    <!-- Formulaire -->
    <form wire:submit="saveForm" class="space-y-6">
        
        <div>
            <label for="label" class="block text-sm font-medium text-gray-700 mb-1">Nom de la catégorie *</label>
            <input type="text" id="label" wire:model="label" placeholder="Ex: Problème de livraison..."
                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            <!-- Ajout de l'affichage de l'erreur au cas où la validation échoue -->
            @error('label') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
        </div>

        <!-- Boutons d'action -->
        <div class="flex justify-end items-center pt-6 border-t border-gray-200">
            <button type="submit" class="inline-flex justify-center px-6 py-2 border border-transparent rounded-md shadow-sm text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                <span wire:loading.remove wire:target="saveForm">Confirmer</span>
                <span wire:loading wire:target="saveForm">Sauvegarde...</span>
            </button>
        </div>

    </form>
</div>