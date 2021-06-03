<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'products';

    protected $fillable = ['brand_id', 'name', 'slug', 'description', 'price', 'discount'];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    protected $appends = ['total_price', 'is_in_stock', 'stock_quantity', 'discount_amount'];

    public function getIsInStockAttribute() {
        return $this->stock->availability == 'In Stock';
    }

    public function getTotalPriceAttribute() {
        return round((1 - ($this->attributes['discount']/100)) * $this->attributes['price'], 2);
    }

    public function getStockQuantityAttribute() {
        return $this->stock->quantity;
    }

    public function getDiscountAmountAttribute() {
        return round($this->attributes['discount']/100 * $this->attributes['price'], 2);
    }

    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    public function image() {
        return $this->hasOne(ProductImage::class);
    }

    public function stock() {
        return $this->hasOne(Stock::class);
    }
}
