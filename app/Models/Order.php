<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'state',
        'total_price',
        'reference',
        'user_id'
    ];
    protected $attributes=['state'=>false];
    public function articleOrders()
    {
        return $this->hasMany(ArticleOrder::class);
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    //booted est un model event, dès qu'on fait appel au modèle cette méthode s'applique
    protected static function booted()
    {
        //ici on dit à laravel dès qu'on crée une commande met en pause et applique ce code
        static::creating(function($order)
        {
            //ici on additionne la date + le nombre aléatoire
            $order->reference=date('Ymd').random_int(1000, 9999);
        });
    }
}
