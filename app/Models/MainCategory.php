<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function products()
    {
        return $this->hasMany(Products::class, 'main_category_id', 'id');
    }

    public function categories()
    {
        return $this->hasMany(Category::class, 'main_category_id', 'id');
    }

    public function subCategories()
    {
        return $this->hasMany(SubCategory::class, 'main_category_id', 'id');
    }
}
