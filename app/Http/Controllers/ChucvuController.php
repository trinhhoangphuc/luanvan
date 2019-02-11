<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Validator;
use Illuminate\Support\MessageBag;
use App\Chucvu;
use App\Quyen;
use App\Chitietquyen;

class ChucvuController extends Controller
{
    public function index() //load danh sách
    {
    	try{

    		$chucvu = Chucvu::orderBy("cv_capNhat", "desc")->get();
    		$json = json_encode($chucvu);
    		return response(["error"=>false, "message"=>compact('chucvu', "json")], 200);

    	}catch(QueryException $ex){
    		return response(["error"=>true, "message"=>$ex->getMessage()], 200);
    	}catch(PDOException $ex){
    		return response(["error"=>true, "message"=>$ex->getMessage()], 200);
    	}
    }

    public function quyen() //laod danh sách quyền
    {
        try{

            $quyen = Quyen::all();
            $json = json_encode($quyen);
            return response(["error"=>false, "message"=>compact('quyen', "json")], 200);

        }catch(QueryException $ex){
            return response(["error"=>true, "message"=>$ex->getMessage()], 200);
        }catch(PDOException $ex){
            return response(["error"=>true, "message"=>$ex->getMessage()], 200);
        }
    }

    public function getQuyenByIdCv($id_cv)
    {
        try{

            $ctquyen = Chitietquyen::where("cv_ma", $id_cv)->get();
            $json = json_encode($ctquyen);
            return response(["error"=>false, "message"=>compact('ctquyen', "json")], 200);

        }catch(QueryException $ex){
            return response(["error"=>true, "message"=>$ex->getMessage()], 200);
        }catch(PDOException $ex){
            return response(["error"=>true, "message"=>$ex->getMessage()], 200);
        }
    }

    public function addQuyenByIdCv(Request $request, $id_cv)
    {
        try{

            $chucvu = Chucvu::where("cv_ma", $id_cv)->first();
            if($chucvu){
                $ctquyen = Chitietquyen::where("cv_ma", $id_cv)->delete();
                
                for($i=0; $i<count($request->items); $i++){
                    $ctquyen = new Chitietquyen();
                    $ctquyen->cv_ma = $id_cv;
                    $ctquyen->q_ma  = $request->items[$i];
                    $ctquyen->save();
                }
                
            }
            return response(["error"=>false, "message"=>true], 200);
            

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
    			"ten" => "unique:chucvu,cv_ten",
    		];
    		$message = [
    			"ten.unique" => "Tên chức vụ đã tồn tại",      
    		];
    		$validator = Validator::make($request->all(), $rule, $message);
    		if($validator->fails()){
    			return response()->json(['error'=>true, 'message'=>$validator->errors()]);
    		}else{
    			$item = new Chucvu();
    			$item->cv_ten = $request->ten;
    			$item->cv_trangThai = $request->trangThai;
    			if($item->save()){
                    $chucvu = Chucvu::where('cv_ma', $item->cv_ma)->first();
    				$json = json_encode($chucvu);
    				return response(['error'=>false, 'message'=>compact('chucvu', 'json')], 200);
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
           $chucvu = Chucvu::where('cv_ma', $id)->first();
            if($chucvu){
               $chucvu->cv_ten = $request->get('ten');
               $chucvu->cv_trangThai = $request->get('trangThai');
               $chucvu->save();
               $chucvu = Chucvu::where('cv_ma', $id)->first();
                $json = json_encode($chucvu);
                return response(['error'=>false, 'message'=>compact('chucvu', 'json')], 200);
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
           $chucvu = Chucvu::where('cv_ma', $id)->first();
           $chucvu = Chucvu::where('cv_ma', $id)->first();
            if($chucvu){

                if($chucvu->delete())
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
           
        	if(Chucvu::destroy($request->items))
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
