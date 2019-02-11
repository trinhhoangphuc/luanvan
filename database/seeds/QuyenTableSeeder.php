<?php

use Illuminate\Database\Seeder;

class QuyenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = [];
    	$chucvu = ["Quản lý sản phâm", "Quản lý loại", "Quản lý thanh toan", "Quản lý vận chuyển", "Quản lý nhà sản xuất", "Quản lý nhân viên", "Quản lý chức vụ", "Quản lý khách hàng","Quản lý đơn hàng", "Thống kê"];
    	for($i=0; $i<=9; $i++){
    		array_push($list,[
    			'q_ten' => $chucvu[$i],
    		]);
    	}
    	DB::table('quyen')->insert($list);
    }
}
