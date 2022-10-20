<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Category extends Model
{
    //

    protected $table = 'categories';
    protected $primaryKey = 'cate_id';
    protected $fillable=['cate_name'];

    public function products(){
        return $this->hasMany(Product::class);
    }
}
