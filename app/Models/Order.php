<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'ref_id',
        'user_id',
        'user_address_id',
        'promo_code_id',
        'delivery_method',
        'payment_method',
        'goods_cost',
        'delivery_cost',
        'total_cost',
        'status',
    ];

    public static array $statuses = ['unpaid', 'paid', 'under_process', 'processing', 'finished', 'rejected', 'canceled', 'refunded_request', 'refunded', 'returned'];

    public static array $deliveryMethods = [
        'Courier',
        'Self-delivery from Meest',
        'Self-delivery from Ukrposhta',
        'Self-delivery from Nova Poshta'
    ];

    public static array $paymentMethods = [
        'cash',
        'Stripe',
        'Bank Transfer'
    ];

    public function goods(): BelongsToMany
    {
        return $this->belongsToMany(Good::class, 'order_items', 'order_id', 'good_id');
    }

    public function orderHistories(): HasMany
    {
        return $this->hasMany(OrderHistory::class);
    }
}
