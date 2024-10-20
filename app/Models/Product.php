<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Brand;

class Product extends Model
{
 
    protected $table = 'products';
    protected $primaryKey = 'prod_id';
    protected $fillable = [
        'prod_name',
        'prod_slug',
        'prod_price',
        'prod_img',
        'prod_summary',
        'prod_des',
        'prod_promotion',
        'prod_status',
        'prod_featured',
        'prod_brand',
        'prod_gallery',
        'prod_cate'];

    public function category(){
        return $this->belongsTo(Category::class,'prod_id', 'cate_id');
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

}
