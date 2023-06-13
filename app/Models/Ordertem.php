<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'order_items';

    protected $primaryKey = 'order_item_id';

    protected $fillable = ['order_item_id','book_id','order_id','quantity','price','discount','created_at','updated_at','deleted_at'];

    /**
     * Get the order that owns the Ordertem
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
