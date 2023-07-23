<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;
    public $timestamps = false;


    public function categories()
    {
        return $this->hasOne(Categories::class, 'id', 'id_cat');
    }

    public function infoUser()
    {
        return $this->belongsTo(User::class, 'id_user')->select('id', 'username', 'name', 'email');
    }

    public function replyes()
    {

        return $this->hasMany(ReplyPosts::class, 'id_post', 'id');
    }
}
