<div class="max-w-2xl mx-auto px-4 py-12">
    
    <div class="bg-white rounded-2xl shadow-sm border border-[#84796F]/20 p-6 sm:p-8">
        
        <h2 class="text-2xl font-extrabold text-[#0B0A0B] mb-6 border-b border-[#84796F]/10 pb-4">
            {{ isset($category) ? 'Modifier la catégorie' : 'Nouvelle catégorie' }}
        </h2>

        <form wire:submit="saveForm" class="space-y-6">
            
            <!-- Champ : Nom -->
            <div>
                <label class="block text-sm font-bold text-[#41342D] mb-1">Nom de la catégorie</label>
                <input type="text" 
                       wire:model="label" 
                       class="w-full rounded-lg border-[#84796F]/30 shadow-sm focus:border-[#5D0824] focus:ring focus:ring-[#5D0824]/20 transition-colors"
                       placeholder="Ex: Informations générales">
                @error('label') <span class="text-xs text-red-600 font-bold mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Champ : Type (Menu déroulant basé sur l'Enum) -->
            <div>
                <label class="block text-sm font-bold text-[#41342D] mb-1">Type de catégorie</label>
                <select wire:model="type" 
                        class="w-full rounded-lg border-[#84796F]/30 shadow-sm focus:border-[#5D0824] focus:ring focus:ring-[#5D0824]/20 transition-colors">
                    <option value="">Sélectionnez un type...</option>
                    @foreach($listTypeCategories as $category)
                        <option value="{{ $category->value}}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('type') <span class="text-xs text-red-600 font-bold mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Boutons d'action -->
            <div class="flex items-center justify-end gap-4 pt-4 border-t border-[#84796F]/10">
                <a href="{{ route('admin.categoryList') }}" 
                   class="text-sm font-bold text-[#84796F] hover:text-[#0B0A0B] transition-colors">
                    Annuler
                </a>
                <button type="submit" 
                        class="px-6 py-2.5 bg-[#5D0824] text-[#FAF1E3] font-bold rounded-lg shadow-md hover:bg-[#48041B] transition-colors focus:ring-2 focus:ring-offset-2 focus:ring-[#5D0824]">
                    Confirmer
                </button>
            </div>

        </form>
    </div>
</div>