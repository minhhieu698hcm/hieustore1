<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    public $timestamp = false;
    protected $fillable = ['VoucherName','description','VoucherQuantity','VoucherCondition','VoucherNumber','VoucherCode','bill_price_min','discount_max','VoucherStart','VoucherEnd'];
    protected $primaryKey = 'idVoucher';
    protected $table = 'voucher';
}
