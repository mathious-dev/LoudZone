<div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg mt-8">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">
        {{ $isEditing ? 'Modifier l\'article' : 'Créer un nouvel article' }}
    </h2>

    <!-- Affichage général des erreurs -->
    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-md">
            <p class="font-bold">Il y a des erreurs dans le formulaire :</p>
            <ul class="list-disc ml-5 text-sm mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form wire:submit.prevent='saveForm' class="space-y-6">
        <!-- Grille principale -->
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
                <input type="number" step="0.01" wire:model.live='price_ht' class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('price_ht') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- TVA -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">TVA (%)</label>
                <input type="number" step="0.1" wire:model.live='tva' class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('tva') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            @if ($price_ht && $tva)
                <div class="md:col-span-2 bg-indigo-50 border border-indigo-100 rounded-lg p-4 flex items-center justify-between">
                    <div>
                        <span class="block text-sm font-bold text-indigo-800">Prix final de vente (TTC estimé)</span>
                        <span class="text-xs text-indigo-600">Calculé automatiquement</span>
                    </div>
                    <div class="text-2xl font-black text-indigo-900">
                        <!-- Calcul direct en HTML pour l'affichage uniquement -->
                        {{ number_format((float)$price_ht * (1 + ((float)$tva / 100)), 2, ',', ' ') }} €
                    </div>
                </div>
            @endif
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
                    <option value="">-- Sélectionnez une catégorie --</option>
                    @if($listArticleCategories)
                        @foreach ($listArticleCategories as $categories)
                            <option value="{{$categories->id}}">{{ $categories->label }}</option>
                        @endforeach
                    @endif
                </select>
                @error('article_category_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Options Vêtements (Taille & Couleur) -->
            @if($this->isClothe())
                @foreach ($tabClothes as $index=>$clothe)
                <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6 p-4 bg-gray-50 rounded-lg border border-gray-100">
                    <div>
                        <label class="block text-sm font-bold text-indigo-700 mb-1">Taille du vêtement</label>
                        <select wire:model='tabClothes.{{ $index }}.size' class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">-- Choisir une taille --</option>
                            @foreach($listSizes as $key=>$label)
                                <option value="{{ $key }}">{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('tabClothes.'.$index.'.size') 
                            <span class="text-red-500 text-xs">{{ $message }}</span> 
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-indigo-700 mb-1">Couleur (Optionnel)</label>
                        <select wire:model='tabClothes.{{ $index }}.color' class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">-- Choisir une couleur --</option>
                            @foreach ($listColors as $label)
                                <option value="{{ $label }}">{{ $label }}</option>
                            @endforeach
                        </select> 
                         @error('tabClothes.'.$index.'.color') 
                            <span class="text-red-500 text-xs">{{ $message }}</span> 
                        @enderror
                    </div>
                </div>
                <div>
                    <button type="button" wire:click='deleteTabClothes({{ $index }})'>-</button>
                </div>
                @endforeach
                <div>
                    <button type="button" wire:click='addTabClothes'>+</button>
                </div>
            @endif

            <!-- Image Principale -->
            <div class="md:col-span-2 flex flex-col sm:flex-row gap-4 items-start bg-white p-4 rounded-lg border border-gray-200">
                <div class="flex-grow w-full">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Image principale</label>
                    <!-- Superbe style pour l'input file grâce aux classes 'file:' de Tailwind -->
                    <input type="file" wire:model='primary_image' class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 border border-gray-300 rounded-md shadow-sm cursor-pointer">
                    @error('primary_image') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
                
                @if($article->primary_image)
                    <div class="shrink-0">
                        <span class="block text-xs text-gray-400 mb-1">Actuelle</span>
                        <!-- Miniature sécurisée (object-cover empêche l'image de se déformer) -->
                        <img src="{{ asset('storage/'.$article->primary_image) }}" class="w-24 h-24 object-cover rounded-md border border-gray-300 shadow-sm">
                    </div>
                @endif
            </div>

            <!-- Galerie d'images -->
            <div class="md:col-span-2 bg-white p-4 rounded-lg border border-gray-200">
                <label class="block text-sm font-medium text-gray-700 mb-2">Galerie d'images supplémentaires</label>
                <input type="file" wire:model='pictures' multiple class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 border border-gray-300 rounded-md shadow-sm cursor-pointer mb-4">
                @error('pictures') <span class="text-red-500 text-xs mb-2 block">{{ $message }}</span> @enderror

                @if($pictures && count($pictures) > 0)
                    <div class="flex flex-wrap gap-3 mt-2">
                        @foreach($pictures as $picture)
                            <!-- Miniatures pour la galerie -->
                            <img src="{{ asset('storage/'.$picture) }}" class="w-20 h-20 object-cover rounded-md border border-gray-300 shadow-sm">
                        @endforeach
                    </div>
                @endif
            </div>

        </div> <!-- Fin de la grille -->

        <!-- Publié (Checkbox stylisée) -->
        <div class="flex items-center mt-6 p-4 bg-gray-50 rounded-lg border border-gray-100">
            <input type="checkbox" id="is_published" wire:model='is_published' class="h-5 w-5 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded cursor-pointer">
            <label for="is_published" class="ml-3 block text-sm text-gray-900 font-medium cursor-pointer">
                Publier cet article immédiatement
            </label>
            @error('is_published') <span class="ml-2 text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Bouton de soumission -->
        <div class="flex justify-end pt-4 border-t border-gray-200 mt-6">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2.5 px-6 rounded-md shadow-md transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Confirmer l'enregistrement
            </button>
        </div>
    </form>
</div>