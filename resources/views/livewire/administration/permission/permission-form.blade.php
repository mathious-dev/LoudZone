<div class="max-w-2xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow-sm border border-[#84796F]/20 rounded-2xl p-6 sm:p-8">
        
        <!-- En-tête du formulaire -->
        <div class="mb-6 border-b border-[#84796F]/20 pb-4">
            <h2 class="text-2xl font-black text-[#0B0A0B]">
                {{ $isEditing ? 'Modifier la permission' : 'Nouvelle permission' }}
            </h2>
            <p class="text-sm text-[#84796F] mt-1">
                Définissez un nom clair pour cette permission (ex: editer_articles).
            </p>
        </div>

        <form wire:submit='saveForm' class="space-y-6"> 
            
            <!-- Champ Nom -->
            <div>
                <label for="name" class="block text-sm font-bold text-[#41342D] mb-1">
                    Nom de la permission <span class="text-[#5D0824]">*</span>
                </label>
                <input type="text" 
                       id="name"
                       wire:model='name' 
                       class="w-full rounded-lg border border-[#84796F]/30 bg-white px-4 py-2.5 text-[#0B0A0B] focus:border-[#5D0824] focus:ring focus:ring-[#5D0824]/20 transition-all shadow-sm"
                       placeholder="ex: gerer_promotions">
                
                @error('name') 
                    <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> 
                @enderror
            </div>

            <!-- Boutons d'action -->
            <div class="flex items-center justify-end gap-4 pt-4">
                <a href="{{ route('admin.permissionList') }}" 
                   class="px-4 py-2 text-sm font-medium text-[#84796F] hover:text-[#0B0A0B] transition-colors">
                    Annuler
                </a>
                <button type="submit" 
                        class="px-6 py-2.5 bg-[#5D0824] text-[#FAF1E3] text-sm font-bold rounded-lg hover:bg-[#0B0A0B] transition-colors shadow-md">
                    {{ $isEditing ? 'Mettre à jour' : 'Créer la permission' }}
                </button>
            </div>
            
        </form>
    </div>
</div>