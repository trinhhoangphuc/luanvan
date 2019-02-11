<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\MessageBag;
use App\Phieunhap;
use App\Chitietnhap;
use DB;
use Session;

class PhieunhapController extends Controller
{
     public function index() //load danh sách
    {
    	try{

    		$phieunhap = Phieunhap::orderBy("pn_capNhat", "desc")->get();
    		$json = json_encode($phieunhap);
    		return response(["error"=>false, "message"=>compact("phieunhap", "json")], 200);

    	}catch(QueryException $ex){
    		return response(["error"=>true, "message"=>$ex->getMessage()], 200);
    	}catch(PDOException $ex){
    		return response(["error"=>true, "message"=>$ex->getMessage()], 200);
    	}
    }

    public function checkExistName($name) // kiểm tra trùng tên
    {
    	try{

    		$phieunhap = Phieunhap::where("pn_soHoaDon", $name)->first();
    		if($phieunhap)
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
                "sohoadon" => "unique:phieunhap,pn_soHoaDon",
            ];
            $message = [
                "sohoadon.unique" => "Số hóa đơn đã trùng",      
            ];
            $validator = Validator::make($request->all(), $rule, $message);
            if($validator->fails()){
                return response()->json(['error'=>true, 'message'=>$validator->errors()]);
            }else{

                $item = new Phieunhap();
                $item->pn_soHoaDon = $request->sohoadon;
                $item->pn_ngayXuatHoaDon = $request->ngayxuathoadon;
                $item->pn_ngayXacNhan = $request->ngaythanhtoan;
                $item->nv_lapPhieu = Session::get("admin_id");
                $item->nv_xuLy = $request->maNVTT;
                $item->ncc_ma = $request->maNCC;
                $item->pn_ghiChu = $request->ghichu;
                $item->pn_trangThai = $request->trangThai;
                if($item->save()){
                    $phieunhap = Phieunhap::where('pn_ma', $item->pn_ma)->first();
                    $json = json_encode($phieunhap);
                    return response(['error'=>false, 'message'=>compact('phieunhap', 'json')], 200);
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
            $phieunhap = Phieunhap::where('pn_ma', $id)->first();
            if($phieunhap){

                if($phieunhap->pn_soHoaDon != $request->sohoadon){

                    $rule = [
                        "sohoadon" => "unique:phieunhap,pn_soHoaDon",
                    ];
                    $message = [
                        "sohoadon.unique" => "Số hóa đơn đã trùng",      
                    ];
                    $validator = Validator::make($request->all(), $rule, $message);
                    if($validator->fails())
                        return response()->json(['error'=>true, 'message'=>$validator->errors()]);
                    else
                        $item->pn_soHoaDon = $request->sohoadon;
                }
 
               
                $phieunhap->pn_ngayXuatHoaDon = $request->ngayxuathoadon;
                $phieunhap->pn_ngayXacNhan = $request->ngaythanhtoan;
                $phieunhap->nv_lapPhieu = Session::get("admin_id");
                $phieunhap->nv_xuLy = $request->maNVTT;
                $phieunhap->ncc_ma = $request->maNCC;
                $phieunhap->pn_ghiChu = $request->ghichu;
                $phieunhap->pn_trangThai = $request->trangThai;
                $phieunhap->save();
                $phieunhap = Phieunhap::where('pn_ma', $id)->first();
                $json = json_encode($phieunhap);
                return response(['error'=>false, 'message'=>compact('phieunhap', 'json')], 200);
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
            $phieunhap = Phieunhap::where('pn_ma', $id)->first();
            if($phieunhap){
                if($phieunhap->delete())
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
        	if(Phieunhap::destroy($request->items))
        		return response(['error'=>false, 'message'=>true], 200);
        	else
        		return response(['error'=>false, 'message'=>false], 200);

         }catch(QueryException $ex){
            return response(['error'=>true, 'message'=>$ex->getMessage()], 200);
        }catch(PDOException $ex){
            return response(['error'=>true, 'message'=>$ex->getMessage()], 200);
        }
    }


    public function getProductsById($id)
    {
       try {
            $sanpham = DB::table("sanpham")->select("sanpham.*", "chitietnhap.*")->join("chitietnhap", "chitietnhap.sp_ma", "sanpham.sp_ma")->where("chitietnhap.pn_ma", $id)->get();
            $json = json_encode($sanpham);
            return response(['error'=>false, 'message'=>compact('sanpham', 'json')], 200);

         }catch(QueryException $ex){
            return response(['error'=>true, 'message'=>$ex->getMessage()], 200);
        }catch(PDOException $ex){
            return response(['error'=>true, 'message'=>$ex->getMessage()], 200);
        }
    }

    public function storeProduct(Request $request, $id)
    {
        try {
            
            $chitietnhap = new Chitietnhap();
            $chitietnhap->pn_ma = $id;
            $chitietnhap->sp_ma = $request->get("maSP");
            $chitietnhap->ctn_soLuong = $request->get('soluong');
            $chitietnhap->ctn_donGia  = $request->get("gianhap");
            $chitietnhap->sp_ngaySX = $request->get("ngaysanxuat");
            $chitietnhap->sp_hanSD = $request->get("hansudung");
            $chitietnhap->ctn_thanhTien = $request->get("soluong")*$request->get("gianhap");
            $chitietnhap->sp_tonKho = $request->get("soluong");
            if($chitietnhap->save())
                return response(['error'=>false, 'message'=>true], 200);
            else
                return response(['error'=>false, 'message'=>false], 200);

         }catch(QueryException $ex){
            return response(['error'=>true, 'message'=>$ex->getMessage()], 200);
        }catch(PDOException $ex){
            return response(['error'=>true, 'message'=>$ex->getMessage()], 200);
        }
    }

    public function updateProduct(Request $request, $id)
    {
        
        try {
            
            $chitietnhap = Chitietnhap::where('ctn_ma', $id)->first();
            if($chitietnhap)
            {

                $chitietnhap->sp_ma = $request->get("maSP");
                $chitietnhap->ctn_soLuong = $request->get('soluong');
                $chitietnhap->ctn_donGia  = $request->get("gianhap");
                $chitietnhap->sp_ngaySX = $request->get("ngaysanxuat");
                $chitietnhap->sp_hanSD = $request->get("hansudung");
                $chitietnhap->ctn_thanhTien = $request->get("soluong")*$request->get("gianhap");
                $chitietnhap->sp_tonKho = $request->get("tonkho");
                if($chitietnhap->save())
                    return response(['error'=>false, 'message'=>true], 200);
                else
                    return response(['error'=>false, 'message'=>false], 200);
            }
            else
                return response(['error'=>false, 'message'=>false], 200);

         }catch(QueryException $ex){
            return response(['error'=>true, 'message'=>$ex->getMessage()], 200);
        }catch(PDOException $ex){
            return response(['error'=>true, 'message'=>$ex->getMessage()], 200);
        }
    }

     public function deleteProduct($id)
    {
        try {
            
            $chitietnhap = Chitietnhap::where("ctn_ma", $id)->first();
            if($chitietnhap){
                if($chitietnhap->delete())
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
}
