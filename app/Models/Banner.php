<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'title',
        'image_url',
        'link',
        'position',
        'order',
        'active',
    ];

    // Kiểu dữ liệu để casting khi truy xuất
    protected $casts = [
        'active' => 'boolean',
        'order' => 'integer',
        'position' => 'string',
    ];

    // Nếu cần: query scope để lấy từng nhóm banner
    public function scopeHero($query)
    {
        return $query->where('position', 'hero')->where('active', true)->orderBy('order');
    }

    public function scopeMiddle($query)
    {
        return $query->where('position', 'middle')->where('active', true);
    }

    public function scopeHighlight($query)
    {
        return $query->where('position', 'highlight')->where('active', true)->orderBy('order');
    }
}
