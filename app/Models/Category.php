<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'tbl_category_product';
    protected $primaryKey = 'category_id';
    public $timestamps = true;

    protected $fillable = [
        'category_name',
        'category_desc',
        'category_status',
        'created_at',
        'updated_at',
    ];

    // Quan hệ với bảng `product`
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'category_id');
    }
    public function discount()
{
    return $this->hasOne(Discount::class, 'category_id', 'category_id');
}
}
