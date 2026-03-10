<?php 
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PromoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $promo;

    public function __construct($promo)
    {
        $this->promo = $promo;
    }

    public function build()
    {
        return $this->subject($this->promo->mailpromo_title)
                    ->view('emails.promos.promo') // dùng HTML view (ko markdown)
                    ->with('promo', $this->promo);
    }
}