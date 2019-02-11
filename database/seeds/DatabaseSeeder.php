<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LoaiTableSeeder::class);
        $this->call(ThanhtoanTableSeeder::class);
        $this->call(VanchuyenTableSeeder::class);
        $this->call(HangTableSeeder::class);
        $this->call(ChucvuTableSeeder::class);
        $this->call(NhanvienTableSeeder::class);
        $this->call(SanphamTableSeeder::class);
        $this->call(QuyenTableSeeder::class);
    }
}
