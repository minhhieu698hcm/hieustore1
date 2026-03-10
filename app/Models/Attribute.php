<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $table = 'attribute';
    protected $primaryKey = 'idAttribute';
    public $timestamps = true;

    protected $fillable = [
        'AttributeName',
        'created_at',
        'updated_at',
    ];

    // Quan hệ với bảng `attribute_value`
    public function attributeValues()
    {
        return $this->hasMany(AttributeValue::class, 'idAttribute', 'idAttribute');
    }
    public function products()
{
    return $this->belongsToMany(Product::class, 'product_attribute', 'attribute_id', 'product_id');
}
}
