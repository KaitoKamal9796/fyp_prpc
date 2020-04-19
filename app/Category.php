<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    public function posts() //help us know the number of post that are associated with the categories
    {
        return $this->hasMany(Post::class); 
    }


}