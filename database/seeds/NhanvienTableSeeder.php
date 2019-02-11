<?php

use Illuminate\Database\Seeder;

class NhanvienTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker\Factory::create('vi-VN');
        $list = [];
    	for($i=1; $i<=10; $i++){
    		array_push($list,[
    			'nv_email' => "nvien".$i."@gmail.com",
    			'nv_matKhau' => md5("123456"),
    			'nv_hoTen' => "Nhân viên".$i,
    			'nv_gioiTinh' => $faker->numberBetween(0, 1),
    			'nv_ngaySinh' => "2018-11-10",
    			'nv_diaChi' => $faker->text(10),
    			'nv_dienThoai' => $faker->numberBetween(12345, 67894),
    			'cv_ma' => $faker->numberBetween(1, 4),
    			'nv_trangThai' => 1,
    		]);
    	}
    	DB::table('nhanvien')->insert($list);
    }
}
