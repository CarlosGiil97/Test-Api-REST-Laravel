<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Posts;



class Categories extends Model
{
    use HasFactory;

    public function categoriesPosts()
    {
        return $this->hasMany(Posts::class, 'id_cat', 'id');
    }
}