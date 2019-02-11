<?php

use Illuminate\Database\Seeder;

class LoaiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$list = [];
    	$loai = ['Tăng cân', 'Tăng cơ', 'Tăng sức mạnh', 'Trong lúc tập', 'BCAA', 'Vitamin', 'Phụ kiện'];
    	for($i=0; $i<=6; $i++){
    		array_push($list,[
    			'l_ten' => $loai[$i],
    			'l_trangThai' => 1
    		]);
    	}
    	DB::table('loai')->insert($list);
    }
}
