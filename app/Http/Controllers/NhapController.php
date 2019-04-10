<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Validator;
use Illuminate\Support\MessageBag;
use App\Nhap;
use App\Sanpham;
use DB;

class NhapController extends Controller
{
    public function index($id)
    {
    	try{

    		$nhap = DB::select("
                SELECT nhap.*, huongvi.hv_ten
                FROM  nhap, huongvi
                WHERE nhap.hv_ma = huongvi.hv_ma AND nhap.n_soLuong > 0 AND nhap.sp_ma = $id
                ORDER BY TIMESTAMPDIFF(MONTH,NOW(),n_hanSD)  DESC
            ");
    		$json = json_encode($nhap);
    		return response(["error"=>false, "message"=>compact('nhap', "json")], 200);

    	}catch(QueryException $ex){
    		return response(["error"=>true, "message"=>$ex->getMessage()], 200);
    	}catch(PDOException $ex){
    		return response(["error"=>true, "message"=>$ex->getMessage()], 200);
    	}
    }

    public function index2($id)
    {
        try{

            $nhap = DB::select("
                SELECT nhap.*, huongvi.hv_ten, TIMESTAMPDIFF(MONTH,NOW(),n_hanSD) AS hansudung
                FROM  nhap, huongvi
                WHERE nhap.hv_ma = huongvi.hv_ma AND nhap.n_soLuong > 0 AND nhap.sp_ma = $id
                ORDER BY TIMESTAMPDIFF(MONTH,NOW(),n_hanSD)  asc
            ");
            $json = json_encode($nhap);
            return response(["error"=>false, "message"=>compact('nhap', "json")], 200);

        }catch(QueryException $ex){
            return response(["error"=>true, "message"=>$ex->getMessage()], 200);
        }catch(PDOException $ex){
            return response(["error"=>true, "message"=>$ex->getMessage()], 200);
        }
    }

     public function storeProduct(Request $request, $id)
    {
        try
        {
            $nhap = Nhap::where("sp_ma", $id)->where("n_ngaySX", $request->get("ngaysanxuat"))->where("n_hanSD", $request->get("hansudung"))->where("hv_ma", $request->get("maHuong"))->where("n_soLuongNhap", ">", 0)->first();
            if(!$nhap)
            {
                $nhap = new Nhap();
                $nhap->sp_ma = $id;
                $nhap->n_soLuong = $request->get('soluong');
                $nhap->n_soLuongNhap = $request->get('soluong');
                $nhap->n_ngaySX = $request->get("ngaysanxuat");
                $nhap->n_hanSD = $request->get("hansudung");
                $nhap->n_ngayNhap = $request->get("ngaynhap");
                $nhap->hv_ma   = $request->get("maHuong");
                if($nhap->save())
                {
                    $sanpham = Sanpham::where("sp_ma", $nhap->sp_ma)->first();
                    $soluong = Nhap::where("sp_ma", $nhap->sp_ma)->sum("n_soLuong");

                    if($soluong != null)
                        $sanpham->sp_soLuong = $soluong;
                    else
                        $sanpham->sp_soLuong = 0;    
                    
                    $sanpham->save();
                    return response(['error'=>false, 'message'=>true], 200);
                }
                else
                    return response(['error'=>false, 'message'=>false], 200); 
            }else{
                return response(['error'=>false, 'message_2'=>true], 200);
            }
           

         }catch(QueryException $ex){
            return response(['error'=>true, 'message'=>$ex->getMessage()], 200);
        }catch(PDOException $ex){
            return response(['error'=>true, 'message'=>$ex->getMessage()], 200);
        }
    }

    public function updateProduct(Request $request, $id)
    {
        
        try {

            $nhap = Nhap::where("n_ma", $id)->first();
            if($nhap)
            {
                // $nhap = Nhap::where("sp_ma", $nhap->sp_ma)->where("n_ngaySX", $request->get("ngaysanxuat"))->where("n_hanSD", $request->get("hansudung"))->where("hv_ma", $request->get("maHuong"))->first();
                // if(!$nhap){
                    $nhap = Nhap::where("n_ma", $id)->first();
                    $nhap->sp_ma = $nhap->sp_ma;
                    $nhap->n_soLuongNhap = $request->get('soluong');
                    $nhap->n_soLuong = $request->get('tonkho');
                    $nhap->n_ngaySX = $request->get("ngaysanxuat");
                    $nhap->n_hanSD = $request->get("hansudung");
                    $nhap->n_ngayNhap = $request->get("ngaynhap");
                    $nhap->hv_ma   = $request->get("maHuong");
                    if($nhap->save())
                    {
                        $sanpham = Sanpham::where("sp_ma", $nhap->sp_ma)->first();
                        $soluong = Nhap::where("sp_ma", $nhap->sp_ma)->sum("n_soLuong");

                        if($soluong != null)
                            $sanpham->sp_soLuong = $soluong;
                        else
                            $sanpham->sp_soLuong = 0;    

                        $sanpham->save();
                        return response(['error'=>false, 'message'=>true], 200);
                    }
                    else
                        return response(['error'=>false, 'message'=>false], 200); 
                // }
                // else
                //     return response(['error'=>false, 'message_2'=>true], 200);  
            }

         }catch(QueryException $ex){
            return response(['error'=>true, 'message'=>$ex->getMessage()], 200);
        }catch(PDOException $ex){
            return response(['error'=>true, 'message'=>$ex->getMessage()], 200);
        }
    }

    public function deleteProduct($id)
    {
        try {
            
            $nhap = Nhap::where("n_ma", $id)->first();
            if($nhap){
                $soluong = $nhap->n_soLuong;
                $sanpham = Sanpham::where("sp_ma", $nhap->sp_ma)->first();
                if($nhap->delete()){
                    $sanpham->sp_soLuong -= $soluong;
                    $sanpham->save();
                    return response(['error'=>false, 'message'=>true], 200);
                }
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
