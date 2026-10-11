<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        // On récupère uniquement les commandes validées
        $paidOrders = Order::where('state', true)->get();
        
        $paymentMethods = ['Stripe', 'PayPal', 'Carte Bancaire', 'Apple Pay'];

        foreach ($paidOrders as $order) {
            Payment::create([
                'amount' => $order->total_price, // Le montant correspond parfaitement à la commande
                'state' => true, 
                'transaction_id' => 'TXN-' . strtoupper(Str::random(12)), // Faux numéro de transaction complexe (ex: TXN-A8F9B2C4E1D3)
                'payment_method' => $paymentMethods[array_rand($paymentMethods)],
                'order_id' => $order->id
            ]);
        }
    }
}