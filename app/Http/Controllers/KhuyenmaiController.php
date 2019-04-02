<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Validator;
use Illuminate\Support\MessageBag;
use Session;
use DB;

use App\Sanpham;
use App\Khuyenmai;
use App\Chitietkhuyenmai;

class KhuyenmaiController extends Controller
{
    public function index() //load danh sách
    {
    	try{

    		$khuyenmai = Khuyenmai::select('khuyenmai.*', "nhanvien.nv_hoTen")
	    		->join("nhanvien", "nhanvien.nv_ma", "khuyenmai.nv_nguoiLap")
	    		->orderBy("khuyenmai.km_capNhat", "desc")->get();
    		$json = json_encode($khuyenmai);
    		return response(["error"=>false, "message"=>compact("khuyenmai", "json")], 200);

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
                "ten" => "unique:khuyenmai,km_ten",
            ];
            $message = [
                "ten.unique" => "Tên loại đã tồn tại",      
            ];
            $validator = Validator::make($request->all(), $rule, $message);
            if($validator->fails()){
                return response()->json(['error'=>true, 'message'=>$validator->errors()]);
            }else{
                $item = new Khuyenmai();
                $item->km_ten = $request->ten;
                $item->km_moTaNgan = $request->moTaNgan;
                $item->km_noiDung = $request->noiDung;
                $item->km_batDau = $request->ngayBD;
                $item->km_ketThuc = $request->ngayKT;
                $item->nv_nguoiLap = Session::get("admin_id");
                $item->km_trangThai = $request->trangThai;
                if($item->save()){

                    $khuyenmai = Khuyenmai::select('khuyenmai.*', "nhanvien.nv_hoTen")
                        ->join("nhanvien", "nhanvien.nv_ma", "khuyenmai.nv_nguoiLap")
                        ->orderBy("khuyenmai.km_capNhat", "desc")->where('km_ma', $item->km_ma)->first();
                    $json = json_encode($khuyenmai);
                    return response(['error'=>false, 'message'=>compact('khuyenmai', 'json')], 200);
                }
            }

    	}catch(QueryException $ex){
    		return response(["error"=>true, "message"=>$ex->getMessage()], 200);
    	}catch(PDOException $ex){
    		return response(["error"=>true, "message"=>$ex->getMessage()], 200);
    	}
    }

    public function update(Request $request, $id) // cập nhât loại sản phẩm
    {
        try{
            $khuyenmai = Khuyenmai::where('km_ma', $id)->first();
            if($khuyenmai){

                if($khuyenmai->km_ten != $request->ten){

                    $rule = [ "ten" => "unique:khuyenmai,km_ten", ];
                    $message = [ "ten.unique" => "Tên loại đã tồn tại", ];
                    $validator = Validator::make($request->all(), $rule, $message);
                    if($validator->fails())
                        return response()->json(['error'=>true, 'message'=>$validator->errors()]);
                    else
                        $khuyenmai->km_ten = $request->get('ten');
                }
    
                $khuyenmai->km_moTaNgan = $request->moTaNgan;
                $khuyenmai->km_noiDung = $request->noiDung;
                $khuyenmai->km_batDau = $request->ngayBD;
                $khuyenmai->km_ketThuc = $request->ngayKT;
                $khuyenmai->km_trangThai = $request->trangThai;
                $khuyenmai->save();

                if($khuyenmai->km_trangThai == 1){
                    $chitietkhuyenmai = Chitietkhuyenmai::where("km_ma", $khuyenmai->km_ma)->get();
                    foreach ($chitietkhuyenmai as $key) {
                        $sanpham = Sanpham::find($key->sp_ma);
                        $sanpham->sp_giamGia = $key->kmsp_giaTri;
                        $sanpham->save();
                    }
                }else{
                    $chitietkhuyenmai = Chitietkhuyenmai::where("km_ma", $khuyenmai->km_ma)->get();
                    foreach ($chitietkhuyenmai as $key) {
                        $sanpham = Sanpham::find($key->sp_ma);
                        $sanpham->sp_giamGia = 0;
                        $sanpham->save();
                    }
                }

                $khuyenmai = Khuyenmai::select('khuyenmai.*', "nhanvien.nv_hoTen")
                        ->join("nhanvien", "nhanvien.nv_ma", "khuyenmai.nv_nguoiLap")
                        ->orderBy("khuyenmai.km_capNhat", "desc")->where('km_ma', $khuyenmai->km_ma)->first();
                $json = json_encode($khuyenmai);
                return response(['error'=>false, 'message'=>compact('khuyenmai', 'json')], 200);
            }
        }catch(QueryException $ex){
            return response(['error'=>true, 'message'=>$ex->getMessage()], 200);
        }catch(PDOException $ex){
            return response(['error'=>true, 'message'=>$ex->getMessage()], 200);
        }
    }



    public function danhsachSPbyIdLoai($id)
    {
       try{
            if($id != 0){
                $sanpham =DB::select("
                   SELECT * 
                   FROM sanpham 
                   WHERE sp_ma NOT IN(
                   SELECT sp_ma FROM chitietkhuyenmai WHERE km_ma  IN (
                   SELECT km_ma FROM khuyenmai WHERE km_batDau <= NOW() AND km_ketThuc >= NOW() AND km_trangThai = 1
                   )
                   ) AND l_ma = $id
                   ");
            }else{
                $sanpham =DB::select("
                   SELECT * 
                   FROM sanpham 
                   WHERE sp_ma NOT IN(
                   SELECT sp_ma FROM chitietkhuyenmai WHERE km_ma  IN (
                   SELECT km_ma FROM khuyenmai WHERE km_batDau <= NOW() AND km_ketThuc >= NOW() AND km_trangThai = 1
                   )
                   )
                   ");
            }

            $json = json_encode($sanpham);
            return response(['error'=>false, 'message'=>compact("sanpham", "json")], 200);
        }catch(QueryException $ex){
            return response(['error'=>true, 'message'=>$ex->getMessage()], 200);
        }catch(PDOException $ex){
            return response(['error'=>true, 'message'=>$ex->getMessage()], 200);
        }
    }

    public function chitietkhuyenmai($id)
    {
        try{
            
            $chitietkhuyenmai = Chitietkhuyenmai::select("chitietkhuyenmai.*", "sanpham.sp_ten", "sanpham.sp_hinh", "sanpham.sp_giaBan")
                ->join("sanpham", "sanpham.sp_ma", "chitietkhuyenmai.sp_ma")
                ->where("chitietkhuyenmai.km_ma", $id)->get();
            $json = json_encode($chitietkhuyenmai);
            return response(['error'=>false, 'message'=>compact("chitietkhuyenmai", "json")], 200);
        }catch(QueryException $ex){
            return response(['error'=>true, 'message'=>$ex->getMessage()], 200);
        }catch(PDOException $ex){
            return response(['error'=>true, 'message'=>$ex->getMessage()], 200);
        }
    }

    public function storeChitietkhuyenmai(Request $request, $id)
    {
       try{
            foreach ($request->items as $key) {
                $chitietkhuyenmai = new Chitietkhuyenmai();
                $chitietkhuyenmai->km_ma = $id;
                $chitietkhuyenmai->sp_ma = $key;
                $chitietkhuyenmai->kmsp_giaTri = 0;
                $chitietkhuyenmai->save();
            }
            
            return response(['error'=>false, 'message'=>true], 200);
        }catch(QueryException $ex){
            return response(['error'=>true, 'message'=>$ex->getMessage()], 200);
        }catch(PDOException $ex){
            return response(['error'=>true, 'message'=>$ex->getMessage()], 200);
        }
    }

    public function updateChitietkhuyenmai(Request $request, $id)
    {
        try{
            
            $chitietkhuyenmai = Chitietkhuyenmai::where("km_ma", $id)->get();
            
            foreach ($chitietkhuyenmai as $key) {
                if($key->kmsp_giaTri != $request->get('discount_'.$key->sp_ma) && $request->get('discount_'.$key->sp_ma) != 0){
                    $key->kmsp_giaTri = $request->get('discount_'.$key->sp_ma);
                    if($key->save()){
                        $sanpham = Sanpham::find($key->sp_ma);
                        $sanpham->sp_giamGia = $key->kmsp_giaTri;
                        $sanpham->save();
                    }
                }
            }

            return response(['error'=>false, 'message'=>true], 200);
        }catch(QueryException $ex){
            return response(['error'=>true, 'message'=>$ex->getMessage()], 200);
        }catch(PDOException $ex){
            return response(['error'=>true, 'message'=>$ex->getMessage()], 200);
        }
    }

    public function deleteChitietkhuyenmai($id)
    {
        try{
            
            $chitietkhuyenmai = Chitietkhuyenmai::find($id);
            if($chitietkhuyenmai != null){
                $sanpham = Sanpham::find($chitietkhuyenmai->sp_ma);
                $sanpham->sp_giamGia = 0;
                if($sanpham->save()){
                    $chitietkhuyenmai->delete();
                    return response(['error'=>false, 'message'=>true], 200);
                }
            }
            
        }catch(QueryException $ex){
            return response(['error'=>true, 'message'=>$ex->getMessage()], 200);
        }catch(PDOException $ex){
            return response(['error'=>true, 'message'=>$ex->getMessage()], 200);
        }
    }

    public function destroy($id) // xóa loại sản phẩm
    {
    	try{
            $khuyenmai = khuyenmai::find($id);
            if($khuyenmai){
                $chitietkhuyenmai = Chitietkhuyenmai::where("km_ma", $khuyenmai->km_ma)->get();
                foreach ($chitietkhuyenmai as $key) {
                    $sanpham = Sanpham::find($key->sp_ma);
                    $sanpham->sp_giamGia = 0;
                    $sanpham->save(); 
                }
                if($khuyenmai->delete())
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

    // public function destroyAll(Request $request)
    // {
    //     try {
    //         foreach ($request->items as $key => $value) {
    //            $sanpham = Sanpham::where('km_ma', $value)->get();
    //             if($sanpham){
    //                 foreach ($sanpham as $key1 => $value1) {
    //                     $hinhanh = Hinhanh::where('sp_ma', $value1['sp_ma'])->get();
    //                     if($hinhanh){
    //                         foreach ($hinhanh as $key2 => $value2) {
    //                             if(file_exists(public_path('images/products/'.$value2['ha_ten'])))
    //                                 unlink(public_path('images/products/'.$value2['ha_ten']));
    //                         }
    //                     }
    //                 }
    //             }
    //         }            

    //     	if(khuyenmai::destroy($request->items))
    //     		return response(['error'=>false, 'message'=>true], 200);
    //     	else
    //     		return response(['error'=>false, 'message'=>false], 200);

    //      }catch(QueryException $ex){
    //         return response(['error'=>true, 'message'=>$ex->getMessage()], 200);
    //     }catch(PDOException $ex){
    //         return response(['error'=>true, 'message'=>$ex->getMessage()], 200);
    //     }
    // }
}
