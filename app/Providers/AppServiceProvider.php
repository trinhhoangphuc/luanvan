<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer("layouts.customer.header", function($view){
            $loaiList = DB::table("loai")->where("l_trangThai", 1)->orderBy("l_capNhat", "desc")->get();
            $nhasanxuatList = DB::table("hang")->where("h_trangThai", 1)->orderBy("h_capNhat", "desc")->get();
            $view->with(["loaiList"=>$loaiList, "nhasanxuatList"=>$nhasanxuatList]);
        });

        view()->composer("layouts.customer.footer", function($view){
            $loaiList = DB::table("loai")->where("l_trangThai", 1)->orderBy("l_capNhat", "desc")->get();
            $nhasanxuatList = DB::table("hang")->where("h_trangThai", 1)->orderBy("h_capNhat", "desc")->get();
            $view->with(["loaiList"=>$loaiList, "nhasanxuatList"=>$nhasanxuatList]);
        });

        view()->composer("layouts.customer.menu-left", function($view){

            $loaiList = DB::table("loai")->where("l_trangThai", 1)->orderBy("l_capNhat", "desc")->get();
            $nhasanxuatList = DB::table("hang")->where("h_trangThai", 1)->orderBy("h_capNhat", "desc")->get();

            $min = DB::table("Sanpham")->min("sp_giaBan");
            $max = DB::table("Sanpham")->max("sp_giaBan");

            $sanphamAutoList = DB::table('sanpham')->where("sp_tinhTrang", 1)->where("sp_trangThai", 1)->orderBy(DB::raw('RAND()'))->take(2)->get();

            $view->with(["loaiList"=>$loaiList, "nhasanxuatList"=>$nhasanxuatList, "min"=>$min, "max"=>$max, "sanphamAutoList"=>$sanphamAutoList]);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
