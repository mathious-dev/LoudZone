<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Order;
use App\Models\ArticleOrder;
use Illuminate\Database\Seeder;

class ArticleOrderSeeder extends Seeder
{
    public function run(): void
    {
        $orders = Order::all();
        $articles = Article::all();

        if ($articles->isEmpty()) {
            return; // On arrête tout s'il n'y a aucun article en base
        }

        foreach ($orders as $order) {
            // Entre 1 et 4 articles différents par commande
            $numberOfItems = rand(1, 4); 
            $orderTotal = 0;

            // On pioche des articles au hasard sans les répéter
            $randomArticles = $articles->random(min($numberOfItems, $articles->count()));

            foreach ($randomArticles as $article) {
                $quantity = rand(1, 3);
                $unitPrice = rand(15, 120) + (rand(0, 99) / 100); // Prix aléatoire entre 15.00€ et 120.99€

                ArticleOrder::create([
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                    'article_id' => $article->id,
                    'order_id' => $order->id
                ]);

                // On additionne au total de la commande
                $orderTotal += ($quantity * $unitPrice);
            }

            // MAGIE : On met à jour la commande avec le prix exact calculé !
            $order->update(['total_price' => $orderTotal]);
        }
    }
}