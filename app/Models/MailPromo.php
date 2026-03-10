<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MailPromo extends Model
{
    protected $table = 'mailpromo'; // Tên bảng trong DB

    protected $primaryKey = 'mailpromo_id'; // Khóa chính

    public $timestamps = true; // Tự động xử lý created_at & updated_at

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $fillable = [
		'form_name',
        'mailpromo_title',
        'mailpromo_content',
        'mailpromo_image',
    ];
}
