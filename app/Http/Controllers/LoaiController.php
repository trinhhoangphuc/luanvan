<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Validator;
use Illuminate\Support\MessageBag;
use App\Loai;
use App\Sanpham;
use App\Hinhanh;

class LoaiController extends Controller
{
    public function index() //load danh sách
    {
    	try{

    		$loai = Loai::orderBy("l_capNhat", "desc")->get();
    		$json = json_encode($loai);
    		return response(["error"=>false, "message"=>compact("loai", "json")], 200);

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
                "ten" => "unique:loai,l_ten",
            ];
            $message = [
                "ten.unique" => "Tên loại đã tồn tại",      
            ];
            $validator = Validator::make($request->all(), $rule, $message);
            if($validator->fails()){
                return response()->json(['error'=>true, 'message'=>$validator->errors()]);
            }else{
                $item = new Loai();
                $item->l_ten = $request->ten;
                $item->l_trangThai = $request->trangThai;
                if($item->save()){
                    $loai = Loai::where('l_ma', $item->l_ma)->first();
                    $json = json_encode($loai);
                    return response(['error'=>false, 'message'=>compact('loai', 'json')], 200);
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
            $loai = Loai::where('l_ma', $id)->first();
            if($loai){

                if($loai->l_ten != $request->ten){

                    $rule = [ "ten" => "unique:loai,l_ten", ];
                    $message = [ "ten.unique" => "Tên loại đã tồn tại", ];
                    $validator = Validator::make($request->all(), $rule, $message);
                    if($validator->fails())
                        return response()->json(['error'=>true, 'message'=>$validator->errors()]);
                    else
                        $loai->l_ten = $request->get('ten');
                }
 
                $loai->l_trangThai = $request->get('trangThai');
                $loai->save();
                $loai = Loai::where('l_ma', $id)->first();
                $json = json_encode($loai);
                return response(['error'=>false, 'message'=>compact('loai', 'json')], 200);
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
            $loai = Loai::where('l_ma', $id)->first();
            if($loai){
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
                if($loai->delete())
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
               $sanpham = Sanpham::where('l_ma', $value)->get();
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

        	if(Loai::destroy($request->items))
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
