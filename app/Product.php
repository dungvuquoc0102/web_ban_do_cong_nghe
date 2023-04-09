<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	public $timestamps = false; //set time to false
	protected $fillable = [
		'product_name','product_tags', 'product_quantity', 'product_sold', 'product_slug', 'category_id', 'brand_id', 'product_desc', 'product_content', 'product_price',  'price_cost', 'product_image', 'product_file', 'product_views', 'product_status'
	];
	protected $primaryKey = 'product_id';
	protected $table = 'tbl_product';

	public function comment()
	{
		return $this->hasMany('App\Comment');
	}

	public function category()
	{
		return $this->belongsTo('App\CategoryProductModel', 'category_id');
	}

	public function brand()
	{
		return $this->belongsTo('App\Brand', 'brand_id');
	}
}
