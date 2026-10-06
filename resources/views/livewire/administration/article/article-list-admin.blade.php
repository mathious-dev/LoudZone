<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <!-- Conteneur avec scroll horizontal si l'écran est petit -->
    <div class="overflow-x-auto">
        <table class="w-full whitespace-nowrap text-left border-collapse">
            
            <!-- En-tête du tableau -->
            <thead class="bg-gray-50 border-b border-gray-200 text-xs uppercase text-gray-500 tracking-wider">
                <tr>
                    <th class="px-6 py-4 font-medium">Titre</th>
                    <th class="px-6 py-4 font-medium">Description</th>
                    <th class="px-6 py-4 font-medium">Prix HT</th>
                    <th class="px-6 py-4 font-medium">Slug</th>
                    <th class="px-6 py-4 font-medium text-center">Stock</th>
                    <th class="px-6 py-4 font-medium text-center">Statut</th>
                    <th class="px-6 py-4 font-medium text-center">TVA</th>
                    <th class="px-6 py-4 font-medium">Créateur</th>
                    <th class="px-6 py-4 font-medium">Catégorie</th>
                </tr>
            </thead>

            <!-- Corps du tableau -->
            <tbody class="divide-y divide-gray-200">
                @foreach ($listArticles as $article)
                <tr class="hover:bg-gray-50 transition-colors duration-200">
                    
                    <!-- Titre mis en évidence -->
                    <td class="px-6 py-4 text-sm font-semibold text-gray-900">
                        {{ $article->title }}
                    </td>
                    
                    <!-- Description tronquée (max-w-xs + truncate) pour ne pas casser le tableau -->
                    <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate" title="{{ $article->description }}">
                        {{ $article->description }}
                    </td>
                    
                    <td class="px-6 py-4 text-sm text-gray-700 font-medium">
                        {{ $article->price_ht }} €
                    </td>
                    
                    <td class="px-6 py-4 text-sm text-gray-400">
                        {{ $article->slug }}
                    </td>
                    
                    <!-- Stock avec couleur s'il est à 0 -->
                    <td class="px-6 py-4 text-sm text-center font-medium {{ $article->stock == 0 ? 'text-red-500' : 'text-gray-700' }}">
                        {{ $article->stock }}
                    </td>
                    
                    <!-- Statut avec jolis badges -->
                    <td class="px-6 py-4 text-center">
                        @if($article->is_published)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Publié
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                Non publié
                            </span>
                        @endif
                    </td>
                    
                    <td class="px-6 py-4 text-sm text-gray-500 text-center">
                        {{ $article->tva }} %
                    </td>
                    
                    <!-- Créateur avec point d'interrogation de sécurité -->
                    <td class="px-6 py-4 text-sm text-gray-700">
                        {{ $article->user?->name }} {{ $article->user?->first_name }}
                    </td>
                    
                    <!-- Catégorie avec point d'interrogation de sécurité -->
                    <td class="px-6 py-4 text-sm text-indigo-600 font-medium">
                        {{ $article->articleCategory?->label }}
                    </td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination intégrée joliment en bas de la carte -->
    @if ($listArticles->hasPages())
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
            {{ $listArticles->links() }}
        </div>
    @endif
</div>