<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banner;
use App\Sanpham;
use App\Hinhanh;
use App\Huongvi;
use App\Chitiethuong;
use App\Danhgia;
use App\Loai;
use App\Hang;
use DB;
class HomepageController extends Controller
{
    public function index()
    {
    	$bannerList = Banner::where("bn_trangThai", 1)->orderBy("bn_capNhat", "desc")->get();
    	$sanphammoiList = Sanpham::where("sp_tinhTrang", 1)->orderBy("sp_capNhat", "desc")->limit(8)->get();
    	$sanphambanchayList = DB::select('
    		SELECT *
	        FROM sanpham
	        WHERE sp_ma in ( SELECT b.sp_ma FROM sanpham as b, chitiethoadon as a WHERE a.sp_ma = b.sp_ma GROUP BY b.sp_ma ORDER BY sum(a.ctdh_soluong * a.ctdh_donGia) DESC)
	        limit 0,8
    	');
    	return view('customer.index', compact("bannerList", "sanphammoiList", "sanphambanchayList"));
    }

    public function getAllProducts(){
    	$sanphamList = Sanpham::where("sp_trangThai", 1)->orderBy("sp_capNhat", "desc")->paginate(12);
    	return view('customer.tatcasanpham', compact("sanphamList"));
    }

    public function getProductsByIdLoai($id){
    	$loai = Loai::where("l_trangThai", 1)->where("l_ma", $id)->first();
    	if($loai){
    		$sanphamList = Sanpham::where("l_ma", $id)->where("sp_trangThai", 1)->orderBy("sp_capNhat", "desc")->paginate(12);
    		return view('customer.sanphamtheodanhmuc', compact("sanphamList", "loai"));
    	}else{
    		return redirect(route('error404'));
    	}
    	
    }

     public function getProductsByIdNSX($id){
    	$nsx = Hang::where("h_trangThai", 1)->where("h_ma", $id)->first();
    	if($nsx){
    		$sanphamList = Sanpham::where("h_ma", $id)->where("sp_trangThai", 1)->orderBy("sp_capNhat", "desc")->paginate(12);
    		return view('customer.sanphamtheonsx', compact("sanphamList", "nsx"));
    	}else{
    		return redirect(route('error404'));
    	}
    	
    }

    public function getProductDetail($id)
    {
    	$sanpham = Sanpham::select("sanpham.*", "loai.l_ten", "hang.h_ten")->join("loai", "loai.l_ma", "sanpham.l_ma")->join("hang", "hang.h_ma", "sanpham.h_ma")->where("sp_trangThai", 1)->where("sp_ma", $id)->first();

    	if($sanpham){

    		$chitiethuongList = Chitiethuong::select("chitiethuong.*", "huongvi.hv_ten")->where("sp_ma", $sanpham->sp_ma)->join("huongvi", "huongvi.hv_ma", "chitiethuong.hv_ma")->get();

    		$hinhanh = Hinhanh::where("sp_ma", $sanpham->sp_ma)->get();

    		$sanphamcungloaiList = Sanpham::where("l_ma", $sanpham->l_ma)->where("sp_ma", "<>" ,$sanpham->sp_ma)->where("sp_trangThai", 1)->orderBy("sp_capNhat", "desc")->limit(8)->get();

    		$danhgiaList = Danhgia::select("danhgia.*", "khachhang.kh_hinh")->join("khachhang", "khachhang.kh_ma", "danhgia.kh_ma")->where("danhgia.dg_trangThai", 1)->orderBy("dg_taoMoi", "desc")->where("sp_ma", $sanpham->sp_ma)->get();

    		return view("customer.chitietsanpham", compact("sanpham", "hinhanh", "chitiethuongList", "sanphamcungloaiList", "danhgiaList"));
    	}
    }

    public function getFilterProducts($maLoai, $maHang, $giaTu, $giaDen){

      if($maLoai != 0 || $maHang != 0){
        if ($maLoai != 0 && $maHang == 0){
          $sanphamList = DB::table('sanpham')->where('sp_trangThai', 1)->where('l_ma', $maLoai)->whereBetween('sp_giaBan', [$giaTu, $giaDen])->orderBy('sp_capNhat', 'desc')->paginate(12);
        }elseif ($maHang != 0 && $maLoai == 0) {
          $sanphamList = DB::table('sanpham')->where('h_ma', $maHang)->whereBetween('sp_giaBan', [$giaTu, $giaDen])->where('sp_trangThai', 1)->orderBy('sp_capNhat', 'desc')->paginate(12);
        }else{
          $sanphamList = DB::table('sanpham')->whereBetween('sp_giaBan', [$giaTu, $giaDen])->where('sp_trangThai', 1)->where('l_ma', $maLoai)->where('h_ma', $maHang)->orderBy('sp_capNhat', 'desc')->paginate(12);
        }
      }elseif($maLoai == 0 && $maHang == 0){
        $sanphamList = DB::table('sanpham')->whereBetween('sp_giaBan', [$giaTu, $giaDen])->orderBy('sp_capNhat', 'desc')->paginate(12);
      }

      if($sanphamList) 
        return view('customer.locsanpham', compact("sanphamList"));
      else
        return redirect(route('error404'));

   }
}
