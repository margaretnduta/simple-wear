<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'type', 'gender', 'description', 'price', 'stock_qty', 'image_path',
    ];

    // Derived status accessor (optional helper)
    public function getInStockAttribute(): bool
    {
        return $this->stock_qty > 0;
    }
}
