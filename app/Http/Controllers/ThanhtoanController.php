<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Support\MessageBag;
use Illuminate\Http\Request;
use App\Thanhtoan;
use Illuminate\Database\QueryException;

class ThanhtoanController extends Controller
{
    public function index() //load danh sách
    {
    	try{

    		$thanhtoan = Thanhtoan::orderBy("tt_capNhat", "desc")->get();
    		$json = json_encode($thanhtoan);
    		return response(["error"=>false, "message"=>compact('thanhtoan', "json")], 200);

    	}catch(QueryException $ex){
    		return response(["error"=>true, "message"=>$ex->getMessage()], 200);
    	}catch(PDOException $ex){
    		return response(["error"=>true, "message"=>$ex->getMessage()], 200);
    	}
    }

    public function checkExistName($name) // kiểm tra trùng tên
    {
    	try{

    		$thanhtoan = Thanhtoan::where("tt_ten", $name)->first();
    		if($thanhtoan)
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
                "ten" => "unique:thanhtoan,tt_ten",
            ];
            $message = [
                "ten.unique" => "Tên thanh toán đã tồn tại",      
            ];
            $validator = Validator::make($request->all(), $rule, $message);
            if($validator->fails()){
                return response()->json(['error'=>true, 'message'=>$validator->errors()]);
            }else{
        		$item = new Thanhtoan();
        		$item->tt_ten = $request->ten;
        		$item->tt_trangThai = $request->trangThai;
        		if($item->save()){
        			$thanhtoan = Thanhtoan::where('tt_ma', $item->tt_ma)->first();
        			$json = json_encode($thanhtoan);
                	return response(['error'=>false, 'message'=>compact('thanhtoan', 'json')], 200);
        		}
            }

    	}catch(QueryException $ex){
    		return response(["error"=>true, "message"=>$ex->getMessage()], 200);
    	}catch(PDOException $ex){
    		return response(["error"=>true, "message"=>$ex->getMessage()], 200);
    	}
    }

    public function update(Request $request, $id) // cập nhât thanh toans
    {
        try{
            $thanhtoan = Thanhtoan::where('tt_ma', $id)->first();
            if($thanhtoan){

                if($thanhtoan->tt_ten != $request->ten){

                    $rule = [ "ten" => "unique:thanhtoan,tt_ten", ];
                    $message = [ "ten.unique" => "Tên thanh toán đã tồn tại", ];
                    $validator = Validator::make($request->all(), $rule, $message);
                    if($validator->fails())
                        return response()->json(['error'=>true, 'message'=>$validator->errors()]);
                    else
                        $thanhtoan->tt_ten = $request->get('ten');
                }

                
                $thanhtoan->tt_trangThai = $request->get('trangThai');
                $thanhtoan->save();
                $thanhtoan = Thanhtoan::where('tt_ma', $id)->first();
                $json = json_encode($thanhtoan);
                return response(['error'=>false, 'message'=>compact('thanhtoan', 'json')], 200);
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
            $thanhtoan = Thanhtoan::where('tt_ma', $id)->first();
            $thanhtoan = Thanhtoan::where('tt_ma', $id)->first();
            if($thanhtoan){

                if($thanhtoan->delete())
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
           
        	if(Thanhtoan::destroy($request->items))
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
