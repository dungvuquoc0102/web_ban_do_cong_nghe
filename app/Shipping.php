<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'shipping_name','shipping_city', 'shipping_province', 'shipping_wards', 'shipping_address', 'shipping_phone','shipping_email','shipping_notes','shipping_method'
    ];
    protected $primaryKey = 'shipping_id';
 	protected $table = 'tbl_shipping';
}
