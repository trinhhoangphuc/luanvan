<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Nhanvien;
use App\DB;
use Session;
use Illuminate\Database\QueryException;
use Validator;
use Illuminate\Support\MessageBag;

class NhanvienController extends Controller
{
    public function index() //Load danh sách nhân viên
    {
        try {
            
            $nhanvien = Nhanvien::orderBy("nv_capNhat", "desc")->get();
            $json = json_encode($nhanvien);
            return response(["error"=>true, "message"=>compact("nhanvien", "json")], 200);

        } catch (QueryException $ex) {
            return response(["error"=>true, "message"=>$ex->getMessage()], 200);
        } catch (PDOException $ex) {
            return response(["error"=>true, "message"=>$ex->getMessage()], 200);
        }
    }

    public function info()
    {
        if(Session::has('admin_id'))
        {
            $nhanvien = Nhanvien::select("nhanvien.*", "chucvu.cv_ten")
                ->join("chucvu", "chucvu.cv_ma", "nhanvien.cv_ma")
                ->where("nhanvien.nv_ma", Session::get("admin_id"))
                ->first();
            return view("admin.thongtincanhan", compact("nhanvien"));
        }
        else{
            return redirect(route("login"));
        }
    }

    public function store(Request $request)
    {
        try {
            $rule = [
                "email" => "unique:nhanvien,nv_email",
                "dienthoai" => "unique:nhanvien,nv_dienThoai",
            ];
            $message = [
                "email.unique" => "Email đã được sử dụng!",
                "dienthoai.unique" => "Số điện thoại đã được sử dụng",   
            ];
            $validator = Validator::make($request->all(), $rule, $message);
            if($validator->fails()){
                return response()->json(['error'=>true, 'message'=>$validator->errors()]);
            }else{
                $nhanvien = new Nhanvien();
                $nhanvien->nv_hoTen     =   $request->get('ten');
                $nhanvien->nv_email     =   $request->get('email');
                $nhanvien->nv_matKhau   =   md5("123456789");
                $nhanvien->nv_gioiTinh  =   $request->get('gioitinh');
                $nhanvien->nv_ngaySinh  =   $request->get('ngaysinh');
                $nhanvien->nv_diaChi    =   $request->get('diachi');
                $nhanvien->nv_dienThoai =   $request->get('dienthoai');
                $nhanvien->nv_trangThai =   $request->get('trangThai');
                $nhanvien->cv_ma        =   $request->get('chucvu');
                if($nhanvien->save()){
                    $nhanvien = Nhanvien::where('nv_ma', $nhanvien->nv_ma)->first();
                    $json = json_encode($nhanvien);
                    return response(['error'=>false, 'message'=>compact('nhanvien', 'json')], 200);
               }
            }

        } catch (QueryException $ex) {
            return response(["error"=>true, "message"=>$ex->getMessage()], 200);
        } catch (PDOException $ex) {
            return response(["error"=>true, "message"=>$ex->getMessage()], 200);
        }
    }

    public function update(Request $request, $id) // cập nhât vận chuyển
    {
        try{

            $nhanvien = Nhanvien::where('nv_ma', $id)->first();
            if($nhanvien){
                if($nhanvien->nv_email != $request->get('email')){

                    $rule = [ "email" => "unique:nhanvien,nv_email", ];
                    $message = [ "email.unique" => "Email đã được sử dụng!", ];
                    $validator = Validator::make($request->all(), $rule, $message);
                    if($validator->fails()){
                        return response()->json(['error'=>true, 'message'=>$validator->errors()]);
                    }else
                        $nhanvien->nv_email = $request->get('email');

                }
                if ($nhanvien->nv_dienThoai != $request->get('dienthoai')) {

                    $rule = ["dienthoai" => "unique:nhanvien,nv_dienThoai",];
                    $message = [ "dienthoai.unique" => "Số điện thoại đã được sử dụng",  ];
                    $validator = Validator::make($request->all(), $rule, $message);
                    if($validator->fails()){
                        return response()->json(['error'=>true, 'message'=>$validator->errors()]);
                    }else
                         $nhanvien->nv_dienThoai =  $request->get('dienthoai');
                }
                 
                $nhanvien->nv_hoTen     =   $request->get('ten');
                $nhanvien->nv_gioiTinh  =   $request->get('gioitinh');
                $nhanvien->nv_ngaySinh  =   $request->get('ngaysinh');
                $nhanvien->nv_diaChi    =   $request->get('diachi');
                $nhanvien->nv_trangThai =   $request->get('trangThai');
                $nhanvien->cv_ma        =   $request->get('chucvu');

                if($nhanvien->save()){
                    $nhanvien = Nhanvien::where('nv_ma', $nhanvien->nv_ma)->first();
                    $json = json_encode($nhanvien);
                    return response(['error'=>false, 'message'=>compact('nhanvien', 'json')], 200);
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

            $nhanvien = Nhanvien::where('nv_ma', $id)->first();
            if($nhanvien){

                if($nhanvien->delete())
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
           
            if(Nhanvien::destroy($request->items))
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
