<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Support\MessageBag;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Gopy;
use App\Sanpham;
use DB;


class GopyController extends Controller
{
    public function index()
    {
    	try{

    		$gopy = DB::table('gopy')->select("gopy.*", "sanpham.sp_ten", "khachhang.kh_hoTen")->join("sanpham", "sanpham.sp_ma", "gopy.sp_ma")->join("khachhang", "khachhang.kh_ma", "gopy.kh_ma")->orderBy("gopy.gy_capNhat", "desc")->get();
    		$json = json_encode($gopy);
    		return response(["error"=>false, "message"=>compact("gopy", "json")], 200);

    	}catch(QueryException $ex){
    		return response(["error"=>true, "message"=>$ex->getMessage()], 200);
    	}catch(PDOException $ex){
    		return response(["error"=>true, "message"=>$ex->getMessage()], 200);
    	}
    }
}
