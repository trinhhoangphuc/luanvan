<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sanpham;
use App\Chitiethuong;
use App\Hinhanh;
use Illuminate\Database\QueryException;
use Validator;
use Illuminate\Support\MessageBag;

class SanphamController extends Controller
{
   public function index() //load danh sách
    {
    	try{

    		$sanpham = Sanpham::orderBy("sp_capNhat", "desc")->get();
    		$json = json_encode($sanpham);
    		return response(["error"=>false, "message"=>compact('sanpham', "json")], 200);

    	}catch(QueryException $ex){
    		return response(["error"=>true, "message"=>$ex->getMessage()], 200);
    	}catch(PDOException $ex){
    		return response(["error"=>true, "message"=>$ex->getMessage()], 200);
    	}
    }

    public function checkExistName($name) // kiểm tra trùng tên
    {
    	try{

    		$sanpham = Sanpham::where("sp_ten", $name)->first();
    		if($sanpham)
                return response(['error'=>false, 'message'=>true], 200);
            else
                return response(['error'=>false, 'message'=>false], 200);

    	}catch(QueryException $ex){
    		return response(["error"=>true, "message"=>$ex->getMessage()], 200);
    	}catch(PDOException $ex){
    		return response(["error"=>true, "message"=>$ex->getMessage()], 200);
    	}
    }

    public function store(Request $request)
    {
    	try{

            $rule = [
                "ten" => "unique:sanpham,sp_ten",
            ];
            $message = [
                "ten.unique" => "Tên sản phẩm đã tồn tại",      
            ];
            $validator = Validator::make($request->all(), $rule, $message);
            if($validator->fails()){
                return response()->json(['error'=>true, 'message'=>$validator->errors()]);
            }else{
              $sanpham = new Sanpham();
              $sanpham->sp_ten = $request->ten;
              $sanpham->l_ma = $request->maLoai;
              $sanpham->h_ma = $request->maHang;
              $sanpham->sp_hinh = "noimage.jpg";
              $sanpham->sp_giaBan = $request->gia;
              $sanpham->sp_giamGia = $request->giamGia;
              $sanpham->sp_soLuong = 0;
              $sanpham->sp_thongTin = $request->thongTin;
              $sanpham->sp_danhGia = 0;
              $sanpham->sp_trangThai = $request->trangThai;



              if($sanpham->save()){
                 $sanpham = Sanpham::where('sp_ma', $sanpham->sp_ma)->first();
                for ($i=0; $i < count($request->maHuong) ; $i++) { 
                    
                }

                foreach ($request->maHuong as $key) {
                    $Chitiethuong = new Chitiethuong();
                    $Chitiethuong->hv_ma = $key;
                    $Chitiethuong->sp_ma = $sanpham->sp_ma;
                    $Chitiethuong->save();
                }
                 $json = json_encode($sanpham);
                 return response(['error'=>false, 'message'=>compact('sanpham', 'json')], 200);
             }
         }

    	}catch(QueryException $ex){
    		return response(["error"=>true, "message"=>$ex->getMessage()], 200);
    	}catch(PDOException $ex){
    		return response(["error"=>true, "message"=>$ex->getMessage()], 200);
    	}
    }

    public function update(Request $request, $id) // cập nhât vận chuyển
    {
        try{

            $sanpham = Sanpham::where('sp_ma', $id)->first();
            if($sanpham){
                if($sanpham->sp_ten != $request->ten){

                    $rule = [ "ten" => "unique:sanpham,sp_ten", ];
                    $message = [ "ten.unique" => "Tên sản phẩm đã tồn tại", ];
                    $validator = Validator::make($request->all(), $rule, $message);
                    if($validator->fails())
                        return response()->json(['error'=>true, 'message'=>$validator->errors()]);
                    else
                        $sanpham->sp_ten = $request->ten;
                }
                 
                $sanpham->l_ma = $request->maLoai;
                $sanpham->h_ma = $request->maHang;
                $sanpham->sp_giaBan = $request->gia;
                $sanpham->sp_giamGia = $request->giamGia;
                $sanpham->sp_soLuong = $request->soluong;
                $sanpham->sp_thongTin = $request->thongTin;
                $sanpham->sp_trangThai = $request->trangThai;
                $sanpham->sp_tinhTrang = $request->tinhTrang;

                if($sanpham->save()){
                    $sanpham = Sanpham::where('sp_ma', $sanpham->sp_ma)->first();

                    Chitiethuong::where("sp_ma", $sanpham->sp_ma)->delete();

                    foreach ($request->maHuong as $key) {
                        $Chitiethuong = new Chitiethuong();
                        $Chitiethuong->hv_ma = $key;
                        $Chitiethuong->sp_ma = $sanpham->sp_ma;
                        $Chitiethuong->save();
                    }

                    $json = json_encode($sanpham);
                    return response(['error'=>false, 'message'=>compact('sanpham', 'json')], 200);
                }
            }
  
        }catch(QueryException $ex){
            return response(['error'=>true, 'message'=>$ex->getMessage()], 200);
        }catch(PDOException $ex){
            return response(['error'=>true, 'message'=>$ex->getMessage()], 200);
        }
    }

    public function destroy($id) 
    {
    	try{
            
            $sanpham = Sanpham::where('sp_ma', $id)->first();
            if($sanpham){
                $hinhanh = Hinhanh::where('sp_ma', $sanpham->sp_ma)->get();
                if($hinhanh){
                    foreach ($hinhanh as $key => $value) {
                        if(file_exists(public_path('images/products/'.$value['ha_ten'])))
                            unlink(public_path('images/products/'.$value['ha_ten']));
                    }
                }
                $sanpham->delete();
                return response(['error'=>false, 'message'=>true], 200);
            }else{
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
           
        	if(Sanpham::destroy($request->sanphams))
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
