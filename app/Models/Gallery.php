<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'tbl_gallery';
    protected $primaryKey = 'gallery_id';
    public $timestamps = false;

    protected $fillable = [
        'gallery_name',
        'gallery_image',
        'product_id',
    ];

    // Quan hệ với bảng `product`
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
