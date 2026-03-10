<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Authenticatable
{
    use HasFactory;

    // Chỉ định tên bảng cụ thể
    protected $table = 'customer';

    // Chỉ định khóa chính
    protected $primaryKey = 'idCustomer';
    public $incrementing = true;
    protected $keyType = 'int';

    // Các cột có thể được điền giá trị tự động
    protected $fillable = [
        'username',
        'password',
        'first_name',
        'last_name',
        'sex',
        'phone',
        'address',
        'district',
		'city',
        'birthday',
        'avatar',
		'remember_token',
    ];

    // Ẩn cột password khi xuất dữ liệu
    protected $hidden = [
        'password',
    ];

    // Mutator để tự động mã hóa mật khẩu
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
    public function getEmailForPasswordReset()
    {
        return $this->username; // vì username là email
    }
    public function orders()
{
    return $this->hasMany(Order::class, 'idCustomer', 'idCustomer');
}

}
