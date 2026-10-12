<div class="p-6 bg-white rounded-lg shadow-md max-w-7xl mx-auto mt-8">

    <!-- En-tête avec le titre et le bouton d'ajout -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
        <h2 class="text-2xl font-bold text-gray-800">Gestion des Articles</h2>
        <a href="{{ route('admin.articleForm.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 transition ease-in-out duration-150 shadow-sm">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Ajouter un article
        </a>
    </div>

    <!-- ========================================== -->
    <!-- BARRE D'OUTILS (Recherche + Tri)           -->
    <!-- ========================================== -->
    <div class="flex flex-col lg:flex-row justify-between items-center gap-4 mb-6 bg-gray-50 p-4 rounded-xl border border-gray-100">
        <div class="w-full lg:w-2/3">
            <x-search :options="$tabSearchPossibility" />
        </div>
        <div class="w-full lg:w-auto flex justify-end">
            <x-search-asc-desc :options="$tabSearchAscDescPossibility"/>
        </div>
    </div>

    <!-- Conteneur du tableau -->
    <div class="overflow-x-auto shadow-sm rounded-lg border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="w-10 px-4 py-3"></th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Titre</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prix HT</th>
                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Catégorie</th>
                    <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>

            @foreach ($listArticles as $article)
            <tbody x-data="{ expanded: false }" class="bg-white divide-y divide-gray-200">

                <!-- 1. LA LIGNE PRINCIPALE -->
                <tr class="hover:bg-gray-50 transition-colors duration-200">
                    <td class="px-4 py-4 whitespace-nowrap text-center cursor-pointer" @click="expanded = !expanded">
                        <button class="text-gray-500 hover:text-indigo-600 focus:outline-none transition-colors">
                            <svg :class="{ 'rotate-90': expanded }" class="w-5 h-5 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </td>

                    <td class="px-4 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">{{ $article->title }}</td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-700 font-medium">{{ number_format($article->price_ht, 2, ',', ' ') }} €</td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-center font-bold {{ $article->stock <= 0 ? 'text-red-500' : 'text-green-600' }}">{{ $article->stock }}</td>

                    <td class="px-4 py-4 whitespace-nowrap text-center">
                        @if($article->is_published)
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Publié</span>
                        @else
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Brouillon</span>
                        @endif
                    </td>

                    <td class="px-4 py-4 whitespace-nowrap text-sm text-indigo-600 font-medium">{{ $article->articleCategory?->label ?? 'Catégorie supprimée' }}</td>

                    <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-right">
                        <div class="flex items-center justify-end space-x-3">
                            <a href="{{ route('admin.articleForm.edit', $article) }}" class="text-indigo-600 hover:text-indigo-900 transition-colors duration-200" title="Modifier">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                            <button wire:confirm="Êtes-vous sûr de vouloir supprimer cet article ?" wire:click="delete({{ $article->id }})" class="text-red-600 hover:text-red-900 transition-colors duration-200" title="Supprimer">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </div>
                    </td>
                </tr>

                <!-- 2. LA LIGNE DÉROULANTE -->
                <tr x-show="expanded" x-transition style="display: none;" class="bg-indigo-50/50">
                    <td colspan="7" class="px-6 py-6 border-b border-gray-200 shadow-inner">
                        <div class="flex flex-col md:flex-row gap-6 items-start">
                            <div class="w-48 h-48 flex-shrink-0 bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                                @if($article->primary_image)
                                    <img src="{{ asset('storage/' . $article->primary_image) }}" alt="Image" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex flex-col items-center justify-center text-gray-400 bg-gray-100">
                                        <svg class="w-10 h-10 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        <span class="text-xs font-medium">Aucune image</span>
                                    </div>
                                @endif
                            </div>

                            <div class="flex-grow w-full">
                                <h4 class="text-sm font-bold text-gray-900 mb-2 uppercase tracking-wider">Description complète</h4>
                                <div class="p-4 bg-white rounded-lg border border-gray-200 text-sm text-gray-600 leading-relaxed mb-4">
                                    {{ $article->description ?: 'Aucune description fournie.' }}
                                </div>

                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                                    <div class="bg-white p-3 rounded-lg border border-gray-100 shadow-sm">
                                        <span class="block text-gray-400 text-xs uppercase mb-1">Créateur</span>
                                        <span class="font-medium text-gray-800">{{ $article->user ? $article->user->first_name . ' ' . $article->user->name : 'Utilisateur supprimé' }}</span>
                                    </div>
                                    <div class="bg-white p-3 rounded-lg border border-gray-100 shadow-sm">
                                        <span class="block text-gray-400 text-xs uppercase mb-1">Slug (URL)</span>
                                        <span class="font-medium text-gray-800 truncate" title="{{ $article->slug }}">{{ $article->slug }}</span>
                                    </div>
                                    <div class="bg-white p-3 rounded-lg border border-gray-100 shadow-sm">
                                        <span class="block text-gray-400 text-xs uppercase mb-1">TVA</span>
                                        <span class="font-medium text-gray-800">{{ $article->tva }} %</span>
                                    </div>
                                    <div class="bg-white p-3 rounded-lg border border-gray-100 shadow-sm">
                                        <span class="block text-gray-400 text-xs uppercase mb-1">Dernière modif.</span>
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

    @if (method_exists($listArticles, 'hasPages') && $listArticles->hasPages())
        <div class="mt-6">
            {{ $listArticles->links() }}
        </div>
    @endif
</div>