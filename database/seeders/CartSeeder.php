<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i=0;$i<5;$i++)
        {
            Cart::create(['user_id'=>$i+1,'session_id'=>null]);
        }
        $articleIds = Article::pluck('id')->toArray();
        $listCart=Cart::all();
        foreach ($listCart as $cart) {
            //- On choisit au hasard combien d'articles différents il y aura dans ce panier (entre 1 et 4)
            $numberOfItems = rand(1, 4);

            //-On pioche des IDs d'articles au hasard dans notre tableau (sans doublons)
            // array_flip permet d'utiliser les IDs comme clés pour array_rand
            $randomPickedIds = array_rand(array_flip($articleIds), $numberOfItems);
            
            // Si on ne pioche qu'un seul article, PHP renvoie un chiffre et non un tableau. On le force en tableau.
            if (!is_array($randomPickedIds)) {
                $randomPickedIds = [$randomPickedIds];
            }

            // 4. On crée les lignes cart_items pour ce panier
            foreach ($randomPickedIds as $articleId) {
                CartItem::create([
                    'cart_id'    => $cart->id,
                    'article_id' => $articleId,
                    'quantity'   => rand(1, 5) // Quantité aléatoire entre 1 et 5 exemplaires
                ]);
            }
            
        }
    }
}
