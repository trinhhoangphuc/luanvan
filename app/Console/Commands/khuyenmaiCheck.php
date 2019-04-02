<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use App\Sanpham;

class khuyenmaiCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'km:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $khuyenmai=DB::select(" SELECT * FROM khuyenmai WHERE km_ketThuc < NOW() AND km_trangThai = 1 ");
        foreach ($khuyenmai as $key) {
            $sanpham=Sanpham::select("sanpham.*")->join("chitietkhuyenmai", "chitietkhuyenmai.sp_ma", "sanpham.sp_ma")
                ->where("chitietkhuyenmai.km_ma", $key->km_ma)->get();
            foreach ($sanpham as $key_2) {
                $key_2->sp_giamGia=0;
                $key_2->save();
            }
            $khuyenmai=DB::table("khuyenmai")->where("km_ma", $key->km_ma)->update(['km_trangThai' => 0]);
        }
    }
}
