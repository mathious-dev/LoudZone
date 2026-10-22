<div>
    
    <!-- On vérifie d'abord que le panier existe -->
    @if($cart && $cart->cartItems->isNotEmpty())
        <button wire:confirm="êtes-vous sûr de vider le panier?" wire:click='deleteItems({{$cart->id  }})'>Vider le panier</button>
        <table class="min-w-full text-left">
            <thead>
                <tr>
                    <th class="px-4 py-2">Article</th>
                    <th class="px-4 py-2">Quantité</th>
                    <td>Actions</td>
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
                            <button wire:click='addOrRemoveItem({{ $item }})'>+</button>
                            <button wire:click='addOrRemoveItem({{ $item }},-1)'>-</button>
                        </td>
                        <td> <button wire:click='deleteItem({{ $item->id }})'>Supprimer</button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    @else
        <div class="p-4 text-gray-500 italic">
            Votre panier est vide
        </div>
    @endif
</div>