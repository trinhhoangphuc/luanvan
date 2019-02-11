<?php

use Illuminate\Database\Seeder;

class ThanhtoanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = [];
    	$thanhtoan = ['Paypal','COD', "Chuyển khoản"];
    	for($i=0; $i<=2; $i++){
    		array_push($list,[
    			'tt_ten' => $thanhtoan[$i],
    			'tt_trangThai' => 1
    		]);
    	}
    	DB::table('thanhtoan')->insert($list);
    }
}
