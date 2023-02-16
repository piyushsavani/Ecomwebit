<?php

namespace App\Models\Admin;

use App\Models\Product;
use App\Models\Admin\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id','id');
    }

    public function brands()
    {
        return $this->hasMany(Brand::class, 'category_id','id');
    }
}
