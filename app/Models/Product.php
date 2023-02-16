<?php

namespace App\Models;

use App\Models\admin\Color;
use App\Models\ProductImage;
use App\Models\Admin\Category;
use App\Models\admin\ProductColor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';

    protected $fillable = [
        'category_id',
        'product_name',
        'brand',
        'selling_price',
        'qauntity',
        'product_slug',
        'description',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'status',
        'trending'

    ];

    public function category()
    {
      return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function colors()
    {
      return $this->belongsTo(Color::class, 'color_id', 'id');
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class, 'product_id','id');
    }

    public function productColors()
    {
        return $this->hasMany(ProductColor::class, 'product_id','id');
    }

}
