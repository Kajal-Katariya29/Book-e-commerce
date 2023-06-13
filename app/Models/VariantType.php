<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VariantType extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'variant_types';

    protected $primaryKey = 'variant_type_id';

    protected $fillable = ['variant_type_id','variant_id','variant_type_name','created_at','updated_at'];

    /**
     * Get the variant that owns the VariantType
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function variant(): BelongsTo
    {
        return $this->belongsTo(Variant::class);
    }
}
