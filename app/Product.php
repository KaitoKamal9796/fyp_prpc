<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{

    protected $dates = [
        'published_at'
    ];

    protected $fillable = [

        'product_name', 'description', 'price', 'image', 'published_at'
        
    ];

    /**
     * Delete post image from storage
     * @return void
     */

    public function deleteImage()
    {
        Storage::delete($this->image);
    }

}
