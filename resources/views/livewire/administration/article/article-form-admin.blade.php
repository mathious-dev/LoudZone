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

            <!-- ========================================== -->
            <!-- SECTION PROMOTION REDESIGNÉE               -->
            <!-- ========================================== -->
            <div class="md:col-span-2 bg-yellow-50 border border-yellow-200 rounded-lg p-5">
                <label class="block text-sm font-bold text-yellow-800 mb-2 flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Appliquer une promotion
                </label>
                <select wire:model="promotion_id" class="w-full border-yellow-300 rounded-md shadow-sm focus:border-yellow-500 focus:ring-yellow-500 bg-white">
                    <option value="">- Aucune promotion -</option>
                    @foreach ($listPromotions as $promotion)
                        <option value="{{ $promotion->id }}">{{ $promotion->label ?? 'Aucun nom' }} (-{{ $promotion->amount }}%)</option>
                    @endforeach
                </select>
            </div>

            <!-- ========================================== -->
            <!-- SECTION VÊTEMENTS (DÉCLINAISONS) REDESIGNÉE -->
            <!-- ========================================== -->
            @if($this->isClothe())
                <div class="md:col-span-2">
                    <div class="flex items-center justify-between mb-2">
                        <label class="block text-sm font-bold text-gray-800">Modèles disponibles (Tailles / Couleurs)</label>
                        <!-- Bouton d'ajout global -->
                        <button type="button" wire:click='addTabClothes' class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            Ajouter un modèle
                        </button>
                    </div>

                    <div class="space-y-3">
                        @foreach ($tabClothes as $index => $clothe)
                            <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-lg border border-gray-200">
                                
                                <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <!-- Taille -->
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-500 mb-1 uppercase tracking-wider">Taille</label>
                                        <select wire:model='tabClothes.{{ $index }}.size' class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                                            <option value="">-- Choisir --</option>
                                            @foreach($listSizes as $key=>$label)
                                                <option value="{{ $key }}">{{ $label }}</option>
                                            @endforeach
                                        </select>
                                        @error('tabClothes.'.$index.'.size') 
                                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> 
                                        @enderror
                                    </div>
                                    
                                    <!-- Couleur -->
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-500 mb-1 uppercase tracking-wider">Couleur (Opt.)</label>
                                        <select wire:model='tabClothes.{{ $index }}.color' class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                                            <option value="">-- Choisir --</option>
                                            @foreach ($listColors as $label)
                                                <option value="{{ $label }}">{{ $label }}</option>
                                            @endforeach
                                        </select> 
                                        @error('tabClothes.'.$index.'.color') 
                                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> 
                                        @enderror
                                    </div>
                                </div>

                                <!-- Bouton de suppression aligné -->
                                <div class="pt-6">
                                    <button type="button" wire:click='deleteTabClothes({{ $index }})' class="p-2 text-red-400 hover:text-red-600 hover:bg-red-50 rounded-full transition-colors focus:outline-none" title="Supprimer ce modèle">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            
            <!-- Image Principale -->
            <div class="md:col-span-2 flex flex-col sm:flex-row gap-4 items-start bg-white p-4 rounded-lg border border-gray-200">
                <div class="flex-grow w-full">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Image principale</label>
                    <input type="file" wire:model='primary_image' class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 border border-gray-300 rounded-md shadow-sm cursor-pointer">
                    @error('primary_image') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
                
                @if($article->primary_image)
                    <div class="shrink-0">
                        <span class="block text-xs text-gray-400 mb-1">Actuelle</span>
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