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

    <!-- ========================================== -->
    <!-- BARRE D'OUTILS (Recherche + Filtres + Tri) -->
    <!-- ========================================== -->
    <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm mb-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            
            <!-- Recherche principale (Prend le plus d'espace) -->
            <div class="flex-1 w-full">
                <x-search :options="$tabSearchPossibility" />
            </div>
            
            <!-- Séparateur vertical (visible uniquement sur grand écran) -->
            <div class="hidden md:block w-px h-10 bg-gray-200"></div>
            
            <!-- Zone des filtres (Catégorie & Tri) -->
            <div class="flex flex-col sm:flex-row gap-4 w-full md:w-auto">
                <div class="w-full sm:w-56">
                    <x-search-category :options="$tabSearchCategoryPossibility"/>
                </div>
                <div class="w-full sm:w-56">
                    <x-search-asc-desc :options="$tabSearchAscDescPossibility"/>
                </div>
            </div>
            
        </div>
    </div>

    <!-- ========================================== -->
    <!-- TABLEAU DES ARTICLES                       -->
    <!-- ========================================== -->
    <div class="overflow-hidden shadow-sm rounded-lg border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="w-10 px-4 py-3"></th>
                    <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Titre</th>
                    <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Prix HT</th>
                    <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Prix TTC</th>
                    <th scope="col" class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Stock</th>
                    <th scope="col" class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Statut</th>
                    <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Catégorie</th>
                    <th scope="col" class="px-4 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>

            @foreach($listArticles as $article)
            <tbody x-data="{ expanded: false }" class="bg-white divide-y divide-gray-100">

                <!-- 1. LA LIGNE PRINCIPALE -->
                <tr class="hover:bg-gray-50 transition-colors duration-200">
                    
                    <!-- Bouton Dérouler -->
                    <td class="px-4 py-4 whitespace-nowrap text-center cursor-pointer" @click="expanded = !expanded">
                        <button class="text-gray-400 hover:text-indigo-600 focus:outline-none transition-colors">
                            <svg :class="{ 'rotate-90 text-indigo-600': expanded }" class="w-5 h-5 transform transition-all duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </td>

                    <!-- Infos principales -->
                    <td class="px-4 py-4 whitespace-nowrap text-sm font-bold text-gray-900">{{ $article->title }}</td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-600">{{ number_format($article->price_ht, 2, ',', ' ') }} €</td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">{{ number_format($article->price_with_tva, 2, ',', ' ') }} €</td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-center font-bold {{ $article->stock <= 0 ? 'text-red-500 bg-red-50 rounded-lg px-2' : 'text-green-600' }}">{{ $article->stock }}</td>

                    <!-- Statut -->
                    <td class="px-4 py-4 whitespace-nowrap text-center">
                        @if($article->is_published)
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">Publié</span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 border border-red-200">Brouillon</span>
                        @endif
                    </td>

                    <!-- Catégorie -->
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-indigo-600 font-medium">
                        {{ $article->articleCategory?->label ?? 'Aucune catégorie ' }}
                        @if( $article->articleCategory?->label==null)
                        <form wire:submit.prevent="saveFormCategory({{ $article }})">
                            <select wire:model='categoryNullInfoId.{{ $article->id }}'>
                                <option value="">-</option>
                                @foreach ($listCategories as $category)
                                    <option value="{{ $category->id }}">{{ $category->label }}</option>
                                @endforeach
                            </select>
                            <button type="submit">Confirmer</button>
                        </form>
                        
                        @endif
                    </td>

                    <!-- Actions -->
                    <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-right flex items-center justify-end gap-4">
                        
                        <!-- Toggle Statut -->
                        <div>
                            @if($article->is_published)
                                <button wire:click="changeStatePublishArticle({{ $article->id }})" class="text-xs text-amber-700 hover:text-amber-900 font-semibold transition-colors duration-200 border border-amber-300 bg-amber-50 hover:bg-amber-100 px-3 py-1.5 rounded-md shadow-sm">Dépublier</button>
                            @else
                                <button wire:click="changeStatePublishArticle({{ $article->id }})" class="text-xs text-emerald-700 hover:text-emerald-900 font-semibold transition-colors duration-200 border border-emerald-300 bg-emerald-50 hover:bg-emerald-100 px-3 py-1.5 rounded-md shadow-sm">Publier</button>
                            @endif
                        </div>
                        
                        <!-- Éditer / Supprimer -->
                        <div class="flex items-center space-x-3 border-l border-gray-200 pl-4">
                            <a href="{{ route('admin.articleForm.edit', $article) }}" class="text-indigo-500 hover:text-indigo-900 transition-colors duration-200 p-1 hover:bg-indigo-50 rounded" title="Modifier">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                            <button wire:confirm="Êtes-vous sûr de vouloir supprimer cet article ?" wire:click="delete({{ $article->id }})" class="text-red-500 hover:text-red-900 transition-colors duration-200 p-1 hover:bg-red-50 rounded" title="Supprimer">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </div>
                    </td>
                </tr>

                <!-- 2. LA LIGNE DÉROULANTE (Infos Supplémentaires) -->
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