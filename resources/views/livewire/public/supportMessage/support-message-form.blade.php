<div class="relative min-h-[80vh] flex flex-col justify-center items-center px-4 sm:px-6 lg:px-8 bg-gray-50">
    
    <!-- Bouton de retour en absolu via ton $previousUrl (car pas de route nommée pour ça) -->
    <div class="absolute top-4 left-4 sm:top-8 sm:left-8 md:top-12 md:left-12">
        <a href="{{ $previousUrl ?? url('/') }}" title="Retour" class="group inline-flex items-center justify-center w-12 h-12 bg-white border border-[#84796F]/20 rounded-full shadow-sm text-[#41342D] hover:bg-[#5D0824] hover:text-[#FAF1E3] hover:border-[#5D0824] transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#5D0824]">
            <svg class="w-6 h-6 transform group-hover:-translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
        </a>
    </div>

    <!-- Le cadre du formulaire (La "carte") -->
    <div class="w-full max-w-lg bg-white p-8 rounded-xl shadow-lg border border-gray-100">
        
        <!-- En-tête du formulaire -->
        <div class="mb-6 text-center">
            <h2 class="text-2xl font-bold text-gray-900">Demande de support</h2>
            <p class="text-sm text-gray-500 mt-1">Remplissez ce formulaire pour nous envoyer un message.</p>
        </div>

        <form wire:submit.prevent="saveForm" class="space-y-5">
            
            <!-- Champ Catégorie -->
            <div>
                <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Catégorie</label>
                <select id="category" wire:model.live="category_id" 
                    class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 text-sm focus:outline-none focus:ring-2 focus:ring-[rgb(72,6,28)] focus:border-[rgb(72,6,28)]">
                    <option value="">-- Sélectionnez une catégorie --</option>
                    @foreach ($listCategories as $category)
                        <option value="{{ $category->id }}">{{ $category->label }}</option>
                    @endforeach
                </select>
                @error('category_id') <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
            </div>

            <!-- CORRECTION : Application du style au select conditionnel -->
            @if (!empty($listAddInfos) && count($listAddInfos) > 0)
            <div>
                <label for="add_info" class="block text-sm font-medium text-gray-700 mb-1">Précision de la demande</label>
                <select id="add_info" wire:model='add_info_id'
                    class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 text-sm focus:outline-none focus:ring-2 focus:ring-[rgb(72,6,28)] focus:border-[rgb(72,6,28)]">
                    <option value="">-- Sélectionnez une précision --</option>
                    @foreach ($listAddInfos as $addInfo)
                        <option value="{{$addInfo->id}}">{{$addInfo->label}}</option>
                    @endforeach
                </select>
                @error('add_info_id') <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
            </div>
            @endif
            
            <!-- Champ Objet -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Objet du message</label>
                <input type="text" id="title" wire:model="title" placeholder="Ex: Problème de connexion..."
                    class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 text-sm focus:outline-none focus:ring-2 focus:ring-[rgb(72,6,28)] focus:border-[rgb(72,6,28)]">
                @error('title') <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
            </div>
            
            <!-- Champ Contenu (Textarea) -->
            <div>
                <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Contenu</label>
                <textarea id="content" wire:model="content" rows="4" placeholder="Détaillez votre demande ici..."
                    class="w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 text-sm focus:outline-none focus:ring-2 focus:ring-[rgb(72,6,28)] focus:border-[rgb(72,6,28)] resize-none"></textarea>
                @error('content') <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
            </div>
            
            <!-- Bouton de soumission -->
            <div class="pt-2">
                <button type="submit" 
                    class="w-full bg-[rgb(72,6,28)] hover:bg-opacity-90 text-white font-bold py-3 px-4 rounded-md shadow transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[rgb(72,6,28)]">
                    Envoyer le message
                </button>
            </div>
            
        </form>
    </div>
</div>