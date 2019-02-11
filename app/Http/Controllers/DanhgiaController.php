<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Support\MessageBag;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Gopy;
use App\Sanpham;


class DanhgiaController extends Controller
{
    public function index()
    {
    	try{

    		$danhgia = Gopy::all();
    		$json = json_encode($danhgia);
    		return response(["error"=>false, "message"=>compact("danhgia", "json")], 200);

    	}catch(QueryException $ex){
    		return response(["error"=>true, "message"=>$ex->getMessage()], 200);
    	}catch(PDOException $ex){
    		return response(["error"=>true, "message"=>$ex->getMessage()], 200);
    	}
    }
}
