<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hinhanh;
use App\Sanpham;
use Illuminate\Database\QueryException;
use Illuminate\PHPImageWorkshop\ImageWorkshop;

class Hinhanhcontroller extends Controller
{
    public function images($id)
    {
    	try{

    		$hinhanh = Hinhanh::where("sp_ma", $id)->get();
    		$json = json_encode($hinhanh);
    		return response(["error"=>false, "message"=>compact('hinhanh', "json")], 200);

    	}catch(QueryException $ex){
    		return response(["error"=>true, "message"=>$ex->getMessage()], 200);
    	}catch(PDOException $ex){
    		return response(["error"=>true, "message"=>$ex->getMessage()], 200);
    	}
    }

    public function sttHinhMoi($sp_ma){
        $hinhanh = Hinhanh::where("sp_ma", $sp_ma)->orderBy('ha_stt', 'DESC')->first();
        $stt = !$hinhanh? 0: $hinhanh["ha_stt"];
        return ++$stt;
    }

    public function store(Request $request)
    {
        try{

            $file =  $request->file('file');
              
                $dirImg  = __DIR__.'\..\..\..\public\images\products\\';
                $pathWM =  $dirImg.'logo2.png';

                $src= ImageWorkshop::initFromPath($file->getRealPath());
                $wm = ImageWorkshop::initFromPath($pathWM);
                $src->resizeInPixel(400, 400, false);
                $src->addLayerOnTop($wm, 10, 10, "RB");

                $createFolders = true;
                $backgroundColor = null; 
                $imageQuality = 80; 

                $currentFileName = $file->getClientOriginalName();
                $part  = explode("_",$currentFileName);
                $sp_ma = $part[0];
                $sp_ten = $part[1];

                $order = $this->sttHinhMoi($sp_ma);

                $destFileName = $sp_ma."_".$order."_".rand(100, 99999)."_".$sp_ten;

                $hinhanh         = new Hinhanh();
                $hinhanh->sp_ma  = $sp_ma;
                $hinhanh->ha_ten = $destFileName;
                $hinhanh->ha_stt = $order;
                $hinhanh->save();

                $src->save($dirImg, $destFileName, $createFolders, $backgroundColor, $imageQuality);

                return response(["error"=>false, "message"=>true], 200);
        
        }catch(QueryException $ex){
            return response(["error"=>true, "message"=>$ex->getMessage()], 200);
        }catch(PDOException $ex){
            return response(["error"=>true, "message"=>$ex->getMessage()], 200);
        }
    }

    public function setMainImg(Request $request)
    {
        try
        {

            $hinhanh = Hinhanh::where("ha_ma", $request->ha_ma)->first();
            if(!$hinhanh){
                $sanpham_hinh = "noimage.jpg";
            }else{
                $sanpham = Sanpham::where("sp_ma", $request->sp_ma)->first();
                if($sanpham){
                    $sanpham->sp_hinh = $hinhanh->ha_ten;
                    $sanpham->save();
                    $sanpham_hinh = $sanpham->sp_hinh;
                }
            }

            return $sanpham_hinh;

        }catch(QueryException $ex){
            return response(["error"=>true, "message"=>$ex->getMessage()], 200);
        }catch(PDOException $ex){
            return response(["error"=>true, "message"=>$ex->getMessage()], 200);
        }
    }

    public function deleteImg(Request $request)
    {
        try
        {   
            $sanpham_hinh = "";
            
            $hinhanh = Hinhanh::where("ha_ma", $request->ha_ma)->first();
            if($hinhanh){

                $sanpham = Sanpham::where("sp_ma", $request->sp_ma)->first();
                if($sanpham){
                    if($sanpham->sp_hinh == $hinhanh->ha_ten)
                    {
                        $sanpham->sp_hinh = "noimage.jpg";
                        $sanpham->save();
                        $sanpham_hinh = "noimage.jpg";
                    }
                }

                if(file_exists(public_path('images/products/'.$hinhanh->ha_ten)))
                    unlink(public_path('images/products/'.$hinhanh->ha_ten));
                
                $hinhanh->delete();
                
            }

            return $sanpham_hinh;

        }catch(QueryException $ex){
            return response(["error"=>true, "message"=>$ex->getMessage()], 200);
        }catch(PDOException $ex){
            return response(["error"=>true, "message"=>$ex->getMessage()], 200);
        }
    }
}
