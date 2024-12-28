<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Order; // تأكد من ��ضافة ال�� Model
use App\Models\Product; // تأكد من ��ضافة ال�� Model
use App\Models\ProductModel; // تأكد من ��ضافة ال�� Model
use App\Models\Make; // تأكد من ��ضافة ال�� Model
use App\Models\SubCategory; // تأكد من ��ضافة ال�� Model
use App\Models\Category; // تأكد من ��ضافة ال�� Model
use App\Models\OrderDet; // تأكد من ��ضافة ال�� Model

use App\Models\User; // تأكد من إضافة الـ Model

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::factory()->count(10)->create();
    }
}
