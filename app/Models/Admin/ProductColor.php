<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    use HasFactory;

    protected $table = 'product_colors';
    protected $fillable = [
        'product_id',
        'color_id',
        'quantity'
    ];

    public function colors()
    {
      return $this->belongsTo(Color::class, 'color_id', 'id');
    }
}
