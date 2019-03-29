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
use App\Nhanvien;
use DB;
use Session;
use Illuminate\PhpVnDataGenerator\VnBigNumber;

class DonhangController extends Controller
{
    public function index() //load danh sách
    {
    	try{

    		$donhang = Donhang::select("donhang.*", "thanhtoan.tt_ten", "vanchuyen.vc_ten")
    					->join("thanhtoan", "thanhtoan.tt_ma", "donhang.tt_ma")
    					->join("vanchuyen", "vanchuyen.vc_ma", "donhang.vc_ma")
    					->orderBy("donhang.dh_ma", "desc")->get();
    		$json = json_encode($donhang);
    		return response(["error"=>false, "message"=>compact("donhang", "json")], 200);

    	}catch(QueryException $ex){
    		return response(["error"=>true, "message"=>$ex->getMessage()], 200);
    	}catch(PDOException $ex){
    		return response(["error"=>true, "message"=>$ex->getMessage()], 200);
    	}
    }

    public function totalOrder() //load danh sách
    {
        try{

            $ds_donhang = DB::table("donhang")->where('dh_trangThai', '0')->get();
            return response([
                  'error'   => false,
                  'message' => $ds_donhang->count()
                ], 200);

        }catch(QueryException $ex){
            return response(["error"=>true, "message"=>$ex->getMessage()], 200);
        }catch(PDOException $ex){
            return response(["error"=>true, "message"=>$ex->getMessage()], 200);
        }
    }

    

