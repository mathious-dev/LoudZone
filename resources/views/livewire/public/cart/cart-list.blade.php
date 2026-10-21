<div>
    <!-- On vérifie d'abord que le panier existe -->
    @if($cart && $cart->cartItems->isNotEmpty())
        
        <table class="min-w-full text-left">
            <thead>
                <tr>
                    <th class="px-4 py-2">Article</th>
                    <th class="px-4 py-2">Quantité</th>
                </tr>
            </thead>
            <tbody>
                <!-- On utilise bien $cart (le nom défini dans le PHP) -->
                @foreach ($cart->cartItems as $item)
                    <tr>
                        <td class="border px-4 py-2">
                            <!-- On affiche le titre de l'article, pas l'objet complet -->
                            {{ $item->article->title }} 
                        </td>
                        <td class="border px-4 py-2">
                            {{ $item->quantity }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    @else
        <div class="p-4 text-gray-500 italic">
            Ce panier est vide ou n'existe pas encore.
        </div>
    @endif
</div>