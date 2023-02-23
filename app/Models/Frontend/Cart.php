<?php

namespace App\Models\frontend;

use App\Models\Product;
use App\Models\admin\Color;
use App\Models\admin\ProductColor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'price',
        'color_id',
    ];

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id','id');
    }

    public function colors()
    {
        return $this->belongsTo(Color::class, 'color_id','id');
    }

    public function ProductColors()
    {
        return $this->belongsTo(ProductColor::class, 'color_id','id');
    }

}