    public function getCTDHbyId($id) // kiểm tra trùng tên
    {
    	try{

    		$chitietdon = Chitiethoadon::select("chitiethoadon.*", "sanpham.sp_ten", "sanpham.sp_hinh", "huongvi.hv_ten")
    					->where("dh_ma", $id)
                        ->join("nhap", "nhap.n_ma", "chitiethoadon.n_ma")
                        ->join("huongvi", "huongvi.hv_ma", "nhap.hv_ma")
    					->join("sanpham", "sanpham.sp_ma", "nhap.sp_ma")
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
                $donhang->nv_xuLy = Session::get('admin_id');
                $donhang->dh_ngayXuLy = date('Y-m-d H:i:s');
                $donhang->dh_nguoiXuLy = Session::get('admin_name');
                $donhang->dh_trangThai = $request->get('trangThai');
                $donhang->dh_daThanhToan = $request->get('thanhToan');
                $donhang->save();
                $donhang = Donhang::select("donhang.*", "thanhtoan.tt_ten", "vanchuyen.vc_ten")
                        ->join("thanhtoan", "thanhtoan.tt_ma", "donhang.tt_ma")
                        ->join("vanchuyen", "vanchuyen.vc_ma", "donhang.vc_ma")
                        ->where('dh_ma', $id)
                        ->orderBy("donhang.dh_ma", "desc")->first();
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

    public function getDonHangById($id) { // get # /donhang/info/{id}
        try {
            $donhang = Donhang::where("dh_ma", $id)->first();
            if ($donhang == null) {
                return response([
                    'error'   => true,
                    'message' => "Không tìm thấy donhang[{$id}]"
                ], 200);
            } else {

                $khachHang = $donhang->dh_nguoiNhan;
                $dienThoai = $donhang->dh_dienThoai;
                $diaChi    = $donhang->dh_diaChi;
                $ngayLap   = $donhang->dh_ngayXuLy;
                $nv = Nhanvien::where("nv_ma", $donhang->nv_xuLy)->first();
                $lapHoaDon = $nv->nv_hoTen;

                $ctdh = DB::select('SELECT c.sp_ten as ten, a.ctdh_soluong as soluong, a.ctdh_donGia as dongia
                                    FROM `chitiethoadon` a, `nhap` b, `sanpham` c
                                    WHERE a.n_ma=b.n_ma AND b.sp_ma=c.sp_ma AND a.dh_ma = '.$donhang->dh_ma.' 
                                    ORDER BY ten');
                $tongSL = 0;
                $tongTT = $donhang->dh_tongTien;
                $tongTTChu = VnBigNumber::ToString($tongTT."");
                $duLieuThongKe = [
                    "soHoaDon"  => $id,
                    "khachHang" => $khachHang,
                    "dienThoai" => $dienThoai,
                    "diaChi"    => $diaChi,
                    "ngayLap"   => $ngayLap,
                    "lapHoaDon" => $lapHoaDon,
                    "ctdh"      => $ctdh,
                    "tongSL"    => $tongSL,
                    "phiVC"     => $donhang->vc_gia,
                    "tongTT"    => $tongTT,
                    "tongTTChu" => $tongTTChu
                ];
                $json          = json_encode($duLieuThongKe);
                return response([
                    'error'   => false,
                    'message' => compact("duLieuThongKe", "json")
                ], 200);
            }
        } catch(QueryException $ex) {
            return response([
                    'error'   => true,
                    'message' => $ex->getMessage()
                ], 200);
        } catch (PDOException  $ex) {
            return response([
                    'error'   => true,
                    'message' => $ex->getMessage()
                ], 200);
        }
    }

    public function donhang_thang() { // get # /donhang/thang
        try {
            $duLieuThongKe = DB::select('
                SELECT YEAR(dh_taoMoi)as nam, month(dh_taoMoi) as thang, count(dh_ma) as soluong, SUM(dh_tongTien) as giatri
                FROM donhang
                WHERE dh_trangThai = 3 AND dh_daThanhToan = 1  AND YEAR(dh_taoMoi)=year(now())
                GROUP by nam asc, thang asc
            ');
            $json = json_encode($duLieuThongKe);
            return response([
                    'error'   => false,
                    'message' => compact("duLieuThongKe", "json")
                ], 200);

        } catch(QueryException $ex) {
            return response([
                    'error'   => true,
                    'message' => $ex->getMessage()
                ], 200);
        } catch (PDOException  $ex) {
            return response([
                    'error'   => true,
                    'message' => $ex->getMessage()
                ], 200);
        }
    }

     public function donhang_nam() { // get # /donhang/thang
        try {
            $duLieuThongKe = DB::select('
                SELECT YEAR(dh_taoMoi)as nam, month(dh_taoMoi) as thang, count(dh_ma) as soluong, SUM(dh_tongTien) as giatri
                FROM donhang
                WHERE dh_trangThai = 3 AND dh_daThanhToan = 1
                GROUP by nam asc, thang asc
            ');
            $json = json_encode($duLieuThongKe);
            return response([
                    'error'   => false,
                    'message' => compact("duLieuThongKe", "json")
                ], 200);

        } catch(QueryException $ex) {
            return response([
                    'error'   => true,
                    'message' => $ex->getMessage()
                ], 200);
        } catch (PDOException  $ex) {
            return response([
                    'error'   => true,
                    'message' => $ex->getMessage()
                ], 200);
        }
    }

    public function thongkeLoai()
    {
        try {
            $duLieuThongKe = DB::select('
                SELECT l.l_ten, sum(ctdh.ctdh_soluong) as giatri
                FROM chitiethoadon as ctdh, sanpham as sp, loai as l, nhap as n
                Where ctdh.n_ma = n.n_ma AND n.sp_ma = sp.sp_ma AND sp.l_ma = l.l_ma
                GROUP BY l.l_ten
            ');

            $json = json_encode($duLieuThongKe);
            return response([
                    'error'   => false,
                    'message' => compact("duLieuThongKe", "json")
                ], 200);

        } catch(QueryException $ex) {
            return response([
                    'error'   => true,
                    'message' => $ex->getMessage()
                ], 200);
        } catch (PDOException  $ex) {
            return response([
                    'error'   => true,
                    'message' => $ex->getMessage()
                ], 200);
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
