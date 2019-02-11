<?php

namespace App\Http\Controllers;

use App\Huongvi;
use Illuminate\Database\QueryExecption;
use Illuminate\Http\Request;

class HuongController extends Controller
{
    public function index($id)
    {
    	try{

    		$huong = Huongvi::where("sp_ma", $id)->get();
    		$json = json_encode($huong);
    		return response(["error"=>false, "message"=>compact('huong', "json")], 200);

    	}catch(QueryException $ex){
    		return response(["error"=>true, "message"=>$ex->getMessage()], 200);
    	}catch(PDOException $ex){
    		return response(["error"=>true, "message"=>$ex->getMessage()], 200);
    	}
    }

    public function store(Request $request, $id)
    {
        try{
        	$check = Huongvi::where("sp_ma", $id)->where("hv_ten", $request->hv_ten)->first();
        	if($check)
        		return response(["error"=>false, "message"=>false], 200);
        	else{
        		$huong = new Huongvi();
        		$huong->hv_ten = $request->hv_ten;
        		$huong->sp_ma = $id;
        		if($huong->save()){
        			$huong = Huongvi::where("sp_ma", $id)->get();
		    		$json = json_encode($huong);
		    		return response(["error"=>false, "message"=>compact('huong', "json")], 200);
        		}
        	}
           
        }catch(QueryException $ex){
            return response(["error"=>true, "message"=>$ex->getMessage()], 200);
        }catch(PDOException $ex){
            return response(["error"=>true, "message"=>$ex->getMessage()], 200);
        }
    }

     public function delete(Request $request)
    {
        try
        {   
            $item = Huongvi::where("hv_ma", $request->id)->first();
            if($item){
            	$item->delete();
            	return response(["error"=>false, "message"=>true], 200);
            }

        }catch(QueryException $ex){
            return response(["error"=>true, "message"=>$ex->getMessage()], 200);
        }catch(PDOException $ex){
            return response(["error"=>true, "message"=>$ex->getMessage()], 200);
        }
    }
}
