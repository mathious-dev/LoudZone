<div class="bg-gray-50 py-12 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- La carte principale de l'article -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-10 p-8">
                
                <!-- ========================================== -->
                <!-- SECTION GAUCHE : LA GALERIE D'IMAGES       -->
                <!-- ========================================== -->
                <div>
                    @if(is_array($article->images) && count($article->images) > 0)
                        
                        <!-- Image mise en avant (La première de la galerie) -->
                        <div class="w-full h-96 mb-4 bg-gray-100 rounded-lg overflow-hidden border border-gray-200">
                            <img src="{{ asset('storage/' . $article->images[0]) }}" 
                                 alt="Image principale" 
                                 class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                        </div>
                        
                        <!-- La grille des miniatures en dessous -->
                        @if(count($article->images) > 1)
                            <div class="grid grid-cols-4 gap-4">
                                @foreach($article->images as $image)
                                    <div class="aspect-w-1 aspect-h-1 rounded-md overflow-hidden bg-gray-100 border border-gray-200">
                                        <img src="{{ asset('storage/'. $image) }}" 
                                            alt="Miniature" 
                                            class="w-full h-full object-cover hover:opacity-75 transition-opacity cursor-pointer">
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        
                    @else
                        <!-- Si l'article n'a aucune image -->
                        <div class="w-full h-96 bg-gray-100 rounded-lg flex flex-col items-center justify-center border-2 border-dashed border-gray-300">
                            <svg class="h-16 w-16 text-gray-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="text-gray-500 font-medium">Aucune image disponible</span>
                        </div>
                    @endif
                </div>

                <!-- ========================================== -->
                <!-- SECTION DROITE : LES DÉTAILS DU PRODUIT    -->
                <!-- ========================================== -->
                <div class="flex flex-col">
                    
                    <!-- Le badge de Catégorie -->
                    <div class="mb-4">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-indigo-100 text-indigo-800">
                            {{ $article->articleCategory->label ?? "Aucune catégorie" }}
                        </span>
                    </div>

                    <!-- Le Titre (J'ai ajouté le titre car c'est indispensable sur une page détail !) -->
                    <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight mb-4">
                        {{ $article->title }}
                    </h1>

                    <!-- Le Prix -->
                    <div class="mb-6 flex items-baseline">
                        <span class="text-4xl font-black text-gray-900">{{ number_format($article->price_ht, 2, ',', ' ') }} €</span>
                        <span class="ml-2 text-lg font-medium text-gray-500">HT</span>
                    </div>

                    <!-- La Description -->
                    <div class="mb-8">
                        <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-3">Description</h3>
                        <div class="prose prose-sm text-gray-600 bg-gray-50 p-4 rounded-lg border border-gray-100 leading-relaxed">
                            {{ $article->description }}
                        </div>
                    </div>

                    <!-- Séparateur -->
                    <hr class="border-gray-200 mb-6">

                    <!-- Gestion du Stock -->
                    <div class="mt-auto">
                        @if($article->stock > 0)
                            <!-- Affichage Vert si en stock -->
                            <div class="flex items-center text-green-700 bg-green-50 p-3 rounded-md border border-green-200 mb-6">
                                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span class="font-semibold text-lg">En stock</span>
                                <span class="ml-2 text-green-600">({{ $article->stock }} unités disponibles)</span>
                            </div>
                        @else
                            <!-- Affichage Rouge si hors stock -->
                            <div class="flex items-center text-red-700 bg-red-50 p-3 rounded-md border border-red-200 mb-6">
                                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                <span class="font-semibold text-lg">Rupture de stock</span>
                            </div>
                        @endif

                        <!-- Optionnel : Un bouton d'action (Retour ou Modifier) -->
                        <div class="flex gap-4">
                            <a href="{{ route('articleListPublic') }}" class="flex-1 bg-white border border-gray-300 rounded-md shadow-sm py-3 px-4 text-center text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                                Retour à la liste
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        
    </div>
</div>