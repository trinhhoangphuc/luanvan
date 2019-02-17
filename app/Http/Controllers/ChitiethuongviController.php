<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Support\MessageBag;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Chitiethuong;
use DB;

class ChitiethuongviController extends Controller
{
    public function index($id) //load danh sách
    {
    	try{

    		$chitiethuong = DB::table('chitiethuong')->select("chitiethuong.*", "huongvi.hv_ten")->join("huongvi", "huongvi.hv_ma", "chitiethuong.hv_ma")->where("sp_ma", $id)->orderBy("cthv_ma", "desc")->get();
    		$json = json_encode($chitiethuong);
    		return response(["error"=>false, "message"=>compact("chitiethuong", "json")], 200);

    	}catch(QueryException $ex){
    		return response(["error"=>true, "message"=>$ex->getMessage()], 200);
    	}catch(PDOException $ex){
    		return response(["error"=>true, "message"=>$ex->getMessage()], 200);
    	}
    }

     public function store(Request $request, $id)
    {
        try{
        	$check = Chitiethuong::where("sp_ma", $id)->where("hv_ma", $request->maHuong)->first();
        	if($check)
        		return response(["error"=>false, "message"=>false], 200);
        	else{
        		$chitiethuong = new Chitiethuong();
        		$chitiethuong->hv_ma = $request->maHuong;
        		$chitiethuong->sp_ma = $id;
        		if($chitiethuong->save()){
        			$chitiethuong = DB::table('chitiethuong')->select("chitiethuong.*", "huongvi.hv_ten")->join("huongvi", "huongvi.hv_ma", "chitiethuong.hv_ma")->where("sp_ma", $id)->orderBy("cthv_ma", "desc")->get();
		    		$json = json_encode($chitiethuong);
		    		return response(["error"=>false, "message"=>compact('chitiethuong', "json")], 200);
        		}
        	}
           
        }catch(QueryException $ex){
            return response(["error"=>true, "message"=>$ex->getMessage()], 200);
        }catch(PDOException $ex){
            return response(["error"=>true, "message"=>$ex->getMessage()], 200);
        }
    }
}
