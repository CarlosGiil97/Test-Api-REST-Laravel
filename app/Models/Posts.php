<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;
    public $timestamps = false;


    public function Categories()
    {
        return $this->belongsToMany(Posts::class, 'categories', 'id');
    }
}