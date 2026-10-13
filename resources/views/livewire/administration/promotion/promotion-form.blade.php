<div class="bg-white rounded-lg shadow-md p-6 max-w-2xl mx-auto my-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-3">Créer / Modifier une Promotion</h2>

    <!-- Le .prevent évite que la page ne se recharge entièrement lors de la soumission -->
    <form wire:submit.prevent="saveForm" class="space-y-6">
        
        <!-- Nom -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nom de la promotion <span class="text-gray-400 font-normal">(Optionnel)</span></label>
            <input type="text" wire:model="label" placeholder="Ex: Black Friday 2026" 
                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            @error('label') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
        </div>

        <!-- Montant -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Montant de la réduction</label>
            <div class="relative w-1/2">
                <!-- type="number" et step="0.01" pour autoriser les décimales -->
                <input type="number" step="0.01" wire:model="amount" placeholder="Ex: 20" 
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 pr-8">
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                    <span class="text-gray-500 font-bold">%</span>
                </div>
            </div>
            @error('amount') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Date de début -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Date et heure de début</label>
                <!-- type="datetime-local" permet de choisir l'heure -->
                <input type="datetime-local" wire:model="start_date" 
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('start_date') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Date de fin -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Date et heure de fin <span class="text-gray-400 font-normal">(Optionnel)</span></label>
                <input type="datetime-local" wire:model="end_date" 
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('end_date') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Bouton -->
        <div class="pt-4 flex justify-end">
            <button type="submit" 
                class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded-md shadow transition-colors duration-200">
                Enregistrer la promotion
            </button>
        </div>

    </form>
</div>