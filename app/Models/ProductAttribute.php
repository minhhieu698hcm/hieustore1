<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    protected $table = 'product_attribute';
    protected $primaryKey = 'idProAttr';
    public $timestamps = true;

    protected $fillable = [
		'idProAttr',
        'product_id', 
        'idAttrValue',
        'product_attribute_code',
		'product_price',
        'created_at',
        'updated_at',
    ];

    // Quan hệ với bảng `attribute_value`
    public function attributeValue()
    {
        return $this->belongsTo(AttributeValue::class, 'idAttrValue', 'idAttrValue');
    }

    // Quan hệ với bảng `product`
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
