<div class="max-w-4xl mx-auto p-8 bg-white rounded-xl shadow-lg mt-8">
    
    <!-- En-tête de la page -->
    <div class="mb-8 border-b pb-4">
        <h1 class="text-2xl font-bold text-gray-800">
            {{ $isEditing ? "Modifier l'événement" : "Créer un nouvel événement" }}
        </h1>
        <p class="text-sm text-gray-500 mt-1">Remplissez les informations ci-dessous pour configurer votre événement et son lieu.</p>
    </div>

    <form wire:submit="saveForm" class="space-y-10">
        
        <!-- ========================================== -->
        <!-- SECTION 1 : ÉVÉNEMENT                      -->
        <!-- ========================================== -->
        <section>
            <h2 class="text-lg font-semibold text-indigo-700 bg-indigo-50 px-4 py-2 rounded-md mb-6">
                Informations de l'événement
            </h2>
            
            <div class="grid grid-cols-1 gap-6">
                
                <!-- Titre -->
                <div>
                    <label for="label" class="block text-sm font-medium text-gray-700 mb-1">Titre de l'événement *</label>
                    <input type="text" id="label" wire:model="label" placeholder="Ex: Concert d'été..."
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    @error('label') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <!-- J'ai mis un textarea, c'est beaucoup mieux pour une description ! -->
                    <textarea id="description" wire:model="description" rows="3" placeholder="Détails de l'événement..."
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
                    @error('description') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Dates (Affichées côte à côte sur grand écran) -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Date et heure de début *</label>
                        <!-- Correction ici : datetime-local -->
                        <input type="datetime-local" id="start_date" wire:model="start_date" 
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('start_date') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">Date et heure de fin *</label>
                        <input type="datetime-local" id="end_date" wire:model="end_date" 
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('end_date') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>
                <h3>Image principale</h3>
                <input wire:model='primary_image' type="file">
            </div>
        </section>

        <!-- ========================================== -->
        <!-- SECTION 2 : ADRESSE                        -->
        <!-- ========================================== -->
        <section>
            <h2 class="text-lg font-semibold text-indigo-700 bg-indigo-50 px-4 py-2 rounded-md mb-6">
                Lieu de l'événement
            </h2>
            
            <div class="grid grid-cols-1 gap-6">
                
                <!-- Rue -->
                <div>
                    <label for="street" class="block text-sm font-medium text-gray-700 mb-1">Adresse (Rue et numéro)</label>
                    <input type="text" id="street" wire:model="street" placeholder="Ex: 12 Rue de la Paix"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    @error('street') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Code Postal et Ville (Côte à côte) -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="md:col-span-1">
                        <label for="postal_code" class="block text-sm font-medium text-gray-700 mb-1">Code postal *</label>
                        <input type="text" id="postal_code" wire:model="postal_code" placeholder="Ex: 75000"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('postal_code') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="city" class="block text-sm font-medium text-gray-700 mb-1">Ville *</label>
                        <input type="text" id="city" wire:model="city" placeholder="Ex: Paris"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('city') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>

            </div>
        </section>

        <!-- ========================================== -->
        <!-- BOUTONS D'ACTION                           -->
        <!-- ========================================== -->
        <div class="flex justify-end items-center pt-6 border-t border-gray-200 space-x-4">
            <a href="{{ route('admin.eventListAdmin') }}" class="px-6 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none transition-colors">
                Annuler
            </a>
            
            <button type="submit" class="inline-flex justify-center px-6 py-2 border border-transparent rounded-md shadow-sm text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                <!-- Un petit effet de chargement lors de la sauvegarde -->
                <span wire:loading.remove wire:target="saveForm">Confirmer</span>
                <span wire:loading wire:target="saveForm">Sauvegarde...</span>
            </button>
        </div>

    </form>
</div>