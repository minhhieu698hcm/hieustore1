<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $table = 'discount';
    protected $primaryKey = 'discount_id';
    public $timestamps = true;

    protected $fillable = [
        'discount_id',
        'category_id',
        'percent',
		'created_at',
        'updated_at',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }
}
