<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $type;
    public $promotions;

    public function __construct($order, $promotions = [], $type = 'customer')
    {
        $this->order = $order;
        $this->promotions = $promotions;
        $this->type = $type;
    }

    public function build()
    {
        if ($this->type === 'admin') {
            return $this->subject('Thông báo đơn hàng mới')
                        ->markdown('emails.orders.notification')
                        ->with([
                            'order' => $this->order,
                            'promotions' => $this->promotions,
                        ]);
        }

        return $this->subject('Thông tin đơn hàng của bạn')
                    ->markdown('emails.orders.created')
                    ->with([
                        'order' => $this->order,
                        'promotions' => $this->promotions,
                    ]);
    }
}