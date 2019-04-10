<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Support\MessageBag;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\PHPImageWorkshop\ImageWorkshop;
use App\Banner, App\Sanpham, App\Hinhanh, App\Huongvi, App\Chitiethuong, App\Danhgia, App\Loai, App\Hang, App\Khachhang, App\Donhang, App\Nhap, App\Vanchuyen, App\Thanhtoan, App\Chitiethoadon, App\Khuyenmai, App\Chitietkhuyenmai, App\Sanphamkhuyenmai, DB, Session, Cart;
use Carbon\Carbon;

class HomepageController extends Controller
{
    public function index()
    {
    	$bannerList = Banner::where("bn_trangThai", 1)->orderBy("bn_capNhat", "desc")->get();
    	$sanphammoiList = Sanpham::where("sp_tinhTrang", 1)->orderBy("sp_capNhat", "desc")->limit(8)->get();
        $sanphamKMList = Sanpham::where("sp_giamGia", ">", 0)->orderBy("sp_capNhat", "desc")->limit(8)->get();
    	$sanphambanchayList = DB::select('
    		SELECT *
	        FROM sanpham
	        WHERE sp_ma in ( SELECT b.sp_ma FROM nhap as b, chitiethoadon as a WHERE a.n_ma = b.n_ma GROUP BY b.sp_ma ORDER BY sum(a.ctdh_soluong * a.ctdh_donGia) DESC)
	        limit 0,8
    	');
    	return view('customer.index', compact("bannerList", "sanphammoiList", "sanphambanchayList", "sanphamKMList"));
    }

    public function getAllProductsToSearch($name)
   {
        try{

            $products = Sanpham::select("sp_ten", "sp_ma", "sp_hinh")
                ->where("sp_ten", "like", '%'.$name."%")
                ->where("sp_trangThai", 1)
                ->orderBy("sp_capNhat", "desc")
                ->get();
            $json = json_encode($products);
            return response(["error"=>false, "message"=>compact("products", "json")], 200);
           

        }catch(QueryException $ex){
            return response(["error"=>true, "message"=>$ex->getMessage()], 200);
        }catch(PDOException $ex){
            return response(["error"=>true, "message"=>$ex->getMessage()], 200);
        }
    }

    public function searchProduct($name)
   {

        $sanphamList = Sanpham::where("sp_ten", "like", '%'.$name."%")->where("sp_trangThai", 1)->orderBy("sp_capNhat", "desc")->paginate(12);

            return view("customer.timkiemsanpham", compact("sanphamList", "name"));

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

    	$sanpham = Sanpham::select("sanpham.*", "loai.l_ten", "hang.h_ten")
            ->join("loai", "loai.l_ma", "sanpham.l_ma")
            ->join("hang", "hang.h_ma", "sanpham.h_ma")
            ->where("sp_trangThai", 1)
            ->where("sp_ma", $id)
            ->first();

    	if($sanpham){

            if(Session::has("viewList")){
                foreach (Session::get("viewList") as $key => $value) {
                    if($value != $sanpham->sp_ma){
                        Session::push("viewList", $sanpham->sp_ma);
                        break;
                    }
                }
            }else{
                Session::push("viewList", $sanpham->sp_ma);
            }

    		// $chitiethuongList = Chitiethuong::select("chitiethuong.*", "huongvi.hv_ten")
      //           ->where("sp_ma", $sanpham->sp_ma)
      //           ->join("huongvi", "huongvi.hv_ma", "chitiethuong.hv_ma")
      //           ->get();
            $chitiethuongList = Nhap::select("huongvi.hv_ten", "huongvi.hv_ma")->distinct()
                   ->join("huongvi", "huongvi.hv_ma", "nhap.hv_ma")
                   ->join("sanpham", "sanpham.sp_ma", "nhap.sp_ma")
                   ->where("sanpham.sp_ma", $sanpham->sp_ma)->get();

    		$hinhanh = Hinhanh::where("sp_ma", $sanpham->sp_ma)->orderBy("ha_stt", "desc")->get();

    		$sanphamcungloaiList = Sanpham::where("l_ma", $sanpham->l_ma)
                ->where("sp_ma", "<>" ,$sanpham->sp_ma)
                ->where("sp_trangThai", 1)
                ->orderBy("sp_capNhat", "desc")
                ->limit(8)
                ->get();

    		$danhgiaList = Danhgia::where("dg_trangThai", 1)
                ->orderBy("dg_taoMoi", "desc")
                ->where("sp_ma", $sanpham->sp_ma)
                ->get();

            return view("customer.chitietsanpham", compact("sanpham", "hinhanh", "chitiethuongList", "sanphamcungloaiList", "danhgiaList"));
    		
    	}
    }

    public function getFilterProducts($maLoai, $maHang, $giaTu, $giaDen)
    {

      if($maLoai != 0 || $maHang != 0){
        if ($maLoai != 0 && $maHang == 0){
              $sanphamList = DB::table('sanpham')
                  ->where('sp_trangThai', 1)->where('l_ma', $maLoai)
                  ->whereBetween('sp_giaBan', [$giaTu, $giaDen])
                  ->orderBy('sp_capNhat', 'desc')
                  ->paginate(12);
        }elseif ($maHang != 0 && $maLoai == 0) {
              $sanphamList = DB::table('sanpham')
                  ->where('h_ma', $maHang)
                  ->whereBetween('sp_giaBan', [$giaTu, $giaDen])
                  ->where('sp_trangThai', 1)
                  ->orderBy('sp_capNhat', 'desc')
                  ->paginate(12);
        }else{
            $sanphamList = DB::table('sanpham')->whereBetween('sp_giaBan', [$giaTu, $giaDen])
                ->where('sp_trangThai', 1)
                ->where('l_ma', $maLoai)
                ->where('h_ma', $maHang)
                ->orderBy('sp_capNhat', 'desc')
                ->paginate(12);
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
                Session::put("customer_phone", $khachhang->kh_dienThoai);
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
                Session::forget("customer_phone");
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
           $khachhang->kh_hinh      = "user.png";
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

    public function postRegister_2(Request $request)
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
                    Session::put("customer_id", $khachhang->kh_ma);
                    Session::put("customer_name", $khachhang->kh_hoTen);
                    Session::put("customer_phone", $khachhang->kh_dienThoai);
                    Session::put("customer_img", $khachhang->kh_hinh);
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
    	
		$danhgia = new Danhgia();
		$danhgia->dg_sao = $request->get('rate');
		$danhgia->dg_noiDung = $request->get('noiDung');
		$danhgia->sp_ma = $id;
		$danhgia->kh_ten = $request->get('name');
        $danhgia->kh_dienThoai = $request->get('phone');
		if($danhgia->save()){   
			$sanpham = Sanpham::where("sp_ma", $danhgia->sp_ma)->first();
			$star = Danhgia::where("sp_ma", $danhgia->sp_ma)->where("dg_sao", ">", 0)->where("dg_trangThai", 1)->avg("dg_sao");
			
			if($star){
				$star = round($star);
				$sanpham->sp_danhGia = $star;
			}else $sanpham->sp_danhGia = 0;

			$sanpham->save();
			return redirect()->back()->with("success", "Cập nhật thành công giỏ hàng");
        }else{
            return redirect()->back()->with("error", "Sản phẩm không đủ số lượng!");
        }

    }

    public function getProfile()
    {
        if(Session::has("customer_id")){
            $khachhang = Khachhang::find(Session::get("customer_id"));
            $donhangList = Donhang::where("kh_ma", $khachhang->kh_ma)->orderBy("dh_taoMoi", "desc")->paginate(10);
            return view("customer.thongtincanhan", compact("khachhang", "donhangList"));
        }else{
            return redirect(route('homepage'));
        }
    }

    public function postProfile(Request $request)
    {
        if(Session::has("customer_id")){

            $khachhang               = Khachhang::where("kh_ma", Session::get("customer_id"))->first();
            $khachhang->kh_hoTen     = $request->get('name');
            $khachhang->kh_gioiTinh  = $request->get('gender');
            $khachhang->kh_diaChi    = $request->get('address');
            $khachhang->kh_dienThoai = $request->get('phone');

            if($request->hasFile('avtuser')){
                if($khachhang->kh_hinh != "user.png" && file_exists(public_path('images/avatar/customer/'.$khachhang->kh_hinh))){
                    unlink(public_path('images/avatar/customer/'.$khachhang->kh_hinh));
                }

                $file =  $request->file('avtuser');

                $dirImg  = __DIR__.'\..\..\..\public\images\avatar\customer\\';

                $src= ImageWorkshop::initFromPath($file->getRealPath());
                $src->resizeInPixel(300, 300, false);

                $createFolders = true;
                $backgroundColor = null; 
                $imageQuality = 80; 


                $destFileName = time()."_".$file->getClientOriginalName();

                $src->save($dirImg, $destFileName, $createFolders, $backgroundColor, $imageQuality);

                $khachhang->kh_hinh = $destFileName;
            }

            if($request->get("newPass") != "")
                $khachhang->kh_matKhau = md5($request->get("newPass"));

            if($khachhang->save()){
                Session::put("customer_name", $khachhang->kh_hoTen);
                Session::put("customer_img", $khachhang->kh_hinh);
                return redirect(route("profile"))->with("success", "Cập nhật thông tin thành công!");
            }else return redirect(route("profile"))->with("erro", "Cập nhật thông tin không thành công!");

        }else return redirect(route('homepage'));
    }

    public function addToCart($id){
        $sanpham = Sanpham::where("sp_ma", $id)->first();
        if($sanpham){
            $nhap = Nhap::select("nhap.*", "huongvi.hv_ten")
                ->join("huongvi", "huongvi.hv_ma", "nhap.hv_ma")
                ->where("sp_ma", $id)
                ->where('n_soLuong', ">", 0)
                ->orderBy("n_hanSD", "asc")
                ->first();
            if($nhap){
                if($sanpham->sp_giamGia > 0) 
                    $price = $sanpham->sp_giamGia;
                else 
                    $price = $sanpham->sp_giaBan;

                Cart::add(array(
                    'id'=>$nhap->n_ma, 
                    'name'=>$sanpham->sp_ten, 
                    'qty'=>1, 'price'=>$price, 
                    'options' => array(
                        'img' => $sanpham->sp_hinh, 
                        'sp_ma'=>$sanpham->sp_ma, 
                        'price_2'=>$sanpham->sp_giaBan,
                        'discount'=>$sanpham->sp_giamGia, 
                        "taste"=>$nhap->hv_ten)
                    ));
                return response(['error'=>false, "message"=>true], 200);
            }else 
                return response(["error"=>false, "message"=>false], 200);
            
        }
    }

     public function addToCart_2($id, $qty, $mahuong){
        $sanpham = Sanpham::where("sp_ma", $id)->first();
        if($sanpham){
            $nhap = Nhap::select("nhap.*", "huongvi.hv_ten")
                ->join("huongvi", "huongvi.hv_ma", "nhap.hv_ma")
                ->where("sp_ma", $id)->where("nhap.hv_ma", $mahuong)
                ->where('n_soLuong', ">=", $qty)
                ->orderBy("n_hanSD", "asc")
                ->first();
            if($nhap){
                if($sanpham->sp_giamGia > 0) $price = $sanpham->sp_giamGia;
                else  $price = $sanpham->sp_giaBan;

                Cart::add(array(
                    'id'=>$nhap->n_ma, 
                    'name'=>$sanpham->sp_ten, 
                    'qty'=>$qty, 'price'=>$price, 
                    'options' => array(
                        'img' => $sanpham->sp_hinh, 
                        'sp_ma'=>$sanpham->sp_ma, 
                        'price_2'=>$sanpham->sp_giaBan,
                        'discount'=>$sanpham->sp_giamGia, 
                        "taste"=>$nhap->hv_ten,
                    )
                ));
                return response(['error'=>false, "message"=>true], 200);
            }else 
                return response(["error"=>false, "message"=>false], 200);
            
        }
    }

    public function getQualityCart(){
        $cart = count(Cart::content());
        return response(["error"=>false, "message"=>compact("cart")], 200);
    }

    public function getCart(){
        $cart = Cart::content();
        $total =Cart::subtotal(2,'.','');

        if(Session::has('viewList')){
            $sanphamdaxem = Sanpham::where("sp_tinhTrang", 1)->whereIn("sp_ma", Session::get('viewList'))->orderBy("sp_capNhat", "desc")->limit(8)->get();
        }else $sanphamdaxem = null;

        return view("customer.giohang", compact("cart", "total", "sanphamdaxem"));
    }

    public function detroyCart(){
        Cart::destroy();
    }

    public function updateCart(Request $request, $id){
        foreach (Cart::content() as $key){
            if($key->id == $id){
                $nhap = Nhap::where("n_ma", $id)->first();
                if($nhap->n_soLuong >= $request->qty){
                    Cart::update($key->rowId, ['qty' => $request->qty]);
                    return redirect()->back()->with("success", "Cập nhật thành công giỏ hàng");
                }else{
                    return redirect()->back()->with("error", "Sản phẩm không đủ số lượng!");
                }
                break;
            }
        }
        return redirect()->back();
    }

    public function deleteCart($id){
        foreach (Cart::content() as $key){
            if($key->id == $id){
                Cart::remove($key->rowId);
                break;
            }
        }
        return redirect()->back();
    }

    public function loginToPay(){
        if(count(Cart::content()) > 0){
            if(!Session::has("customer_id")){
                $cart = Cart::content();
                $total =Cart::subtotal(2,'.','');
                return view("customer.dangnhapdangky", compact("cart", "total"));
            }else return redirect(route('payment'));
        }else return redirect(route('getCart'));
    }

    public function payment(){
        if(count(Cart::content()) > 0){
            if(Session::has("customer_id")){
                $khachhang = Khachhang::find(Session::get('customer_id'));
                $vanchuyenList = Vanchuyen::where("vc_trangThai", 1)->get();
                $thanhtoanList = Thanhtoan::where("tt_trangThai", 1)->get();
                $cart = Cart::content();
                $total =Cart::subtotal(2,'.','');
                return view("customer.thanhtoan", compact("cart", "total", "khachhang", "vanchuyenList", "thanhtoanList"));
            }else return redirect(route('loginToPay'));
            
        }else return redirect(route('getCart'));
    }

    public function postpayment(Request $request){
        if(count(Cart::content()) > 0){
            if(Session::has("customer_id")){
                
                $vanchuyen = Vanchuyen::where("vc_ma", $request->transport)->first();
                $donhang = new Donhang();
                $donhang->kh_ma = Session::get("customer_id");

                if($request->name == "" || $request->address == "" || $request->phone == ""){
                    $khachhang = Khachhang::find(Session::get('customer_id'));
                    $donhang->dh_nguoiNhan = $khachhang->kh_hoTen;
                    $donhang->dh_diaChi = $khachhang->kh_diaChi;
                    $donhang->dh_dienThoai = $khachhang->kh_dienThoai;
                }else{
                    $donhang->dh_nguoiNhan = $request->name;
                    $donhang->dh_diaChi = $request->address;
                    $donhang->dh_dienThoai = $request->phone;
                }
                
                $donhang->tt_ma = $request->payment;
                $donhang->vc_ma = $request->transport;
                $donhang->vc_gia = $vanchuyen->vc_gia;

                if($request->payment == 1)
                    $donhang->dh_daThanhToan = 1;
                else
                    $donhang->dh_daThanhToan = 0;

                $donhang->dh_trangThai = 0;
                $tong = 0;
                if($donhang->save()){
                    foreach (Cart::content() as $key) {

                        $chitiethoadon = new Chitiethoadon();
                        $chitiethoadon->dh_ma = $donhang->dh_ma;
                        $chitiethoadon->n_ma = $key->id;
                        $chitiethoadon->ctdh_soluong = $key->qty;
                        if($key->options->discount > 0){
                            $chitiethoadon->ctdh_donGia = $key->options->discount;
                            $tong += $key->qty * $key->options->discount;
                        }
                        else{
                            $chitiethoadon->ctdh_donGia = $key->options->price_2;
                            $tong += $key->qty * $key->options->price_2;
                        }
                        
                        
                        if($chitiethoadon->save()){
                            $nhap = Nhap::find($key->id);
                            $nhap->n_soLuong = $nhap->n_soLuong - $key->qty;
                            $nhap->save();  

                            $sanpham = Sanpham::find($key->options->sp_ma);
                            $sanpham->sp_soLuong = $sanpham->sp_soLuong - $key->qty;
                            $sanpham->save();  
                        }

                    }       
                    $donhang->dh_tongTien = $tong + $donhang->vc_gia;
                    if($donhang->save()){
                        Cart::destroy();
                        if($request->payment == 1)
                            return response(['error'=>false, "message"=>$donhang->dh_ma], 200);
                        else
                            return redirect(route('paymentSucess', $donhang->dh_ma));
                    } 
                }
            
            }
        }
    }

    public function orderDetail($id){

        if(Session::has("customer_id")){

            $donhang = Donhang::select("donhang.*", "vanchuyen.vc_ten", "thanhtoan.tt_ten")
                ->join("vanchuyen", "vanchuyen.vc_ma", "donhang.vc_ma")
                ->join("thanhtoan", "thanhtoan.tt_ma", "donhang.tt_ma")
                ->where("dh_ma", $id)
                ->first();

            if($donhang){

                $khachhang = Khachhang::find(Session::get('customer_id'));

                $chitiethoadon = DB::table("chitiethoadon")
                    ->select("chitiethoadon.*", "sanpham.sp_ten as sp_ten", "sanpham.sp_ma","sanpham.sp_hinh as sp_hinh", "huongvi.hv_ten")
                    ->join("nhap", "nhap.n_ma", "chitiethoadon.n_ma")
                    ->join("sanpham", "sanpham.sp_ma", "nhap.sp_ma")
                    ->join("huongvi", "huongvi.hv_ma", "nhap.hv_ma")
                    ->where("chitiethoadon.dh_ma", $id)->get();

                return view("customer.chitietdonhang", compact("donhang", "chitiethoadon", "khachhang"));
            }else return redirect(route('error404'));
            
            
        }else return redirect(route('homepage'));
            
    }

    public function paymentSuccess($id){

        if(Session::has("customer_id")){

            $donhang = Donhang::select("donhang.*", "vanchuyen.vc_ten", "thanhtoan.tt_ten")
            ->join("vanchuyen", "vanchuyen.vc_ma", "donhang.vc_ma")
            ->join("thanhtoan", "thanhtoan.tt_ma", "donhang.tt_ma")
            ->where("dh_ma", $id)
            ->first();

            if($donhang){

                $khachhang = Khachhang::find(Session::get('customer_id'));

                $chitiethoadon = DB::table("chitiethoadon")
                    ->select("chitiethoadon.*", "sanpham.sp_ten", "sanpham.sp_hinh", "sanpham.sp_ma", "huongvi.hv_ten")
                    ->join("nhap", "nhap.n_ma", "chitiethoadon.n_ma")
                    ->join("sanpham", "sanpham.sp_ma", "nhap.sp_ma")
                    ->join("huongvi", "huongvi.hv_ma", "nhap.hv_ma")
                    ->where("chitiethoadon.dh_ma", $id)->get();

                return view("customer.thanhtoanthanhcong", compact("donhang", "chitiethoadon", "khachhang"));
            }else return redirect(route('error404'));

            
        }else return redirect(route('homepage'));
            
    }
}
