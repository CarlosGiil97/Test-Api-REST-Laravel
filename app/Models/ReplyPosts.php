<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use App\Models\User;


class ReplyPosts extends Model
{
    public $table = "post_replys";
    use HasFactory;

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }
}
