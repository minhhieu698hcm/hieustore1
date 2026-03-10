<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'product_id',
        'gift_product_id',
        'image',
        'price_old',
        'price_new',
        'promotion_type',
        'min_total_for_gift',
        'combo_price',
        'start_date',
        'end_date',
        'is_active',
        'description',
    ];

     public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function giftProduct() {
        return $this->belongsTo(Product::class, 'gift_product_id');
    }

    // Quan hệ đến product_attribute
    public function productAttributes()
    {
        return $this->hasMany(ProductAttribute::class, 'product_id', 'product_id');
    }
}