<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $table = 'addresses';

    protected $primaryKey = 'address_id';

    protected $fillable = ['address_id','first_name','last_name', 'user_id','email_id','phone_number','address','country','city','state',
                            'pincode','created_at','updated_at','deleted_at'];
}
