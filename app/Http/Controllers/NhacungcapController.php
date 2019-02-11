<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Support\MessageBag;
use Illuminate\Http\Request;
use App\Nhacungcap;
use Illuminate\Database\QueryException;


class NhacungcapController extends Controller
{
    public function index() //load danh sách
    {
    	try{

    		$nhacungcap = Nhacungcap::orderBy("ncc_capNhat", "desc")->get();
    		$json = json_encode($nhacungcap);
    		return response(["error"=>false, "message"=>compact('nhacungcap', "json")], 200);

    	}catch(QueryException $ex){
    		return response(["error"=>true, "message"=>$ex->getMessage()], 200);
    	}catch(PDOException $ex){
    		return response(["error"=>true, "message"=>$ex->getMessage()], 200);
    	}
    }

    public function store(Request $request)
    {
    	try {
            $rule = [
            	"ten" => "unique:nhacungcap,ncc_ten",
                "email" => "unique:nhacungcap,ncc_email",
                "dienthoai" => "unique:nhacungcap,ncc_dienThoai",
            ];
            $message = [
            	"ten.unique" => "Tên nhà cung cấp đã được sử dụng!",
                "email.unique" => "Email đã được sử dụng!",
                "dienthoai.unique" => "Số điện thoại đã được sử dụng",   
            ];
            $validator = Validator::make($request->all(), $rule, $message);
            if($validator->fails()){
                return response()->json(['error'=>true, 'message'=>$validator->errors()]);
            }else{
                $nhacungcap = new Nhacungcap();
                $nhacungcap->ncc_ten       =   $request->get('ten');
                $nhacungcap->ncc_email     =   $request->get('email');
                $nhacungcap->ncc_diaChi    =   $request->get('diachi');
                $nhacungcap->ncc_dienThoai =   $request->get('dienthoai');
                $nhacungcap->ncc_trangThai =   $request->get('trangThai');
                if($nhacungcap->save()){
                    $nhacungcap = Nhacungcap::where('ncc_ma', $nhacungcap->ncc_ma)->first();
                    $json = json_encode($nhacungcap);
                    return response(['error'=>false, 'message'=>compact('nhacungcap', 'json')], 200);
               }
            }

        } catch (QueryException $ex) {
            return response(["error"=>true, "message"=>$ex->getMessage()], 200);
        } catch (PDOException $ex) {
            return response(["error"=>true, "message"=>$ex->getMessage()], 200);
        }
    }

    public function update(Request $request, $id) // cập nhât thanh toans
    {
        try{

            $nhacungcap = Nhacungcap::where('ncc_ma', $id)->first();
            if($nhacungcap){

            	if($nhacungcap->ncc_ten!= $request->get('ten')){

                    $rule = [ "ten" => "unique:nhacungcap,ncc_ten", ];
                    $message = [ "ten.unique" => "tên nhà cung cấp đã được sử dụng!", ];
                    $validator = Validator::make($request->all(), $rule, $message);
                    if($validator->fails()){
                        return response()->json(['error'=>true, 'message'=>$validator->errors()]);
                    }else
                        $nhacungcap->ncc_ten = $request->get('ten');

                }
                if($nhacungcap->ncc_email != $request->get('email')){

                    $rule = [ "email" => "unique:nhacungcap,ncc_email", ];
                    $message = [ "email.unique" => "Email đã được sử dụng!", ];
                    $validator = Validator::make($request->all(), $rule, $message);
                    if($validator->fails()){
                        return response()->json(['error'=>true, 'message'=>$validator->errors()]);
                    }else
                        $nhacungcap->ncc_email = $request->get('email');

                }
                if ($nhacungcap->ncc_dienThoai != $request->get('dienthoai')) {

                    $rule = ["dienthoai" => "unique:nhacungcap,ncc_dienThoai",];
                    $message = [ "dienthoai.unique" => "Số điện thoại đã được sử dụng",  ];
                    $validator = Validator::make($request->all(), $rule, $message);
                    if($validator->fails()){
                        return response()->json(['error'=>true, 'message'=>$validator->errors()]);
                    }else
                         $nhacungcap->ncc_dienThoai =  $request->get('dienthoai');
                }
                 
                $nhacungcap->ncc_diaChi    =   $request->get('diachi');
				$nhacungcap->ncc_trangThai =   $request->get('trangThai');

                if($nhacungcap->save()){
                    $nhacungcap = Nhacungcap::where('ncc_ma', $nhacungcap->ncc_ma)->first();
                    $json = json_encode($nhacungcap);
                    return response(['error'=>false, 'message'=>compact('nhacungcap', 'json')], 200);
               }
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
            $nhacungcap = Nhacungcap::where('ncc_ma', $id)->first();
            $nhacungcap = Nhacungcap::where('ncc_ma', $id)->first();
            if($nhacungcap){

                if($nhacungcap->delete())
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
           
        	if(Nhacungcap::destroy($request->items))
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
