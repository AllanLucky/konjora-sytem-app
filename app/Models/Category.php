<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'image',
    ];

    // Correct relationship name
    public function subcategory() // <--- plural
    {
        return $this->hasMany(SubCategory::class, 'category_id', 'id');
    }
}

