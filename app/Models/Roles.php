<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    //
    public $timestmaps = false;
    protected $fillable = [ 'name' ];
    protected $primakey = 'id_roles';
    protected $table = 'roles';
    public function user(){
        return $this->belongsToMany(User::class);
    }
}
