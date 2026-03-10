<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class PasswordReset extends Model
{
    protected $table = 'password_resets';
    public $incrementing = false;
    public $timestamps = false;
    protected $primaryKey = null;

    protected $fillable = ['email', 'token', 'created_at'];
    protected $casts = ['created_at' => 'datetime'];

    public function isExpired()
    {
        return $this->created_at->lt(Carbon::now()->subMinutes(60));
    }
}
