<!-- Conteneur centré -->
<div class="min-h-[80vh] flex flex-col justify-center items-center px-4 sm:px-6 lg:px-8 bg-gray-50">
    
    <!-- La carte (cadre blanc) -->
    <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-lg border border-gray-100">
        
        <!-- En-tête -->
        <div class="mb-6 text-center">
            <h2 class="text-2xl font-bold text-gray-900">
                @if ($isEditing)
                    Modification de l'information
                @else
                    Nouvelle information
                @endif
            </h2>
            <p class="text-sm text-gray-500 mt-1">Saisissez le nom de l'information supplémentaire</p>
        </div>

        <!-- Le formulaire -->
        <form wire:submit.prevent="saveForm" class="space-y-5">
            
            <!-- Champ Label -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nom de l'information</label>
                <input type="text" wire:model="label" placeholder="Ex: Site, Bug, Commande..."
                    class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 text-sm focus:outline-none focus:ring-2 focus:ring-[rgb(72,6,28)] focus:border-[rgb(72,6,28)]">
                
                <!-- Gestion des erreurs -->
                @error('label') 
                    <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span> 
                @enderror
            </div>
            
            <!-- Bouton -->
            <div class="pt-2">
                <button type="submit" 
                    class="w-full bg-[rgb(72,6,28)] text-white font-bold py-3 px-4 rounded-md shadow hover:bg-opacity-90 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[rgb(72,6,28)]">
                    Confirmer
                </button>
            </div>
            
        </form>
        
    </div>
</div>