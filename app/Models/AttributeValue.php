<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    protected $table = 'attribute_value';
    protected $primaryKey = 'idAttrValue';
    public $timestamps = true;

    protected $fillable = [
        'idAttribute',
        'AttrValName',
        'created_at',
        'updated_at',
    ];

    // Quan hệ với bảng `attribute`
    public function attribute()
    {
        return $this->belongsTo(Attribute::class, 'idAttribute', 'idAttribute');
    }

    // Quan hệ với bảng `product_attribute`
    public function productAttributes()
    {
        return $this->hasMany(ProductAttribute::class, 'idAttrValue', 'idAttrValue');
    }
}
