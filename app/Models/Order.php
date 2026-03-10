<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'idCustomer',
        'first_name',
        'last_name',
        'company_name',
        'country',
        'address',
        'apartment',
        'city',
        'district',
        'customer_phone',
        'customer_email',
        'order_note',
        'invoice_required',   // Trường này sẽ giúp kiểm tra yêu cầu xuất hóa đơn
        'invoice_tax_code',
        'invoice_company_name',
        'invoice_address',
        'invoice_email',
        'voucher',
        'shipping_fee',
        'total_price',
		'original_total',
        'status',
		'email_sent',
        'payment_method',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'idCustomer', 'idCustomer');
    }
    public function orders()
    {
        return $this->hasMany(Order::class, 'idCustomer');
    }

    /**
     * Kiểm tra đơn hàng có yêu cầu hóa đơn không.
     *
     * @return bool
     */
    public function requiresInvoice()
    {
        return (bool) $this->invoice_required;
    }
}
