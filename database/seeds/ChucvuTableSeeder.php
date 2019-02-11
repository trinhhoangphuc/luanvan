<?php

use Illuminate\Database\Seeder;

class ChucvuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = [];
    	$chucvu = ['Admin','Bán hàng', "Kế toán", "Nhập liệu"];
    	for($i=0; $i<=3; $i++){
    		array_push($list,[
    			'cv_ten' => $chucvu[$i],
    			'cv_trangThai' => 1,
    		]);
    	}
    	DB::table('chucvu')->insert($list);
    }
}
