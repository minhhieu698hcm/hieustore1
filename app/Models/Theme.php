<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    protected $table = 'theme';
    protected $primaryKey = 'theme_id';
    public $timestamps = true;

    protected $fillable = [
        'admin_id',
        'data-bs-theme',
        'data-color-theme',
        'data-layout',
        'data-boxed-layout',
        'data-card',
		'created_at',
        'updated_at',
    ];

}
