<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Voucher;

class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $voucher = [
            ['min_purchase' => 249, 'discount' => '50', 'coupon_code' => 'SALE50', 'start_date' => Carbon::now(), 'end_date' => Carbon::now()->addWeeks(1)],
            ['min_purchase' => 249, 'discount' => '60', 'coupon_code' => 'SALE60', 'start_date' => Carbon::now(), 'end_date' => Carbon::now()->addWeeks(1)],
            ['min_purchase' => 249, 'discount' => '70', 'coupon_code' => 'SALE70', 'start_date' => Carbon::now(), 'end_date' => Carbon::now()->addWeeks(1)],
        ];
  
        foreach ($voucher as $key => $value) {
            $Voucher_added = Voucher::where(['coupon_code' => $value['coupon_code']])->first();
            if(empty($Voucher_added)){
                Voucher::create($value);
            }
        }
    }
}
