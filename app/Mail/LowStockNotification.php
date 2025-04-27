<?php
namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Database\Eloquent\Collection;

class LowStockNotification extends Mailable
{
    public $lowStockProducts; // متغير لتخزين مجموعة المنتجات

    public function __construct(Collection $lowStockProducts)
    {
        $this->lowStockProducts = $lowStockProducts; // تخزين المجموعة
    }

    public function build()
    {
        return $this->view('low_stock_notification') // استخدام ملف العرض
            ->subject('Low Stock Notification'); // عنوان البريد الإلكتروني
    }
}
