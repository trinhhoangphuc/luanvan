<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banner;
use App\Sanpham;

class HomepageController extends Controller
{
    public function index()
    {
    	$bannerList = Banner::where("bn_trangThai", 1)->orderBy("bn_capNhat", "desc")->get();
    	$sanphammoiList = Sanpham::where("sp_tinhTrang", 1)->orderBy("sp_capNhat", "desc")->limit(8)->get();
    	return view('customer.index', compact("bannerList", "sanphammoiList"));
    }
}
