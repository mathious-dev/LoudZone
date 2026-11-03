<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    
    <!-- En-tête avec bouton de retour textuel -->
    <div class="mb-8 flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-900">Détails de l'utilisateur</h1>
        <a href="{{ route('admin.userList') }}" class="text-[#5D0824] hover:underline font-medium">
            Retour à la liste
        </a>
    </div>

    <!-- Informations Principales (Sans logos) -->
    <div class="bg-white shadow-sm rounded-xl border border-gray-100 p-6 mb-8">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">{{ $user->first_name }} {{ $user->name }}</h2>
                <p class="text-gray-600 mt-1">Email : {{ $user->email }}</p>
                <p class="text-gray-600">Inscrit le : {{ $user->created_at->translatedFormat('d F Y') }}</p>
                <p class="text-gray-600">Newsletter : 
                    <span class="font-bold {{ $user->news_letter ? 'text-green-600' : 'text-gray-500' }}">
                        {{ $user->news_letter ? 'Abonné' : 'Non abonné' }}
                    </span>
                </p>
            </div>
            
            <!-- Rôles -->
            <div class="mt-4 md:mt-0">
                <h3 class="text-sm font-bold text-gray-700 uppercase tracking-wider mb-2 md:text-right">Rôles</h3>
                <div class="flex flex-wrap gap-2 md:justify-end">
                    @forelse($user->roles as $role)
                        <span class="px-3 py-1 bg-[#5D0824]/10 text-[#5D0824] font-bold text-sm rounded">
                            {{ ucfirst($role->name) }}
                        </span>
                    @empty
                        <span class="px-3 py-1 bg-gray-100 text-gray-600 text-sm rounded">Aucun rôle</span>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Détails des relations (Listes avec foreach) -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

        <!-- Colonne 1 -->
        <div class="space-y-8">
            
            <!-- Commandes -->
            <div>
                <h3 class="text-lg font-bold text-gray-900 mb-3 border-b pb-2">Commandes ({{ $user->orders->count() }})</h3>
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <ul class="divide-y divide-gray-100">
                        @forelse($user->orders as $order)
                            <li class="p-4 hover:bg-gray-50 transition-colors">
                                <div class="flex justify-between items-center">
                                    <span class="font-bold text-gray-900">Commande #{{ $order->id }}</span>
                                    <span class="text-sm text-gray-500">{{ $order->created_at->format('d/m/Y') }}</span>
                                </div>
                                <div class="text-sm text-gray-600 mt-1">
                                    Statut: {{ $order->status ?? 'Terminée' }} | Total: {{ $order->total ?? '0' }} €
                                </div>
                            </li>
                        @empty
                            <li class="p-4 text-gray-500 text-sm">Aucune commande passée.</li>
                        @endforelse
                    </ul>
                </div>
            </div>

            <!-- Paniers -->
            <div>
                <h3 class="text-lg font-bold text-gray-900 mb-3 border-b pb-2">Paniers ({{ $user->carts->count() }})</h3>
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <ul class="divide-y divide-gray-100">
                        @forelse($user->carts as $cart)
                            <li class="p-4 hover:bg-gray-50 transition-colors">
                                <div class="flex justify-between items-center">
                                    <span class="font-bold text-gray-900">Panier #{{ $cart->id }}</span>
                                    <span class="text-sm text-gray-500">M.à.j: {{ $cart->updated_at->format('d/m/Y H:i') }}</span>
                                </div>
                            </li>
                        @empty
                            <li class="p-4 text-gray-500 text-sm">Aucun panier en cours.</li>
                        @endforelse
                    </ul>
                </div>
            </div>

        </div>

        <!-- Colonne 2 -->
        <div class="space-y-8">

            <!-- Articles -->
            <div>
                <h3 class="text-lg font-bold text-gray-900 mb-3 border-b pb-2">Articles publiés ({{ $user->articles->count() }})</h3>
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <ul class="divide-y divide-gray-100">
                        @forelse($user->articles as $article)
                            <li class="p-4 hover:bg-gray-50 transition-colors">
                                <div class="flex justify-between items-center">
                                    <!-- J'ai supposé que ton article a un champ "title" ou "name" -->
                                    <span class="font-bold text-gray-900">{{ $article->title ?? $article->name ?? 'Article #'.$article->id }}</span>
                                    <span class="text-sm text-gray-500">{{ $article->created_at->format('d/m/Y') }}</span>
                                </div>
                            </li>
                        @empty
                            <li class="p-4 text-gray-500 text-sm">Aucun article publié.</li>
                        @endforelse
                    </ul>
                </div>
            </div>

            <!-- Messages de support -->
            <div>
                <h3 class="text-lg font-bold text-gray-900 mb-3 border-b pb-2">Messages de support ({{ $user->supportMessages->count() }})</h3>
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <ul class="divide-y divide-gray-100">
                        @forelse($user->supportMessages as $message)
                            <li class="p-4 hover:bg-gray-50 transition-colors">
                                <div class="flex justify-between items-start mb-1">
                                    <!-- Supposons un champ subject ou title -->
                                    <span class="font-bold text-gray-900">{{ $message->subject ?? 'Message #'.$message->id }}</span>
                                    <span class="text-xs text-gray-500">{{ $message->created_at->format('d/m/Y H:i') }}</span>
                                </div>
                                <!-- Supposons un champ content ou message -->
                                <p class="text-sm text-gray-600 line-clamp-2">
                                    {{ $message->content ?? $message->message ?? 'Contenu du message...' }}
                                </p>
                            </li>
                        @empty
                            <li class="p-4 text-gray-500 text-sm">Aucun message de support.</li>
                        @endforelse
                    </ul>
                </div>
            </div>

        </div>

    </div>
</div>