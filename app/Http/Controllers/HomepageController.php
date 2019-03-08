<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Support\MessageBag;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Banner, App\Sanpham, App\Hinhanh, App\Huongvi, App\Chitiethuong, App\Danhgia, App\Loai, App\Hang, App\Khachhang, DB, Session;

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

   public function postLogin(Request $request)
   {
   		try{

    		$khachhang = Khachhang::where("kh_email", $request->get('emailLogin'))->where("kh_matKhau", md5($request->get('passLogin')))->where("kh_trangThai", 1)->first();
    		if($khachhang){
    			Session::put("customer_id", $khachhang->kh_ma);
    			Session::put("customer_name", $khachhang->kh_hoTen);
    			Session::put("customer_img", $khachhang->kh_hinh);
	    		return response(["error"=>false, "message"=>true], 200);
	    	}else return response(["error"=>false, "message"=>false], 200);

    	}catch(QueryException $ex){
    		return response(["error"=>true, "message"=>$ex->getMessage()], 200);
    	}catch(PDOException $ex){
    		return response(["error"=>true, "message"=>$ex->getMessage()], 200);
    	}
   }

   public function getLogout()
   {
   		try{
    		if(Session::has("customer_id")){
    			Session::forget("customer_id");
    			Session::forget("customer_name");
    			Session::forget("customer_img");
	    		return response(["error"=>false, "message"=>true], 200);
	    	}else return;
    	}catch(QueryException $ex){
    		return response(["error"=>true, "message"=>$ex->getMessage()], 200);
    	}catch(PDOException $ex){
    		return response(["error"=>true, "message"=>$ex->getMessage()], 200);
    	}
   }

   public function postRegister(Request $request)
    {
        try {
            $rule = [
                "email" => "unique:khachhang,kh_email",
                "phone" => "unique:khachhang,kh_dienThoai",
            ];
            $message = [
                "email.unique" => "Email đã được sử dụng!",
                "phone.unique" => "Số điện thoại đã được sử dụng",   
            ];
            $validator = Validator::make($request->all(), $rule, $message);
            if($validator->fails()){
                return response()->json(['error'=>true, 'message'=>$validator->errors()]);
            }else{
            	
            	$khachhang               = new Khachhang();
            	$khachhang->kh_matKhau   = md5($request->get('pass'));
            	$khachhang->kh_hoTen     = $request->get('name');
            	$khachhang->kh_hinh   = "user.png";
            	$khachhang->kh_gioiTinh  = $request->get('gender');
            	$khachhang->kh_email     = $request->get('email');
            	$khachhang->kh_diaChi    = $request->get('address');
            	$khachhang->kh_dienThoai = $request->get('phone');
            	$khachhang->kh_trangThai = 1;
            	
            	if($khachhang->save())
            	{
                    return response(['error'=>false, 'message_2'=>true], 200);
            	}
            }

        } catch (QueryException $ex) {
            return response(["error"=>true, "message"=>$ex->getMessage()], 200);
        } catch (PDOException $ex) {
            return response(["error"=>true, "message"=>$ex->getMessage()], 200);
        }
    }

    public function postRate(Request $request, $id)
    {
    	if(Session::has("customer_id")){
    		$danhgia = new Danhgia();
    		$danhgia->dg_sao = $request->get('rate');
    		$danhgia->dg_noiDung = $request->get('noiDung');
    		$danhgia->sp_ma = $id;
    		$danhgia->kh_ma = Session::get("customer_id");
    		if($danhgia->save()){   
    			$sanpham = Sanpham::where("sp_ma", $danhgia->sp_ma)->first();
    			$star = Danhgia::where("sp_ma", $danhgia->sp_ma)->where("dg_sao", ">", 0)->where("dg_trangThai", 1)->avg("dg_sao");
    			
    			if($star){
    				$star = round($star);
    				$sanpham->sp_danhGia = $star;
    			}else $sanpham->sp_danhGia = 0;

    			$sanpham->save();
    			return redirect()->back();
    		}else{
    			return redirect()->back();
    		}
    	}else{
    		return redirect()->back();
    	}

    }

}
