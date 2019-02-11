<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Support\MessageBag;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Hang;
use App\Sanpham;
use App\Hinhanh;

class HangController extends Controller
{
    public function index() //load danh sách
    {
    	try{

    		$hang = Hang::orderBy("h_capNhat", "desc")->get();
    		$json = json_encode($hang);
    		return response(["error"=>false, "message"=>compact("hang", "json")], 200);

    	}catch(QueryException $ex){
    		return response(["error"=>true, "message"=>$ex->getMessage()], 200);
    	}catch(PDOException $ex){
    		return response(["error"=>true, "message"=>$ex->getMessage()], 200);
    	}
    }

    public function checkExistName($name) // kiểm tra trùng tên
    {
    	try{

    		$hang = Hang::where("h_ten", $name)->first();
    		if($hang)
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
                "ten" => "unique:hang,h_ten",
            ];
            $message = [
                "ten.unique" => "Tên nhà sản xuất đã tồn tại",      
            ];
            $validator = Validator::make($request->all(), $rule, $message);
            if($validator->fails()){
                return response()->json(['error'=>true, 'message'=>$validator->errors()]);
            }else{
        		$item = new Hang();
        		$item->h_ten = $request->ten;
        		$item->h_trangThai = $request->trangThai;
        		if($item->save()){
        			$hang = Hang::where('h_ma', $item->h_ma)->first();
        			$json = json_encode($hang);
                	return response(['error'=>false, 'message'=>compact('hang', 'json')], 200);
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
            $hang = Hang::where('h_ma', $id)->first();
            if($hang){

                if($hang->h_ten != $request->ten){

                    $rule = [ "ten" => "unique:hang,h_ten", ];
                    $message = [ "ten.unique" => "Tên nhà sản xuất đã tồn tại", ];
                    $validator = Validator::make($request->all(), $rule, $message);
                    if($validator->fails())
                        return response()->json(['error'=>true, 'message'=>$validator->errors()]);
                    else
                        $hang->h_ten = $request->get('ten');
                }

                $hang->h_trangThai = $request->get('trangThai');
                $hang->save();
                $hang = Hang::where('h_ma', $id)->first();
                $json = json_encode($hang);
                return response(['error'=>false, 'message'=>compact('hang', 'json')], 200);
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
            $hang = Hang::where('h_ma', $id)->first();
            $hang = Hang::where('h_ma', $id)->first();
            if($hang){
                $sanpham = Sanpham::where('l_ma', $id)->get();
                if($sanpham){
                    foreach ($sanpham as $key => $value) {
                        $hinhanh = Hinhanh::where('sp_ma', $value['sp_ma'])->get();
                        if($hinhanh){
                            foreach ($hinhanh as $key2 => $value2) {
                                if(file_exists(public_path('images/products/'.$value2['ha_ten'])))
                                    unlink(public_path('images/products/'.$value2['ha_ten']));
                            }
                        }
                    }
                }
                if($hang->delete())
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
            foreach ($request->items as $key => $value) {
               $sanpham = Sanpham::where('h_ma', $value)->get();
                if($sanpham){
                    foreach ($sanpham as $key1 => $value1) {
                        $hinhanh = Hinhanh::where('sp_ma', $value1['sp_ma'])->get();
                        if($hinhanh){
                            foreach ($hinhanh as $key2 => $value2) {
                                if(file_exists(public_path('images/products/'.$value2['ha_ten'])))
                                    unlink(public_path('images/products/'.$value2['ha_ten']));
                            }
                        }
                    }
                }
            }            

        	if(hang::destroy($request->items))
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
