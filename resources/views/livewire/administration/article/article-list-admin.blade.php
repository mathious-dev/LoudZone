<div>
    <!-- En-tête avec le bouton Ajouter -->
    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-2xl font-semibold text-gray-800">Gestion des Articles</h2>
        <a href="{{ route('admin.articleForm.create') }}" class="inline-flex items-center bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-md shadow-sm transition duration-150 ease-in-out">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Ajouter un article
        </a>
    </div>

    <!-- Conteneur du tableau -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
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
                        <th class="px-6 py-4 font-medium text-center">Actions</th>
                    </tr>
                </thead>
                
                <!-- Corps du tableau -->
                <tbody class="divide-y divide-gray-200">
                    @foreach ($listArticles as $article)
                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                        
                        <td class="px-6 py-4 text-sm font-semibold text-gray-900">
                            {{ $article->title }}
                        </td>
                        
                        <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate" title="{{ $article->description }}">
                            {{ $article->description }}
                        </td>
                        
                        <td class="px-6 py-4 text-sm text-gray-700 font-medium">
                            {{ $article->price_ht }} €
                        </td>
                        
                        <td class="px-6 py-4 text-sm text-gray-400">
                            {{ $article->slug }}
                        </td>
                        
                        <td class="px-6 py-4 text-sm text-center font-medium {{ $article->stock == 0 ? 'text-red-500' : 'text-gray-700' }}">
                            {{ $article->stock }}
                        </td>
                        
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
                        
                        <td class="px-6 py-4 text-sm text-gray-700">
                            {{ $article->user?->name }} {{ $article->user?->first_name }}
                        </td>
                        
                        <td class="px-6 py-4 text-sm text-indigo-600 font-medium">
                            {{ $article->articleCategory?->label }}
                        </td>
                        
                        <!-- Actions stylisées avec icônes -->
                        <td class="px-6 py-4 text-sm font-medium text-center">
                            <div class="flex items-center justify-center space-x-3">
                                <!-- Bouton Modifier -->
                                <a href="{{ route('admin.articleForm.edit', $article) }}" class="text-indigo-600 hover:text-indigo-900 transition-colors duration-200" title="Modifier">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>
                                
                                <!-- Bouton Supprimer -->
                                <button wire:confirm="Êtes-vous sûr de vouloir supprimer cet article ?" wire:click="delete({{ $article->id }})" class="text-red-600 hover:text-red-900 transition-colors duration-200" title="Supprimer">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if ($listArticles->hasPages())
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                {{ $listArticles->links() }}
            </div>
        @endif
    </div>
</div>