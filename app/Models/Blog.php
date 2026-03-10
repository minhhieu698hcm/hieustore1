<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'tbl_blog';
    protected $primaryKey = 'blog_id';
    public $timestamps = true;

    protected $fillable = [
        'blog_title',
        'blog_slug',
        'blog_content',
        'blog_content2',
        'blog_desc',
        'blog_image',
        'blog_image_avt',
        'blog_status',
        'related_product_ids',
        'related_blog_ids',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'related_product_ids' => 'array',
        'related_blog_ids' => 'array',
    ];
}
