<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'tbl_brand_product';
    protected $primaryKey = 'brand_id';
    public $timestamps = true;

    protected $fillable = [
        'brand_name',
        'brand_desc',
        'brand_status',
        'created_at',
        'updated_at',
    ];
}
