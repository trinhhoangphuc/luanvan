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
use Excel;

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
                $donhang->dh_daThanhToan = $request->get('thanhToan');
                if($donhang->dh_trangThai == 2 && $request->get('trangThai') != 2){
                    $donhang->dh_trangThai = $request->get('trangThai');
                    $chitiethoadon = Chitiethoadon::where("dh_ma", $donhang->dh_ma)->get();
                    foreach ($chitiethoadon as $key) {
                        $nhap = Nhap::find($key->n_ma);
                        $nhap->n_soLuong = $nhap->n_soLuong - $key->ctdh_soluong;
                        $nhap->save();  

                        $sanpham = Sanpham::find($nhap->sp_ma);
                        $sanpham->sp_soLuong = $sanpham->sp_soLuong - $key->ctdh_soluong;
                        $sanpham->save(); 
                    }
                }else if(($donhang->dh_trangThai == 1 || $donhang->dh_trangThai == 3) && $request->get('trangThai') == 2){
                    $donhang->dh_trangThai = $request->get('trangThai');
                    $chitiethoadon = Chitiethoadon::where("dh_ma", $donhang->dh_ma)->get();
                    foreach ($chitiethoadon as $key) {
                        $nhap = Nhap::find($key->n_ma);
                        $nhap->n_soLuong = $nhap->n_soLuong + $key->ctdh_soluong;
                        $nhap->save();  

                        $sanpham = Sanpham::find($nhap->sp_ma);
                        $sanpham->sp_soLuong = $sanpham->sp_soLuong + $key->ctdh_soluong;
                        $sanpham->save(); 
                    }
                }else{
                    $donhang->dh_trangThai = $request->get('trangThai');
                }

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
                GROUP BY l.l_ten ORDER BY giatri DESC
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

    public function sanPhamBanChay()
    {
        try {
            $duLieuThongKe = DB::select('
                SELECT sp.sp_ten, sum(ctdh.ctdh_soluong) as giatri
                FROM chitiethoadon as ctdh, sanpham as sp, loai as l, nhap as n
                Where ctdh.n_ma = n.n_ma AND n.sp_ma = sp.sp_ma 
                GROUP BY sp.sp_ten
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

    public function excelLoai() { 
        try {
          $name = time()."-Thong-ke-theo-loai";
          Excel::create($name, function($excel) {
            $excel->sheet('Thống kê theo loại', function($sheet) {
              $danhsach = DB::select('SELECT l.l_ten, sum(ctdh.ctdh_soluong) as giatri
                FROM chitiethoadon as ctdh, sanpham as sp, loai as l, nhap as n
                Where ctdh.n_ma = n.n_ma AND n.sp_ma = sp.sp_ma AND sp.l_ma = l.l_ma
                GROUP BY l.l_ten ORDER BY giatri DESC'
              ); 

              $data = [
                'danhsach' => $danhsach,
            ];

            $header = ['font' => [
                'name' =>  'Times New Roman',
                'size' =>  13,
                'bold' =>  true ]];


                $sheet->setCellValue('A1', "THỐNG KÊ THEO LOẠI"); 
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => [ 'name' => 'Times New Roman',
                    'size' => 20,
                    'bold' => true ]]);
                $sheet->mergeCells('A1:c1');
                $sheet->cells('A1', function($cells) {
                    $cells->setAlignment('center');
                    $cells->setFontColor('#76933C');
                    $cells->setValignment('center');
                });


                $sheet->getColumnDimension('A')->setAutoSize(true);
                $sheet->getColumnDimension('B')->setAutoSize(true);
                $sheet->getColumnDimension('C')->setAutoSize(true);
                $sheet->getStyle('A3')->applyFromArray($header);
                $sheet->getStyle('B3')->applyFromArray($header);
                $sheet->getStyle('C3')->applyFromArray($header);
                $sheet->setCellValue('A3', "STT"); 
                $sheet->setCellValue('B3', "Loại sản phẩm"); 
                $sheet->setCellValue('C3', "Giá trị"); 

                $sheet->cells('A3:C3', function($cells) {
                   
                    $cells->setAlignment('center');
                    $cells->setBackground('#9BBB59');
                    $cells->setFontColor('#ffffff');
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                    $cells->setValignment('center');
                });
                $i = 3;
                foreach ($danhsach as $key => $value) {

                    $i++;
                    $sheet->setCellValue('A'.$i, $i-3); 
                    $sheet->setCellValue('B'.$i, $value->l_ten); 
                    $sheet->setCellValue('C'.$i, $value->giatri); 
                    $sheet->cells('A'.$i.':'.'C'.$i, function($cells) {
                        $cells->setAlignment('center');
                        $cells->setValignment('center');
                    });
                }
            
            });
        })->download('xlsx');
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

    public function excelDoanhThu($id) { 
        try {
          $name = time()."-Thong-ke-doanh-thu-".$id;
          
          Excel::create($name, function($excel) use ($id) {
            $excel->sheet('THỐNG KÊ DOANH THU', function($sheet) use ($id) {
                
             $danhsach = DB::select("
                SELECT YEAR(dh_taoMoi)as nam, month(dh_taoMoi) as thang, count(dh_ma) as soluong, SUM(dh_tongTien) as giatri
                FROM donhang
                WHERE dh_trangThai = 3 AND dh_daThanhToan = 1  AND YEAR(dh_taoMoi)=$id
                GROUP by nam asc, thang asc"
              ); 
              $data = [ 'danhsach' => $danhsach, ];

              $header = ['font' => [
                'name' =>  'Times New Roman',
                'size' =>  13,
                'bold' =>  true ]];


                $sheet->setCellValue('A1', "THỐNG KÊ DOANH THU ".$id); 
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => [ 'name' => 'Times New Roman',
                    'size' => 20,
                    'bold' => true ]]);
                $sheet->mergeCells('A1:c1');
                $sheet->cells('A1', function($cells) {
                    $cells->setAlignment('center');
                    $cells->setFontColor('#76933C');
                    $cells->setValignment('center');
                });


                $sheet->getColumnDimension('A')->setAutoSize(true);
                $sheet->getColumnDimension('B')->setAutoSize(true);
                $sheet->getColumnDimension('C')->setAutoSize(true);
                $sheet->getStyle('A3')->applyFromArray($header);
                $sheet->getStyle('B3')->applyFromArray($header);
                $sheet->getStyle('C3')->applyFromArray($header);
                $sheet->setCellValue('A3', "STT"); 
                $sheet->setCellValue('B3', "Thời gian"); 
                $sheet->setCellValue('C3', "Doanh thu"); 

                $sheet->cells('A3:C3', function($cells) {
                    $cells->setAlignment('center');
                    $cells->setBackground('#9BBB59');
                    $cells->setFontColor('#ffffff');
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                    $cells->setValignment('center');
                });
                $i = 3;
                foreach ($danhsach as $key => $value) {

                    $i++;
                    $sheet->setCellValue('A'.$i, $i-3); 
                    $sheet->setCellValue('B'.$i, $value->thang.'-'.$value->nam); 
                    $sheet->setCellValue('C'.$i, $value->giatri); 
                    $sheet->cells('A'.$i.':'.'C'.$i, function($cells) {
                        $cells->setAlignment('center');
                        $cells->setValignment('center');
                    });
                }
            
            });
        })->download('xlsx');
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

     public function excelSPBC() { 
        try {
          $name = time()."-san-pham-ban-chay";
          Excel::create($name, function($excel) {
            $excel->sheet('Sản phẩm bán chạy', function($sheet) {
              $danhsach = DB::select('
                SELECT sp.sp_ten, sum(ctdh.ctdh_soluong) as giatri
                FROM chitiethoadon as ctdh, sanpham as sp, loai as l, nhap as n
                Where ctdh.n_ma = n.n_ma AND n.sp_ma = sp.sp_ma 
                GROUP BY sp.sp_ten
                '); 

              $data = [
                'danhsach' => $danhsach,
            ];

            $header = ['font' => [
                'name' =>  'Times New Roman',
                'size' =>  13,
                'bold' =>  true ]];


                $sheet->setCellValue('A1', "Sản Phẩm Bán Chạy"); 
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => [ 'name' => 'Times New Roman',
                    'size' => 20,
                    'bold' => true ]]);
                $sheet->mergeCells('A1:c1');
                $sheet->cells('A1', function($cells) {
                    $cells->setAlignment('center');
                    $cells->setFontColor('#76933C');
                    $cells->setValignment('center');
                });


                $sheet->getColumnDimension('A')->setAutoSize(true);
                $sheet->getColumnDimension('B')->setAutoSize(true);
                $sheet->getColumnDimension('C')->setAutoSize(true);
                $sheet->getStyle('A3')->applyFromArray($header);
                $sheet->getStyle('B3')->applyFromArray($header);
                $sheet->getStyle('C3')->applyFromArray($header);
                $sheet->setCellValue('A3', "STT"); 
                $sheet->setCellValue('B3', "Sản phẩm"); 
                $sheet->setCellValue('C3', "Số lượng bán"); 

                $sheet->cells('A3:C3', function($cells) {
                    $cells->setAlignment('center');
                    $cells->setBackground('#9BBB59');
                    $cells->setFontColor('#ffffff');
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                    $cells->setValignment('center');
                });
                $i = 3;
                foreach ($danhsach as $key => $value) {

                    $i++;
                    $sheet->setCellValue('A'.$i, $i-3); 
                    $sheet->setCellValue('B'.$i, $value->sp_ten); 
                    $sheet->setCellValue('C'.$i, $value->giatri); 
                    $sheet->cells('A'.$i.':'.'C'.$i, function($cells) {
                        $cells->setAlignment('center');
                        $cells->setValignment('center');
                        $cells->setBorder('solid', 'solid', 'solid', 'solid');
                    });
                }
            
            });
        })->download('xlsx');
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

    public function excelSPTK($id) { 
        try {
          $name = time()."-San-pham-ton-kho".$id;
          
          Excel::create($name, function($excel) use ($id) {
            $excel->sheet('Sản phẩm tồn kho', function($sheet) use ($id) {
                
             $danhsach = DB::select("
                SELECT nhap.*, huongvi.hv_ten, TIMESTAMPDIFF(MONTH,NOW(),n_hanSD) AS hansudung
                FROM  nhap, huongvi
                WHERE nhap.hv_ma = huongvi.hv_ma AND nhap.n_soLuong > 0 AND nhap.sp_ma = $id
                ORDER BY TIMESTAMPDIFF(MONTH,NOW(),n_hanSD)  asc"
              ); 

             $sanpham = DB::table("sanpham")->select('sp_ten')->where("sp_ma", $id)->first();

              $data = [ 'danhsach' => $danhsach, ];

              $header = ['font' => [
                'name' =>  'Times New Roman',
                'size' =>  13,
                'bold' =>  true ]];


                $sheet->setCellValue('A1', "Số lượng tồn kho sản phẩm ".$sanpham->sp_ten); 
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => [ 'name' => 'Times New Roman',
                    'size' => 20,
                    'bold' => true ]]);
                $sheet->mergeCells('A1:H1');
                $sheet->cells('A1', function($cells) {
                    $cells->setAlignment('center');
                    $cells->setFontColor('#76933C');
                    $cells->setValignment('center');
                });


                $sheet->getColumnDimension('A')->setAutoSize(true);
                $sheet->getColumnDimension('B')->setAutoSize(true);
                $sheet->getColumnDimension('C')->setAutoSize(true);
                $sheet->getColumnDimension('D')->setAutoSize(true);
                $sheet->getColumnDimension('E')->setAutoSize(true);
                $sheet->getColumnDimension('F')->setAutoSize(true);
                $sheet->getColumnDimension('G')->setAutoSize(true);
                $sheet->getColumnDimension('H')->setAutoSize(true);
                $sheet->getStyle('A3')->applyFromArray($header);
                $sheet->getStyle('B3')->applyFromArray($header);
                $sheet->getStyle('C3')->applyFromArray($header);
                $sheet->getStyle('D3')->applyFromArray($header);
                $sheet->getStyle('E3')->applyFromArray($header);
                $sheet->getStyle('F3')->applyFromArray($header);
                $sheet->getStyle('G3')->applyFromArray($header);
                $sheet->getStyle('H3')->applyFromArray($header);
                $sheet->setCellValue('A3', "Mã nhập"); 
                $sheet->setCellValue('B3', "Hương vị"); 
                $sheet->setCellValue('C3', "Ngày sản xuất"); 
                $sheet->setCellValue('D3', "Hạn sử dụng"); 
                $sheet->setCellValue('E3', "Số lượng nhập"); 
                $sheet->setCellValue('F3', "Tồn kho"); 
                $sheet->setCellValue('G3', "Ngày nhập"); 
                $sheet->setCellValue('H3', "Thời hạn"); 


                $sheet->cells('A3:H3', function($cells) {
                    $cells->setAlignment('center');
                    $cells->setBackground('#9BBB59');
                    $cells->setFontColor('#ffffff');
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                    $cells->setValignment('center');
                });
                $i = 3;
                foreach ($danhsach as $key => $value) {

                    $i++;
                    $sheet->setCellValue('A'.$i, $value->n_ma); 
                    $sheet->setCellValue('B'.$i, $value->hv_ten); 
                    $sheet->setCellValue('C'.$i, date('d-m-Y', strtotime($value->n_ngaySX))); 
                    $sheet->setCellValue('D'.$i, date('d-m-Y', strtotime($value->n_hanSD))); 
                    $sheet->setCellValue('E'.$i, $value->n_soLuongNhap); 
                    $sheet->setCellValue('F'.$i, $value->n_soLuong); 
                    $sheet->setCellValue('G'.$i, date('d-m-Y', strtotime($value->n_ngayNhap))); 
                    $sheet->setCellValue('H'.$i, $value->hansudung ." tháng"); 
                    $sheet->cells('A'.$i.':'.'H'.$i, function($cells) {
                        $cells->setAlignment('center');
                        $cells->setValignment('center');
                    });
                }
            
            });
        })->download('xlsx');
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

    public function getTotalOrder() { // get # /donhang/total
        try {
            $ds_donhang = DB::table("donhang")->get();
            return response([
                    'error'   => false,
                    'message' => $ds_donhang->count()
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
