<?php 

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'tbl_admin';
    protected $primaryKey = 'admin_id';
    public $timestamps = true;

    protected $fillable = [
        'admin_email',
        'admin_password',
        'admin_name',
        'admin_phone',
        'admin_avt',
        'position',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'admin_password',
    ];

    // Laravel mặc định tìm trường 'password', nhưng database lưu là 'admin_password'
    public function getAuthPassword()
    {
        return $this->admin_password;
    }
}


