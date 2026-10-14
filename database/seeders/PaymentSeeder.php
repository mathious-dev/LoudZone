<?php

namespace Database\Seeders;

use App\Enum\StateEnum;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        // CORRECTION 1 : On cherche les commandes avec l'Enum "FINISHED"
        $paidOrders = Order::where('state', StateEnum::FINISHED)->get();
        
        // CORRECTION 2 : cases() suffit, on retire le ->get()
        $states = StateEnum::cases(); 
        
        $paymentMethods = ['Stripe', 'PayPal', 'Carte Bancaire', 'Apple Pay'];

        foreach ($paidOrders as $order) {
            Payment::create([
                'amount' => $order->total_price, // Le montant correspond à la commande
                'state' => $states[array_rand($states)], 
                'transaction_id' => 'TXN-' . strtoupper(Str::random(12)), 
                'payment_method' => $paymentMethods[array_rand($paymentMethods)],
                'order_id' => $order->id
            ]);
        }
    }
}