<?php

namespace App\Models;

use App\Enum\StateEnum;
use App\Models\BaseEntity;


class Payment extends BaseEntity
{
    protected $nameValueColumn='transaction_id';
    protected $nameColumn='le paiement';
    protected $fillable = [
        'amount',
        'state',
        'transaction_id',
        'payment_method',
        'order_id'
    ];
    protected $casts = [
        'state' => StateEnum::class,
    ];
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function isFinished(): bool
    {
        return $this->state === StateEnum::FINISHED;
    }
    public function isWaiting(): bool
    {
        return $this->state === StateEnum::WAITING;
    }
    public function isRefused(): bool
    {
        return $this->state === StateEnum::REFUSED;
    }
}
