<div class="relative max-w-2xl mx-auto px-4 py-12">
    
    <!-- Bouton de retour -->
    <div class="absolute top-12 left-4 sm:-left-4 md:-left-12">
        <x-return-button-form route="admin.priceFilterList"/>
    </div>
    
    <div class="bg-white rounded-2xl shadow-sm border border-[#84796F]/20 p-6 sm:p-8">
        
        <h2 class="text-2xl font-extrabold text-[#0B0A0B] mb-6 border-b border-[#84796F]/10 pb-4">
            {{ isset($priceFilter) ? 'Modifier le filtre de prix' : 'Nouveau filtre de prix' }}
        </h2>

        <form wire:submit.prevent="saveForm" class="space-y-6">
            
            <!-- Nom du filtre -->
            <div>
                <label class="block text-sm font-bold text-[#41342D] mb-1">Nom du filtre <span class="text-red-500">*</span></label>
                <input type="text" 
                       wire:model="label" 
                       class="w-full rounded-lg border-[#84796F]/30 shadow-sm focus:border-[#5D0824] focus:ring focus:ring-[#5D0824]/20 transition-colors"
                       placeholder="Ex: Moins de 25 €">
                @error('label') <span class="text-xs text-red-600 font-bold mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Grille pour les Prix Min et Max -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-gray-50 p-5 rounded-xl border border-gray-100">
                
                <!-- Prix Minimum -->
                <div>
                    <label class="block text-sm font-bold text-[#41342D] mb-1">Prix minimum <span class="text-gray-400 font-normal">(Optionnel)</span></label>
                    <div class="relative">
                        <input type="number" step="0.01"
                               wire:model="min_price" 
                               class="w-full rounded-lg border-[#84796F]/30 shadow-sm focus:border-[#5D0824] focus:ring focus:ring-[#5D0824]/20 pr-8 transition-colors"
                               placeholder="Ex: 25">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 font-bold">€</span>
                        </div>
                    </div>
                    @error('min_price') <span class="text-xs text-red-600 font-bold mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Prix Maximum -->
                <div>
                    <label class="block text-sm font-bold text-[#41342D] mb-1">Prix maximum <span class="text-gray-400 font-normal">(Optionnel)</span></label>
                    <div class="relative">
                        <input type="number" step="0.01"
                               wire:model="max_price" 
                               class="w-full rounded-lg border-[#84796F]/30 shadow-sm focus:border-[#5D0824] focus:ring focus:ring-[#5D0824]/20 pr-8 transition-colors"
                               placeholder="Ex: 50">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 font-bold">€</span>
                        </div>
                    </div>
                    @error('max_price') <span class="text-xs text-red-600 font-bold mt-1 block">{{ $message }}</span> @enderror
                </div>
                
            </div>

            <!-- Statut (Publié) -->
            <div class="flex items-center p-4 bg-white border border-[#84796F]/20 rounded-lg shadow-sm">
                <input type="checkbox" id="is_active" wire:model="is_active" 
                       class="h-5 w-5 text-[#5D0824] focus:ring-[#5D0824] border-gray-300 rounded cursor-pointer transition-colors">
                <div class="ml-3">
                    <label for="is_active" class="text-sm font-bold text-gray-800 cursor-pointer">Filtre actif (Publié)</label>
                    <p class="text-xs text-gray-500">S'il est décoché, ce filtre n'apparaîtra pas sur le catalogue client.</p>
                </div>
                @error('is_active') <span class="ml-2 text-xs text-red-600 font-bold">{{ $message }}</span> @enderror
            </div>

            <!-- Boutons d'action -->
            <div class="flex items-center justify-end gap-4 pt-4 border-t border-[#84796F]/10">
                <a href="{{ route('admin.priceFilterList' /* Adapte cette route si besoin */) }}" 
                   class="text-sm font-bold text-[#84796F] hover:text-[#0B0A0B] transition-colors">
                    Annuler
                </a>
                <button type="submit" 
                        class="px-6 py-2.5 bg-[#5D0824] text-[#FAF1E3] font-bold rounded-lg shadow-md hover:bg-[#48041B] transition-colors focus:ring-2 focus:ring-offset-2 focus:ring-[#5D0824]">
                    Confirmer l'enregistrement
                </button>
            </div>

        </form>
    </div>
</div>