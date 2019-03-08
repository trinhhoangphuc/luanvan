<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Support\MessageBag;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Donhang;
use App\Sanpham;
use App\Chitiethoadon;
use App\Nhap;

class DonhangController extends Controller
{
    public function index() //load danh sách
    {
    	try{

    		$donhang = Donhang::select("donhang.*", "thanhtoan.tt_ten", "vanchuyen.vc_ten")
    					->join("thanhtoan", "thanhtoan.tt_ma", "donhang.tt_ma")
    					->join("vanchuyen", "vanchuyen.vc_ma", "donhang.vc_ma")
    					->orderBy("dh_taoMoi", "desc")->get();
    		$json = json_encode($donhang);
    		return response(["error"=>false, "message"=>compact("donhang", "json")], 200);

    	}catch(QueryException $ex){
    		return response(["error"=>true, "message"=>$ex->getMessage()], 200);
    	}catch(PDOException $ex){
    		return response(["error"=>true, "message"=>$ex->getMessage()], 200);
    	}
    }

    public function getCTDHbyId($id) // kiểm tra trùng tên
    {
    	try{

    		$chitietdon = Chitiethoadon::select("chitiethoadon.*", "sanpham.sp_ten", "sanpham.sp_hinh")
    					->where("dh_ma", $id)
    					->join("sanpham", "sanpham.sp_ma", "chitiethoadon.sp_ma")
    					->get();
    		$json = json_encode($chitietdon);
    		return response(["error"=>false, "message"=>compact("chitietdon", "json")], 200);

    	}catch(QueryException $ex){
    		return response(["error"=>true, "message"=>$ex->getMessage()], 200);
    	}catch(PDOException $ex){
    		return response(["error"=>true, "message"=>$ex->getMessage()], 200);
    	}
    }

    

     public function update(Request $request, $id) // cập nhât loại sản phẩm
    {
        try{
            $donhang = Donhang::where('dh_ma', $id)->first();
            if($donhang){
                $donhang->dh_trangThai = $request->get('trangThai');
                $donhang->dh_daThanhToan = $request->get('thanhToan');
                $donhang->save();
                $donhang = Donhang::where('dh_ma', $id)->first();
                $json = json_encode($donhang);
                return response(['error'=>false, 'message'=>compact('donhang', 'json')], 200);
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
            $donhang = Donhang::where('dh_ma', $id)->first();
            if($donhang){
                $ctdh = Chitiethoadon::where("dh_ma", $donhang->dh_ma)->get();
                if($ctdh){
                    foreach ($ctdh as $key) {
                        $nhap = Nhap::where("n_ma", $key->n_ma)->first();
                        $nhap->n_soLuong +=  $key->ctdh_soluong;
                        $nhap->save();
                    }
                }
                if($donhang->delete())
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

    // public function destroyAll(Request $request)
    // {
    //     try {
    //         foreach ($request->items as $key => $value) {
    //            $sanpham = Sanpham::where('dh_ma', $value)->get();
    //             if($sanpham){
    //                 foreach ($sanpham as $key1 => $value1) {
    //                     $hinhanh = Hinhanh::where('sp_ma', $value1['sp_ma'])->get();
    //                     if($hinhanh){
    //                         foreach ($hinhanh as $key2 => $value2) {
    //                             if(file_exists(public_path('images/products/'.$value2['ha_ten'])))
    //                                 unlink(public_path('images/products/'.$value2['ha_ten']));
    //                         }
    //                     }
    //                 }
    //             }
    //         }            

    //     	if(hang::destroy($request->items))
    //     		return response(['error'=>false, 'message'=>true], 200);
    //     	else
    //     		return response(['error'=>false, 'message'=>false], 200);

    //      }catch(QueryException $ex){
    //         return response(['error'=>true, 'message'=>$ex->getMessage()], 200);
    //     }catch(PDOException $ex){
    //         return response(['error'=>true, 'message'=>$ex->getMessage()], 200);
    //     }
    // }
}
