<div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg mt-8">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">
        {{ $isEditing ? 'Modifier l\'article' : 'Créer un nouvel article' }}
    </h2>

    <!-- Affichage général des erreurs (optionnel, pour t'aider à débugger) -->
    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700">
            <p class="font-bold">Il y a des erreurs dans le formulaire :</p>
            <ul class="list-disc ml-5 text-sm mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form wire:submit.prevent='saveForm' class="space-y-6">
        <!-- Grille sur 2 colonnes pour les grands écrans -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <!-- Titre -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Titre</label>
                <input type="text" wire:model='title' class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Slug -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Slug (URL)</label>
                <input type="text" wire:model='slug' class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('slug') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Description (Prend toute la largeur) -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea wire:model='description' rows="3" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Price HT -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Prix HT (€)</label>
                <input type="number" step="0.01" wire:model='price_ht' class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('price_ht') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- TVA -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">TVA (%)</label>
                <input type="number" step="0.1" wire:model='tva' class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('tva') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Stock -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Stock disponible</label>
                <input type="number" wire:model='stock' class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('stock') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Catégorie -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Catégorie</label>
                <select wire:model.live='article_category_id' class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <!-- Option par défaut vide TRÈS IMPORTANTE pour forcer le choix -->
                    <option value="">-- Sélectionnez une catégorie --</option>
                    
                    @if($listArticleCategories)
                        @foreach ($listArticleCategories as $categories)
                            <option value="{{$categories->id}}">{{ $categories->label }}</option>
                        @endforeach
                    @endif
                </select>
                @error('article_category_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            @if($this->isClothe())
            <div>
                <select wire:model='size'>
                    <option value="">-</option>
                    @foreach($availableSizes as $key => $label)
                        <option value="{{ $key }}">{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            @endif

            <div>
                <img src="{{asset('storage/'.$article->primary_image)  }}">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Image principale</label>
                <input type="file" wire:model='primary_image' class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('primary_image') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                @foreach($pictures as $picture)
                <img src="{{ asset('storage/'.$picture) }}">
                @endforeach
            </div>
            <div>
                <label>Autres images </label>
                <input type="file" wire:model='pictures' multiple>
            </div>
        </div> <!-- Fin de la grille -->

        <!-- Publié (Checkbox stylisée) -->
        <div class="flex items-center mt-6">
            <input type="checkbox" id="is_published" wire:model='is_published' class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
            <label for="is_published" class="ml-2 block text-sm text-gray-900 font-medium">
                Publier cet article immédiatement
            </label>
            @error('is_published') <span class="ml-2 text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Bouton de soumission -->
        <div class="flex justify-end pt-4 border-t border-gray-200 mt-6">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-md shadow-sm transition duration-150 ease-in-out">
                Confirmer l'enregistrement
            </button>
        </div>
    </form>
</div>