<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Support\MessageBag;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Huongvi;
use App\Sanpham;
use App\Nhap;

class HuongviController extends Controller
{
     public function index() //load danh sách
    {
    	try{

    		$huongvi = Huongvi::orderBy("hv_capNhat", "desc")->get();
    		$json = json_encode($huongvi);
    		return response(["error"=>false, "message"=>compact("huongvi", "json")], 200);

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
                "ten" => "unique:Huongvi,hv_ten",
            ];
            $message = [
                "ten.unique" => "Tên loại đã tồn tại",      
            ];
            $validator = Validator::make($request->all(), $rule, $message);
            if($validator->fails()){
                return response()->json(['error'=>true, 'message'=>$validator->errors()]);
            }else{
                $item = new Huongvi();
                $item->hv_ten = $request->ten;
                $item->hv_trangThai = $request->trangThai;
                if($item->save()){
                    $huongvi = Huongvi::where('hv_ma', $item->hv_ma)->first();
                    $json = json_encode($huongvi);
                    return response(['error'=>false, 'message'=>compact('huongvi', 'json')], 200);
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
            $huongvi = Huongvi::where('hv_ma', $id)->first();
            if($huongvi){

                if($huongvi->hv_ten != $request->ten){

                    $rule = [ "ten" => "unique:Huongvi,hv_ten", ];
                    $message = [ "ten.unique" => "Tên loại đã tồn tại", ];
                    $validator = Validator::make($request->all(), $rule, $message);
                    if($validator->fails())
                        return response()->json(['error'=>true, 'message'=>$validator->errors()]);
                    else
                        $huongvi->hv_ten = $request->get('ten');
                }
 
                $huongvi->hv_trangThai = $request->get('trangThai');
                $huongvi->save();
                $huongvi = Huongvi::where('hv_ma', $id)->first();
                $json = json_encode($huongvi);
                return response(['error'=>false, 'message'=>compact('huongvi', 'json')], 200);
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
            $huongvi = Huongvi::where('hv_ma', $id)->first();
            if($huongvi){

                if($huongvi->delete())
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
        	if(Huongvi::destroy($request->items))
        		return response(['error'=>false, 'message'=>true], 200);
        	else
        		return response(['error'=>false, 'message'=>false], 200);

         }catch(QueryException $ex){
            return response(['error'=>true, 'message'=>$ex->getMessage()], 200);
        }catch(PDOException $ex){
            return response(['error'=>true, 'message'=>$ex->getMessage()], 200);
        }
    }

    public function getHuongViById($id)
    {
        try {
            $huongviSP = Huongvi::where("sp_ma", $id)->get();
            if($huongviSP){
                $json = json_encode($huongviSP);
                return response(['error'=>false, 'message'=>compact('huongviSP', 'json')], 200);
            }
         }catch(QueryException $ex){
            return response(['error'=>true, 'message'=>$ex->getMessage()], 200);
        }catch(PDOException $ex){
            return response(['error'=>true, 'message'=>$ex->getMessage()], 200);
        }
    }
}
