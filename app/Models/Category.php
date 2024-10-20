<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Category extends Model
{
    //

    protected $table = 'categories';
    protected $primaryKey = 'cate_id';
    protected $fillable=[
        'cate_name',
        'cate_slug'
    ];

    public function products(){
        return $this->hasMany(Product::class);
    }
}
