<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $orderDetails;

    // استلام بيانات الطلب وتفاصيل الطلب في الـ Constructor
    public function __construct($order, $orderDetails)
    {
        $this->order = $order;
        $this->orderDetails = $orderDetails;
    }

    public function build()
    {
        // هنا يمكننا تحديد موضوع البريد الإلكتروني
        return $this->subject('Order Confirmation')
            ->view('email')
            ->with([
                'order' => $this->order,
                'orderDetails' => $this->orderDetails,
            ]);
    }
}
