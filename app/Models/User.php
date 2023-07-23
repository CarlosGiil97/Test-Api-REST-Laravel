<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Laravel\Sanctum\HasApiTokens;


use Illuminate\Auth\Authenticatable as AuthenticableTrait;




class User extends Model implements Authenticatable
{
    use HasFactory;
    use AuthenticableTrait;
    use HasApiTokens, HasFactory;
}