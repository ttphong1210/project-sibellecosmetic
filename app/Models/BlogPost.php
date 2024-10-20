<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    //
    protected $table = 'blog_post';
    protected $primaryKey = 'id';
    protected $fillable = [
        'title',
        'slug',
        'summary',
        'content',
        'featured_image',
        'author_id',
        'published_at',
        'status',
        'meta_title',
        'meta_description',
        'meta_keywords'
    ];
    public function author(){
        return $this->belongsTo(User::class, 'author_id');
    }
}
