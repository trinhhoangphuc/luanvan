<?php

namespace App\Http\Controllers;

use App\Khachhang;
use Illuminate\Database\QueryException;
use DB;
use Illuminate\Http\Request;
use Mail;
use Validator;
use Illuminate\Support\MessageBag;


class KhachhangController extends Controller
{
    public function index() //Load danh sách nhân viên
    {
        try {
            
            $khachhang = Khachhang::orderBy("kh_capNhat", "desc")->get();
            $json = json_encode($khachhang);
            return response(["error"=>true, "message"=>compact("khachhang", "json")], 200);

        } catch (QueryException $ex) {
            return response(["error"=>true, "message"=>$ex->getMessage()], 200);
        } catch (PDOException $ex) {
            return response(["error"=>true, "message"=>$ex->getMessage()], 200);
        }
    }

    public function store(Request $request)
    {
        try {
            $rule = [
                "email" => "unique:khachhang,kh_email",
                "dienthoai" => "unique:khachhang,kh_dienThoai",
            ];
            $message = [
                "email.unique" => "Email đã được sử dụng!",
                "dienthoai.unique" => "Số điện thoại đã được sử dụng",   
            ];
            $validator = Validator::make($request->all(), $rule, $message);
            if($validator->fails()){
                return response()->json(['error'=>true, 'message'=>$validator->errors()]);
            }else{
            	$str = '';
            	$str = md5(rand());
            	$matkhau = substr($str, 0, 6);
            	$khachhang               = new Khachhang();
            	$khachhang->kh_matKhau   = md5($matkhau);
            	$khachhang->kh_hoTen     = $request->ten;
            	$khachhang->kh_gioiTinh  = $request->gioitinh;
            	$khachhang->kh_email     = $request->email;
            	$khachhang->kh_diaChi    = $request->diachi;
            	$khachhang->kh_dienThoai = $request->dienthoai;
            	$khachhang->kh_trangThai = 1;
            	
            	if($khachhang->save())
            	{

	            	$data = [
	            		'hoTen' => $khachhang->kh_hoTen,
	            		'matKhau' => $matkhau,
	            		'email' => $khachhang->kh_email 
	            	];
	            	Mail::send('mail.createAccount', $data, function($message) use ($khachhang){
	            		$message->from('webredshop@gmail.com', 'RedShop.vn')
	            		->to($khachhang->kh_email)->subject('[RedShop.vn] Đăng ký thành viên');
	            	});

	            	$khachhang = Khachhang::where('kh_ma', $khachhang->kh_ma)->first();
                    $json = json_encode($khachhang);
                    return response(['error'=>false, 'message'=>compact('khachhang', 'json')], 200);
            	}
            }

        } catch (QueryException $ex) {
            return response(["error"=>true, "message"=>$ex->getMessage()], 200);
        } catch (PDOException $ex) {
            return response(["error"=>true, "message"=>$ex->getMessage()], 200);
        }
    }

    public function update(Request $request, $id) // cập nhât vận chuyển
    {
        try{

            $khachhang = Khachhang::where('kh_ma', $id)->first();
            if($khachhang){
                if($khachhang->kh_email != $request->get('email')){

                    $rule = [ "email" => "unique:khachhang,kh_email", ];
                    $message = [ "email.unique" => "Email đã được sử dụng!", ];
                    $validator = Validator::make($request->all(), $rule, $message);
                    if($validator->fails()){
                        return response()->json(['error'=>true, 'message'=>$validator->errors()]);
                    }else
                        $khachhang->kh_email = $request->get('email');

                }
                if ($khachhang->kh_dienThoai != $request->get('dienthoai')) {

                    $rule = ["dienthoai" => "unique:khachhang,kh_dienThoai",];
                    $message = [ "dienthoai.unique" => "Số điện thoại đã được sử dụng",  ];
                    $validator = Validator::make($request->all(), $rule, $message);
                    if($validator->fails()){
                        return response()->json(['error'=>true, 'message'=>$validator->errors()]);
                    }else
                         $khachhang->kh_dienThoai =  $request->get('dienthoai');
                }
                 
                $khachhang->kh_hoTen     =   $request->get('ten');
                $khachhang->kh_gioiTinh  =   $request->get('gioitinh');
                $khachhang->kh_diaChi    =   $request->get('diachi');
                $khachhang->kh_trangThai =   $request->get('trangThai');
               
                if($khachhang->save()){
                    $khachhang = Khachhang::where('kh_ma', $khachhang->kh_ma)->first();
                    $json = json_encode($khachhang);
                    return response(['error'=>false, 'message'=>compact('khachhang', 'json')], 200);
               }
            }
  
        }catch(QueryException $ex){
            return response(['error'=>true, 'message'=>$ex->getMessage()], 200);
        }catch(PDOException $ex){
            return response(['error'=>true, 'message'=>$ex->getMessage()], 200);
        }
    }

    public function updatePassword(Request $request, $id)
    {
       try{

            $khachhang = Khachhang::where('kh_ma', $id)->first();
            if($khachhang){

                $str = '';
                $str = md5(rand());
                $matkhau = substr($str, 0, 6);
                $khachhang->kh_matKhau = md5($matkhau);

                if($khachhang->save()){

                    $data = [
                        'hoTen' => $khachhang->kh_hoTen,
                        'matKhau' => $matkhau,
                    ];
                    Mail::send('mail.newPass', $data, function($message) use ($khachhang){
                        $message->from('webredshop@gmail.com', 'RedShop.vn')
                        ->to($khachhang->kh_email)->subject('[RedShop.vn] Cấp lại mật khẩu');
                    });

                    $khachhang = Khachhang::where('kh_ma', $khachhang->kh_ma)->first();
                    $json = json_encode($khachhang);
                    return response(['error'=>false, 'message'=>compact('khachhang', 'json')], 200);
               }
            }
  
        }catch(QueryException $ex){
            return response(['error'=>true, 'message'=>$ex->getMessage()], 200);
        }catch(PDOException $ex){
            return response(['error'=>true, 'message'=>$ex->getMessage()], 200);
        }
    }

    public function destroy($id) // xóa thanh toans
    {
        try{

            $khachhang = Khachhang::where('kh_ma', $id)->first();
            if($khachhang){

                if($khachhang->delete())
                    return response(['error'=>false, 'message'=>true], 200);
                else
                    return response(['error'=>false, 'message'=>false], 200);
            }       
        }catch(QueryException $ex){
            return response(['error'=>true, 'message'=>$ex->getMessage()], 200);
        }catch(PDOException $ex){
            return response(['error'=>true, 'message'=>$ex->getMessage()], 200);
        }
    }

    public function destroyAll(Request $request)
    {
        try {
           
            if(Khachhang::destroy($request->items))
                return response(['error'=>false, 'message'=>true], 200);
            else
                return response(['error'=>false, 'message'=>false], 200);

         }catch(QueryException $ex){
            return response(['error'=>true, 'message'=>$ex->getMessage()], 200);
        }catch(PDOException $ex){
            return response(['error'=>true, 'message'=>$ex->getMessage()], 200);
        }
    }
}
