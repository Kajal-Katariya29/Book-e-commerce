<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Variant extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'variants';

    protected $primaryKey = 'variant_id';

    protected $fillable = ['variant_id','variant_type','created_at','updated_at','deleted_at'];

    /**
     * Get all of the variant type  for the Variant
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function varianttype (): HasMany
    {
        return $this->hasMany(VariantType::class);
    }

}
