<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'tbl_product';
    protected $primaryKey = 'product_id';
    public $timestamps = true;

    protected $fillable = [
        'category_id',
        'product_name',
        'product_Slug',
        'product_code',
        'brand_id',
        'product_desc',
        'product_content',
        'product_gale_desc',
        'product_price',
        'product_image',
        'product_image_hover',
        'favorite_product',
        'product_sale',
		'product_stock_status',
        'product_status',
        'created_at',
        'updated_at',
    ];

    // Quan hệ với bảng `product_attribute`
    public function productAttributes()
    {
        return $this->hasMany(ProductAttribute::class, 'product_id', 'product_id');
    }

    // Quan hệ với bảng `category`
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }
    public function gallery()
    {
        return $this->hasMany(Gallery::class, 'product_id'); // Thay 'product_id' bằng khóa ngoại thực tế trong bảng gallery
    }
	public function attributes()
    {
        return $this->hasMany(ProductAttribute::class, 'product_id', 'product_id');
    }
    public function attributeValues()
{
    return $this->belongsToMany(AttributeValue::class, 'product_attribute', 'product_id', 'idAttrValue')
                ->withPivot('product_attribute_code', 'product_price')
                ->withTimestamps();
}
	 public function brand() {
        return $this->belongsTo(Brand::class, 'brand_id', 'brand_id');
    }
}
