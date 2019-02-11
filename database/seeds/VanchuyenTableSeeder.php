<?php

use Illuminate\Database\Seeder;

class VanchuyenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
 		$list = [];
    	$vanchuyen = ['SupperShip','ViettelPost', "Giao hàng nhanh"];
    	for($i=0; $i<=2; $i++){
    		array_push($list,[
    			'vc_ten' => $vanchuyen[$i],
    			'vc_trangThai' => 1,
    			'vc_gia' => 1,
    		]);
    	}
    	DB::table('vanchuyen')->insert($list);
    }
}
