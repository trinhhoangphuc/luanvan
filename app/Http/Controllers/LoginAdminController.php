<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Session;
use App\Nhanvien;
use App\Chucvu;
use App\Chitietquyen;

class LoginAdminController extends Controller
{
    public function postLogin(Request $request){
    	try{

    		$user = Nhanvien::where("nv_email", $request->get("email"))->where("nv_matKhau", md5($request->get("pwd")))->where("nv_trangThai", "1")->first();
    		if($user){

    			$test = [];
    			$quyen = Chitietquyen::where("cv_ma", $user->cv_ma)->get();
    			Session::put("admin_id", $user->nv_ma);
                Session::put("admin_name", $user->nv_hoTen);
                Session::put("admin_img", $user->nv_hinh);
    			foreach ($quyen as $key => $value) {
    				array_push($test, $value["q_ma"]);
    			}
    			Session::put("admin_q", $test);
    			return response(["error"=>false, "message"=>true], 200);

    		}else{
    			return response(["error"=>false, "message"=>false], 200);
    		}

    	}catch(QueryException $ex){
    		return response(["error"=>true, "message"=>$ex->getMessage()], 200);
    	}catch(PDOException $ex){
    		return response(["error"=>true, "message"=>$ex->getMessage()], 200);
    	}
    }

    public function postLogout(){
    	try{

    		if(Session::has("admin_id") && Session::has("admin_q")){

    			Session::forget("admin_id");
    			Session::forget("admin_q");
                Session::forget("admin_img");
    			return redirect()->back();

    		}else{
    			return response(["error"=>false, "message"=>false], 200);
    		}

    	}catch(QueryException $ex){
    		return response(["error"=>true, "message"=>$ex->getMessage()], 200);
    	}catch(PDOException $ex){
    		return response(["error"=>true, "message"=>$ex->getMessage()], 200);
    	}
    }
}
