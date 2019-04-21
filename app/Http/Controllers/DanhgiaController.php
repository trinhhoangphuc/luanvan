<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Support\MessageBag;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Danhgia;
use App\Sanpham;
use DB;


class DanhgiaController extends Controller
{
    public function index()
    {
    	try{

    		$danhgia = DB::table('danhgia')->select("danhgia.*", "sanpham.sp_ten")->join("sanpham", "sanpham.sp_ma", "danhgia.sp_ma")->orderBy("danhgia.dg_capNhat", "desc")->get();
    		$json = json_encode($danhgia);
    		return response(["error"=>false, "message"=>compact("danhgia", "json")], 200);

    	}catch(QueryException $ex){
    		return response(["error"=>true, "message"=>$ex->getMessage()], 200);
    	}catch(PDOException $ex){
    		return response(["error"=>true, "message"=>$ex->getMessage()], 200);
    	}
    }

    public function update(Request $request, $id)
    {
        try{
            $danhgia = Danhgia::where('dg_ma', $id)->first();
            if($danhgia){

                $danhgia->dg_trangThai = $request->get('trangThai');
                if($danhgia->save())
                {   
                    $sanpham = Sanpham::where("sp_ma", $danhgia->sp_ma)->first();
                   $star = Danhgia::where("sp_ma", $danhgia->sp_ma)->where("dg_sao", ">", 0)->where("dg_trangThai", 1)->avg("dg_sao");

                    if($star != null){
                        $star = round($star);
                        $sanpham->sp_danhGia = $star;
                    }
                    else
                        $sanpham->sp_danhGia = 0;
                        
                    $sanpham->save();

                    $danhgia = DB::table('danhgia')->select("danhgia.*", "sanpham.sp_ten", "khachhang.kh_hoTen")->join("sanpham", "sanpham.sp_ma", "danhgia.sp_ma")->join("khachhang", "khachhang.kh_ma", "danhgia.kh_ma")->where('danhgia.dg_ma', $id)->first();;
                    $json = json_encode($danhgia);
                    return response(['error'=>false, 'message'=>compact('danhgia', 'json')], 200);
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
            $danhgia = Danhgia::where('dg_ma', $id)->first();
            if($danhgia){
  
                $sanpham = Sanpham::where("sp_ma", $danhgia->sp_ma)->first();
                $danhgia->delete();
                $star = Danhgia::where("sp_ma", $sanpham->sp_ma)->where("dg_sao", ">", 0)->where("dg_trangThai", 1)->avg("dg_sao");

                if($star != null){
                    $star = round($star);
                    $sanpham->sp_danhGia = $star;
                }
                else
                    $sanpham->sp_danhGia = 0;

                if($sanpham->save()){
                    
                    return response(['error'=>false, 'message'=>true], 200); 
                }

            }
        }catch(QueryException $ex){
            return response(['error'=>true, 'message'=>$ex->getMessage()], 200);
        }catch(PDOException $ex){
            return response(['error'=>true, 'message'=>$ex->getMessage()], 200);
        }
    }
}
