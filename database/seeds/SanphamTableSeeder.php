<?php

use Illuminate\Database\Seeder;

class SanphamTableSeeder extends Seeder
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
        	$giaGoc = $faker->numberBetween(100000, 99999999);
        	$giaBan = $faker->numberBetween($giaGoc, $giaGoc+200);
        	array_push($list, [
        		'sp_ma'           => $i,
        		'sp_ten'          => $faker->text(20),
        		'sp_giaBan'       => $giaGoc,
        		'sp_giamGia'      => $giaBan,
        		'sp_hinh'         => "img".$i.".jpg",
        		'sp_thongTin'     => $faker->text(50),
        		'sp_danhGia'      => '4',
                'sp_soLuong'      => $faker->numberBetween(10, 100),
                'sp_tinhTrang'    => 1,
                'sp_trangThai'    => 1,
        		'l_ma'            => $faker->numberBetween(1,7),
        		'h_ma'            => $faker->numberBetween(1,7)
        	]);
        }
        DB::table('sanpham')->insert($list);
    }
}
