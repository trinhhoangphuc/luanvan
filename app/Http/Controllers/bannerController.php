<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Support\MessageBag;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Banner;
use Illuminate\PHPImageWorkshop\ImageWorkshop;

class bannerController extends Controller
{
    public function index()
    {
		try{

    		$banner = Banner::orderBy("bn_capNhat", "desc")->get();
    		$json = json_encode($banner);
    		return response(["error"=>false, "message"=>compact("banner", "json")], 200);

    	}catch(QueryException $ex){
    		return response(["error"=>true, "message"=>$ex->getMessage()], 200);
    	}catch(PDOException $ex){
    		return response(["error"=>true, "message"=>$ex->getMessage()], 200);
    	}
    }

    public function store(Request $request)
    {
    	try{
            if($request->hasFile('bannerFile')){

            	$file = $request->file('bannerFile');

            	$dirImg  = __DIR__.'\..\..\..\public\images\banner\\';

            	$src= ImageWorkshop::initFromPath($file->getRealPath());
            	$src->resizeInPixel(1000, 400, false);

            	$createFolders = true;
            	$backgroundColor = null; 
            	$imageQuality = 80; 

            	$destFileName = time()."_".$file->getClientOriginalName();

            	$banner         = new Banner();
            	$banner->bn_hinh  = $destFileName;
            	$banner->bn_trangThai = $request->get("trangThai");
            	if($banner->save())
            	{
            		$src->save($dirImg, $destFileName, $createFolders, $backgroundColor, $imageQuality);
            		$banner = Banner::where('bn_ma', $banner->bn_ma)->first();
            		$json = json_encode($banner);
            		return response(["error"=>false, "message"=>compact("banner", "json")], 200);
            	}
	            	

            }else{
            	return response(["error"=>false, "message"=>false], 200);
            }	
    	}catch(QueryException $ex){
    		return response(["error"=>true, "message"=>$ex->getMessage()], 200);
    	}catch(PDOException $ex){
    		return response(["error"=>true, "message"=>$ex->getMessage()], 200);
    	}
    }

    public function update(Request $request, $id)
    {
    	try{
    		$banner = Banner::where('bn_ma', $id)->first();
            if($request->hasFile('bannerFile')){

            	$file = $request->file('bannerFile');

            	$dirImg  = __DIR__.'\..\..\..\public\images\banner\\';

            	$src= ImageWorkshop::initFromPath($file->getRealPath());
            	$src->resizeInPixel(1000, 400, false);

            	$createFolders = true;
            	$backgroundColor = null; 
            	$imageQuality = 80; 

            	$destFileName = time()."_".$file->getClientOriginalName();

            	$banner->bn_hinh  = $destFileName;
            	$banner->bn_trangThai = $request->get("trangThai");

            	if(file_exists(public_path('images/banner/'.$banner->bn_hinh)))
            		unlink(public_path('images/banner/'.$banner->bn_hinh));

            	if($banner->save())
            	{
            		$src->save($dirImg, $destFileName, $createFolders, $backgroundColor, $imageQuality);
            		$banner = Banner::where('bn_ma', $banner->bn_ma)->first();
            		$json = json_encode($banner);
            		return response(["error"=>false, "message"=>compact("banner", "json")], 200);
            	}
	            	
            }else{
            	$banner->bn_trangThai = $request->get("trangThai");
            	if($banner->save())
            	{
            		$banner = Banner::where('bn_ma', $banner->bn_ma)->first();
            		$json = json_encode($banner);
            		return response(["error"=>false, "message"=>compact("banner", "json")], 200);
	            }else{
	            	response(["error"=>false, "message"=>false], 200);
	            }
            }	
    	}catch(QueryException $ex){
    		return response(["error"=>true, "message"=>$ex->getMessage()], 200);
    	}catch(PDOException $ex){
    		return response(["error"=>true, "message"=>$ex->getMessage()], 200);
    	}
    }

    public function destroy($id) // xóa loại sản phẩm
    {
    	try{
            $banner = Banner::where('bn_ma', $id)->first();
            if($banner){
                
            	if(file_exists(public_path('images/banner/'.$banner->bn_hinh)))
            		unlink(public_path('images/banner/'.$banner->bn_hinh));

                if($banner->delete())
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
            foreach ($request->items as $key => $value) {
               $banner = Banner::where('bn_ma', $value)->first();
               if(file_exists(public_path('images/banner/'.$banner->bn_hinh)))
               		unlink(public_path('images/banner/'.$banner->bn_hinh));

            }            

        	if(Banner::destroy($request->items))
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
