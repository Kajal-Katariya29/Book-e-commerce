<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\OrderItem;

class Order extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'orders';

    protected $primaryKey = 'order_id';

    protected $fillable = ['order_id','user_id','order_date','order_shipping_date','shipping_address_id','billing_address_id','payment_type','payment_status','total_amount','created_at','updated_at','deleted_at'];

    /**
     * Get all of the items for the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class,'order_id','order_id');
    }

    public function user(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Get all of the address for the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shippingAddress(): HasMany
    {
        return $this->hasMany(Address::class, 'address_id', 'shipping_address_id');
    }

     /**
     * Get all of the address for the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function billingAddress(): HasMany
    {
        return $this->hasMany(Address::class, 'address_id', 'billing_address_id');
    }

}
