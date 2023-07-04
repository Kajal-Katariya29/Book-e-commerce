<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use  App\Models\Order;

class OrderItem extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'order_items';

    protected $primaryKey = 'order_item_id';

    protected $fillable = ['order_item_id','book_id','order_id','quantity','price','discount','created_at','updated_at','deleted_at'];

    /**
     * Get the book that owns the OrderItem
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(BookList::class, 'book_id', 'book_id');
    }

    /**
     * Get the varianttype that owns the OrderItem
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function varianttype(): BelongsTo
    {
        return $this->belongsTo(VariantType::class, 'variant_type_id', 'variant_type_id');
    }

    /**
     * Get the order that owns the OrderItem
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }
}
