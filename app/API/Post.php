<?php

namespace App\API;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected  $fillable = ['title', 'detail'];
}
