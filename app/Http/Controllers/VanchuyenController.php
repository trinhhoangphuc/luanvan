<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Support\MessageBag;
use Illuminate\Http\Request;
use App\Vanchuyen;
use Illuminate\Database\QueryException;

class VanchuyenController extends Controller
{
    public function index() //load danh sách
    {
    	try{

    		$vanchuyen = Vanchuyen::orderBy("vc_capNhat", "desc")->get();
    		$json = json_encode($vanchuyen);
    		return response(["error"=>false, "message"=>compact('vanchuyen', "json")], 200);

    	}catch(QueryException $ex){
    		return response(["error"=>true, "message"=>$ex->getMessage()], 200);
    	}catch(PDOException $ex){
    		return response(["error"=>true, "message"=>$ex->getMessage()], 200);
    	}
    }

    public function checkExistName($name) // kiểm tra trùng tên
    {
    	try{

    		$vanchuyen = Vanchuyen::where("vc_ten", $name)->first();
    		if($vanchuyen)
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
                "ten" => "unique:vanchuyen,vc_ten",
            ];
            $message = [
                "ten.unique" => "Tên vận chuyển đã tồn tại",      
            ];
            $validator = Validator::make($request->all(), $rule, $message);
            if($validator->fails()){
                return response()->json(['error'=>true, 'message'=>$validator->errors()]);
            }else{
        		$item = new Vanchuyen();
        		$item->vc_ten = $request->ten;
        		$item->vc_trangThai = $request->trangThai;
        		$item->vc_gia = $request->gia;
        		if($item->save()){
        			$vanchuyen = Vanchuyen::where('vc_ma', $item->vc_ma)->first();
        			$json = json_encode($vanchuyen);
                	return response(['error'=>false, 'message'=>compact('vanchuyen', 'json')], 200);
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
           $vanchuyen = Vanchuyen::where('vc_ma', $id)->first();
            if($vanchuyen){

                if($vanchuyen->vc_ten != $request->ten){

                    $rule = [ "ten" => "unique:vanchuyen,vc_ten", ];
                    $message = [ "ten.unique" => "Tên vận chuyển đã tồn tại", ];
                    $validator = Validator::make($request->all(), $rule, $message);
                    if($validator->fails())
                        return response()->json(['error'=>true, 'message'=>$validator->errors()]);
                    else
                         $vanchuyen->vc_ten = $request->get('ten');
                }

               $vanchuyen->vc_trangThai = $request->get('trangThai');
               $vanchuyen->vc_gia = $request->get('gia');
               $vanchuyen->save();
               $vanchuyen = Vanchuyen::where('vc_ma', $id)->first();
                $json = json_encode($vanchuyen);
                return response(['error'=>false, 'message'=>compact('vanchuyen', 'json')], 200);
            }
        }catch(QueryException $ex){
            return response(['error'=>true, 'message'=>$ex->getMessage()], 200);
        }catch(PDOException $ex){
            return response(['error'=>true, 'message'=>$ex->getMessage()], 200);
        }
    }

    public function destroy($id) // xóa vận chuyển
    {
    	try{
           $vanchuyen = Vanchuyen::where('vc_ma', $id)->first();
           $vanchuyen = Vanchuyen::where('vc_ma', $id)->first();
            if($vanchuyen){

                if($vanchuyen->delete())
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
           
        	if(Vanchuyen::destroy($request->items))
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
