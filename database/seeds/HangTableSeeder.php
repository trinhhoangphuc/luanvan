<?php

use Illuminate\Database\Seeder;

class HangTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = [];
    	$hang = ['Dymatize', 'Musclepharm', 'MyProtein', 'Labzada', 'MuscelTech', 'Optimum Nutrition', 'BPI'];
    	for($i=0; $i<=6; $i++){
    		array_push($list,[
    			'h_ten' => $hang[$i],
    			'h_trangThai' => 1
    		]);
    	}
    	DB::table('hang')->insert($list);
    }
}
