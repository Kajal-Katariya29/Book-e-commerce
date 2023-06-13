<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'payments';

    protected $primaryKey = 'payment_id';

    protected $fillable = ['payment_id','order_id','payment_type','total_amount','payment_time','status','created_at','updated_at','deleted_at'];

}
