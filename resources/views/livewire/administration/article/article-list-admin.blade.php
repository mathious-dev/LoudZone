<div class="p-6 bg-white rounded-lg shadow-md max-w-7xl mx-auto mt-8">

    <!-- En-tête avec le titre et le bouton d'ajout -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Gestion des Articles</h2>
            <p class="text-sm text-gray-500 mt-1">Gérez votre catalogue, vos prix et vos stocks.</p>
        </div>
        <a href="{{ route('admin.articleForm.create') }}" class="inline-flex items-center px-4 py-2.5 bg-indigo-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-800 transition ease-in-out duration-150 shadow-sm">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Ajouter un article
        </a>
    </div>

    <!-- BARRE D'OUTILS (Recherche + Filtres + Tri) -->
    <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm mb-6">
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
            
            <!-- Barre de recherche (Prend tout l'espace libre) -->
            <div class="flex-1 w-full">
                <x-search :options="$tabSearchPossibility" :listSearch="$listSearch" :search="$search" :searchWichColumn="$searchWichColumn"/>
            </div>
            
            <!-- Séparateur vertical (Visible sur écran large) -->
            <div class="hidden lg:block w-px h-10 bg-gray-200"></div>
            
            <!-- Zone des 3 filtres (Souple, ne s'écrase plus) -->
            <div class="flex flex-col sm:flex-row flex-wrap lg:flex-nowrap gap-4 w-full lg:w-auto">
                
                <!-- sm:flex-1 permet au filtre de s'adapter, lg:w-56 assure une bonne largeur sur PC (224px minimum) -->
                <div class="w-full sm:flex-1 lg:w-56">
                    <x-search-category :options="$tabSearchCategoryPossibility"/>
                </div>
                
                <div class="w-full sm:flex-1 lg:w-56">
                    <x-search-asc-desc :options="$tabSearchAscDescPossibility"/>
                </div>
                
                <div class="w-full sm:flex-1 lg:w-56">
                    <x-search-boolean 
                        wire:model.live="searchBoolean" 
                        label-true="Publié" 
                        label-false="Non publié" 
                    />
                </div>
                
            </div>
        </div>
    </div>

    <!-- ========================================== -->
    <!-- TABLEAU DES ARTICLES (Format Compacté)     -->
    <!-- ========================================== -->
    <div class="overflow-x-auto shadow-sm rounded-lg border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="w-8 px-2 py-3"></th>
                    <th scope="col" class="px-3 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Titre</th>
                    <!-- Prix regroupés -->
                    <th scope="col" class="px-3 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Prix de base</th>
                    <th scope="col" class="px-3 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Promo</th>
                    <th scope="col" class="px-3 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Prix final</th>
                    <!-- Statut et Stock regroupés -->
                    <th scope="col" class="px-3 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">État</th>
                    <th scope="col" class="px-3 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Catégorie</th>
                    <th scope="col" class="px-3 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>

            @foreach($listArticles as $article)
            <tbody x-data="{ expanded: false }" class="bg-white divide-y divide-gray-100">

                <!-- 1. LA LIGNE PRINCIPALE -->
                <tr class="hover:bg-gray-50 transition-colors duration-200">
                    
                    <!-- Bouton Dérouler -->
                    <td class="px-2 py-3 whitespace-nowrap text-center cursor-pointer" @click="expanded = !expanded">
                        <button class="text-gray-400 hover:text-indigo-600 focus:outline-none transition-colors">
                            <svg :class="{ 'rotate-90 text-indigo-600': expanded }" class="w-5 h-5 transform transition-all duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </td>

                    <!-- Titre -->
                    <td class="px-3 py-3 whitespace-nowrap text-sm font-bold text-gray-900 truncate max-w-[200px]" title="{{ $article->title }}">
                        {{ $article->title }}
                    </td>
                    
                    <!-- Prix de base (HT et TTC regroupés) -->
                    <td class="px-3 py-3 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ number_format($article->price_ht, 2, ',', ' ') }} € <span class="text-[10px] text-gray-500 font-normal">HT</span></div>
                        <div class="text-xs text-gray-500">{{ number_format($article->price_with_tva, 2, ',', ' ') }} € <span class="text-[10px]">TTC (TVA {{ $article->tva }}%)</span></div>
                    </td>
                    
                    <!-- Promotion -->
                    <td class="px-3 py-3 whitespace-nowrap text-center">
                        @if($article->promotion)
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-extrabold bg-[#48041B] text-white shadow-sm">
                                -{{ $article->promotion->amount }}%
                            </span>
                            <div class="text-[9px] text-gray-500 mt-0.5">{{ $article->promotion->label ?? 'Promo active' }}</div>
                        @else
                            <form wire:submit.prevent='saveFormPromotion({{ $article->id }})' class="flex flex-col items-center">
                                <div class="flex items-center gap-1">
                                    <select wire:model='promotionNullInfoId.{{ $article->id }}' class="block w-28 text-[11px] py-1 pl-2 pr-6 rounded border-gray-300 shadow-sm focus:border-[#48041B] focus:ring-[#48041B]">
                                        <option value="">Aucune</option>
                                        @foreach ($listPromotions as $promotion)
                                            <option value="{{ $promotion->id }}">{{ $promotion->label ?? 'Non défini' }} (-{{ $promotion->amount }}%)</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="inline-flex items-center justify-center px-2 py-1 bg-[#48041B] border border-transparent rounded font-bold text-[11px] text-white hover:bg-[#300211] shadow-sm">
                                        OK
                                    </button>
                                </div>
                                @error("promotionNullInfoId.{$article->id}") 
                                    <span class="text-red-500 text-[9px] mt-0.5 font-medium">{{ $message }}</span> 
                                @enderror
                            </form>
                        @endif
                    </td>
                    
                    <!-- Prix Final -->
                    <td class="px-3 py-3 whitespace-nowrap text-sm font-bold text-indigo-600">
                        {{ number_format($article->final_price, 2, ',', ' ') }} €
                    </td>

                    <!-- État (Statut & Stock regroupés) -->
                    <td class="px-3 py-3 whitespace-nowrap">
                        <div class="flex flex-col items-start gap-1">
                            @if($article->is_published)
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-green-100 text-green-800 border border-green-200">Publié</span>
                            @else
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-red-100 text-red-800 border border-red-200">Brouillon</span>
                            @endif
                            <span class="text-[11px] font-bold {{ $article->stock <= 0 ? 'text-red-500' : 'text-gray-600' }}">Stock: {{ $article->stock }}</span>
                        </div>
                    </td>

                    <!-- Catégorie -->
                    <td class="px-3 py-3 whitespace-nowrap text-sm text-indigo-600 font-medium">
                        @if($article->articleCategory)
                            {{ $article->articleCategory->label }}
                        @else
                            <form wire:submit.prevent="saveFormCategory({{ $article->id }})" class="flex items-center gap-1">
                                <select wire:model='categoryNullInfoId.{{ $article->id }}' class="block w-28 rounded border-gray-300 py-1 pl-2 pr-6 text-[11px] text-gray-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">Choisir...</option>
                                    @foreach ($listCategories as $category)
                                        <option value="{{ $category->id }}">{{ $category->label }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="inline-flex items-center justify-center rounded bg-indigo-600 px-2 py-1 text-[11px] font-semibold text-white shadow-sm hover:bg-indigo-500">
                                    OK
                                </button>
                            </form>
                        @endif
                    </td>

                    <!-- Actions -->
                    <td class="px-3 py-3 whitespace-nowrap text-sm font-medium text-right flex items-center justify-end gap-2">
                        <!-- Toggle Statut -->
                        <div>
                            @if($article->is_published)
                                <button wire:click="changeStatePublishArticle({{ $article->id }})" class="text-[11px] text-amber-700 hover:text-amber-900 font-semibold transition-colors border border-amber-300 bg-amber-50 hover:bg-amber-100 px-2 py-1 rounded shadow-sm">Dépublier</button>
                            @else
                                <button wire:click="changeStatePublishArticle({{ $article->id }})" class="text-[11px] text-emerald-700 hover:text-emerald-900 font-semibold transition-colors border border-emerald-300 bg-emerald-50 hover:bg-emerald-100 px-2 py-1 rounded shadow-sm">Publier</button>
                            @endif
                        </div>
                        
                        <!-- Éditer / Supprimer -->
                        <div class="flex items-center space-x-1 border-l border-gray-200 pl-2">
                            <a href="{{ route('admin.articleForm.edit', $article) }}" class="text-indigo-500 hover:text-indigo-900 transition-colors p-1 hover:bg-indigo-50 rounded" title="Modifier">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                            <button wire:confirm="Êtes-vous sûr de vouloir supprimer cet article ?" wire:click="delete({{ $article->id }})" class="text-red-500 hover:text-red-900 transition-colors p-1 hover:bg-red-50 rounded" title="Supprimer">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </div>
                    </td>
                </tr>

                <!-- 2. LA LIGNE DÉROULANTE (Infos Supplémentaires) -->
                <!-- Le colspan passe de 11 à 8 car on a réduit le nombre de colonnes ! -->
                <tr x-show="expanded" x-transition.opacity.duration.300ms style="display: none;" class="bg-gray-50/80">
                    <td colspan="8" class="px-6 py-6 border-b border-gray-200 shadow-inner">
                        <div class="flex flex-col md:flex-row gap-8 items-start">
                            <!-- Image -->
                            <div class="w-48 h-48 flex-shrink-0 bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                                @if($article->primary_image)
                                    <img src="{{ asset('storage/' . $article->primary_image) }}" alt="Image de {{ $article->title }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex flex-col items-center justify-center text-gray-400 bg-gray-50">
                                        <svg class="w-12 h-12 mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        <span class="text-xs font-medium">Aucune image</span>
                                    </div>
                                @endif
                            </div>

                            <!-- Détails de l'article -->
                            <div class="flex-grow w-full">
                                <h4 class="text-sm font-bold text-gray-900 mb-3 uppercase tracking-wider flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Description complète
                                </h4>
                                <div class="p-4 bg-white rounded-lg border border-gray-200 text-sm text-gray-600 leading-relaxed mb-5 shadow-sm">
                                    {{ $article->description ?: 'Aucune description fournie pour cet article.' }}
                                </div>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                                    <div class="bg-white p-3.5 rounded-lg border border-gray-200 shadow-sm">
                                        <span class="block text-gray-400 text-[10px] font-bold uppercase mb-1">Créateur</span>
                                        <span class="font-medium text-gray-800">{{ $article->user ? $article->user->first_name . ' ' . $article->user->name : 'aucun utilisateur ' }}</span>
                                    </div>
                                    <div class="bg-white p-3.5 rounded-lg border border-gray-200 shadow-sm">
                                        <span class="block text-gray-400 text-[10px] font-bold uppercase mb-1">Slug (URL)</span>
                                        <span class="font-medium text-gray-800 truncate block" title="{{ $article->slug }}">{{ $article->slug }}</span>
                                    </div>
                                    <div class="bg-white p-3.5 rounded-lg border border-gray-200 shadow-sm">
                                        <span class="block text-gray-400 text-[10px] font-bold uppercase mb-1">Taux TVA</span>
                                        <span class="font-medium text-gray-800">{{ $article->tva }} %</span>
                                    </div>
                                    <div class="bg-white p-3.5 rounded-lg border border-gray-200 shadow-sm">
                                        <span class="block text-gray-400 text-[10px] font-bold uppercase mb-1">Dernière modif.</span>
                                        <span class="font-medium text-gray-800">{{ $article->updated_at ? $article->updated_at->format('d/m/Y') : '-' }}</span>
                                    </div>
                                    @if ($article->articleCategory->isClotheCategory($article->article_category_id))
                                        <div>
                                            {{ $article->clothe?->size }}
                                        </div> 
                                        <div>
                                            {{ $article->clothe?->color?? 'Aucune' }}
                                        </div> 
                                    @endif
                                    
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
            @endforeach

        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $listArticles->links() }}
    </div>

</div>