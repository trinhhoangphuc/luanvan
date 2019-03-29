<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Quản trị
Route::get('/admin/', function () {
	if(Session::has("admin_id"))
		return redirect(route("Indexadmin"));
	else
		return view('admin.login');	
})->name("login");

// đăng nhập admin
Route::post('/admin/login', "LoginAdminController@postLogin")->name("postlogin");

Route::get('/admin/logout', "LoginAdminController@postLogout")->name("postLogout");
//kết thúc đăng nhập

Route::group(["prefix" =>"admin", "middleware"=>"AdminLogin"], function(){

	
	Route::get('index', function () {
		return view('admin.index');
	})->name("Indexadmin");

	

	// Quản lý loại sản phẩm
	Route::get('loai', function () {
		if(in_array(2, Session::get("admin_q")))
			return view('admin.loai');
		else
			return(route("login"));
	})->name("QLloaisanpham");

	Route::group(["prefix" =>"loai"], function(){

		Route::get('danhsach',  'LoaiController@index'); // load dánh sách

		Route::get('checkExistName/{name}', 'LoaiController@checkExistName'); //kiểm tra trùng tên

		Route::post('store', "LoaiController@store");

		Route::post('update/{id}', "LoaiController@update"); 

		Route::delete('delete/{id}', "LoaiController@destroy");

		Route::post('deleteAll', "LoaiController@destroyAll");
	});
	// kết thúc

	// Quản lý nhà sản xuất
	Route::get('hang', function () {
		return view('admin.hang');
	})->name("QLnhasanxuat");

	Route::group(["prefix" =>"hang"], function(){

		Route::get('danhsach',  'HangController@index'); // load dánh sách

		Route::get('checkExistName/{name}', 'HangController@checkExistName'); //kiểm tra trùng tên

		Route::post('store', "HangController@store");

		Route::post('update/{id}', "HangController@update"); 

		Route::delete('delete/{id}', "HangController@destroy");

		Route::post('deleteAll', "HangController@destroyAll");
	});
	// kết thúc

	// Quản lý thanh toans
	Route::get('thanhtoan', function () {
		if(in_array(3, Session::get("admin_q")))
			return view('admin.thanhtoan');
		else
			return redirect(route("login"));
	})->name("QLthanhtoan");

	Route::group(["prefix" =>"thanhtoan"], function(){

		Route::get('danhsach',  'ThanhtoanController@index'); // load dánh sách

		Route::get('checkExistName/{name}', 'ThanhtoanController@checkExistName'); //kiểm tra trùng tên

		Route::post('store', "ThanhtoanController@store");

		Route::post('update/{id}', "ThanhtoanController@update"); 

		Route::delete('delete/{id}', "ThanhtoanController@destroy");

		Route::post('deleteAll', "ThanhtoanController@destroyAll");
	});
	// kết thúc

	// Quản lý vận chuyển
	Route::get('vanchuyen', function () {
		if(in_array(4, Session::get("admin_q")))
			return view('admin.vanchuyen');
		else
			return redirect(route("login"));
		
	})->name("QLvanchuyen");

	Route::group(["prefix" =>"vanchuyen"], function(){

		Route::get('danhsach',  'VanchuyenController@index'); // load dánh sách

		Route::get('checkExistName/{name}', 'VanchuyenController@checkExistName'); //kiểm tra trùng tên

		Route::post('store', "VanchuyenController@store");

		Route::post('update/{id}', "VanchuyenController@update"); 

		Route::delete('delete/{id}', "VanchuyenController@destroy");

		Route::post('deleteAll', "VanchuyenController@destroyAll");
	});
	// kết thúc

	// Quản lý sản phẩm
	Route::get('sanpham', function () {
		if(in_array(1, Session::get("admin_q")))
			return view('admin.sanpham');
		else
			return redirect(route("login"));
	})->name("QLsanpham");

	Route::group(["prefix" =>"sanpham"], function(){

		Route::get('danhsach',  'SanphamController@index'); // load dánh sách

		Route::get('checkExistName/{name}', 'SanphamController@checkExistName'); //kiểm tra trùng tên

		Route::post('store', "SanphamController@store")->name("storesanpham");

		Route::post('update/{id}', "SanphamController@update"); 

		Route::delete('delete/{id}', "SanphamController@destroy");

		Route::post('deleteAll', "SanphamController@destroyAll");

		Route::get("test/{id}", "SanphamController@test")->name("test");
	});
	// kết thúc

	// Quản lý  đánh giá

	Route::group(["prefix" =>"nhap"], function(){

		Route::get('danhsach/{id}',  'NhapController@index'); // load dánh sách

		Route::post('storeProduct/{id}', "NhapController@storeProduct");

		Route::post('updateProduct/{id}', "NhapController@updateProduct");

		Route::delete('deleteProduct/{id}', "NhapController@deleteProduct");

		// Route::post('store', "DanhgiaController@store");

		// Route::post('update/{id}', "DanhgiaController@update"); 

		// Route::delete('delete/{id}', "DanhgiaController@destroy");

		// Route::post('deleteAll', "DanhgiaController@destroyAll");
	});
	// kết thúc

	// Quản lý hình ảnh
	Route::group(["prefix" =>"hinhanh"], function(){

		Route::get('images/{id}',  'HinhanhController@images'); // load dánh sách

		Route::post('imagesUpload',  'HinhanhController@store');

		Route::post('updateImages',  'HinhanhController@setMainImg');

		Route::post('deleteImages',  'HinhanhController@deleteImg');

	});
	// Kết thúc

	// Quản lý hương vị
	Route::get('huongvi', function () {
		if(in_array(14, Session::get("admin_q")))
			return view('admin.huongvi');
		else
			return redirect(route("login"));
		
	})->name("QLhuongvi");

	Route::group(["prefix" =>"huongvi"], function(){

		Route::get('danhsach',  'HuongviController@index'); // load dánh sách

		Route::get('checkExistName/{name}', 'HuongviController@checkExistName'); //kiểm tra trùng tên

		Route::post('store', "HuongviController@store");

		Route::post('update/{id}', "HuongviController@update"); 

		Route::delete('delete/{id}', "HuongviController@destroy");

		Route::post('deleteAll', "HuongviController@destroyAll");

		Route::get('huongvibyid/{id}', "HuongviController@getHuongViById"); 
	});
	// kết thúc

	// Quản lý chi tiết hương vị
	Route::group(["prefix" =>"chitiethuongvi"], function(){

		Route::get('danhsach/{id}',  'ChitiethuongviController@index'); // load dánh sách

		Route::post('store/{id}', "ChitiethuongviController@store");

		Route::post('update/{id}', "ChitiethuongviController@update"); 

		Route::delete('delete/{id}', "ChitiethuongviController@destroy");

		Route::post('deleteAll', "ChitiethuongviController@destroyAll");
	});
	// kết thúc

	// Quản lý chức vụ
	Route::get('chucvu', function () {
		if(in_array(7, Session::get("admin_q")))
			return view('admin.chucvu');
		else
			return redirect(route("login"));
	})->name("QLchucvu");

	Route::group(["prefix" =>"chucvu"], function(){

		Route::get('danhsach',  'ChucvuController@index'); // load dánh sách

		Route::get('danhsachquyen',  'ChucvuController@quyen'); // load dánh sách

		Route::get('chitietquyen/{id_cv}',  'ChucvuController@getQuyenByIdCv'); // load dánh sách

		Route::post('themquyen/{id_cv}',  'ChucvuController@addQuyenByIdCv')->name("test"); // load dánh sách

		Route::get('checkExistName/{name}', 'ChucvuController@checkExistName'); //kiểm tra trùng tên

		Route::post('store', "ChucvuController@store")->name("test");

		Route::post('update/{id}', "ChucvuController@update"); 

		Route::delete('delete/{id}', "ChucvuController@destroy");

		Route::post('deleteAll', "ChucvuController@destroyAll");
	});
	// kết thúc

	// Quản lý nhân viên
	Route::get('nhanvien', function () {
		if(in_array(6, Session::get("admin_q")))
			return view('admin.nhanvien');
		else
			return redirect(route("login"));
	})->name("QLnhanvien");

	Route::group(["prefix" =>"nhanvien"], function(){

		Route::get('danhsach',  'NhanvienController@index'); // load dánh sách

		Route::post('store', "NhanvienController@store")->name('test');

		Route::post('update/{id}', "NhanvienController@update"); 

		Route::delete('delete/{id}', "NhanvienController@destroy");

		Route::post('deleteAll', "NhanvienController@destroyAll");
	});
	// kết thúc

	// // Quản lý nhà cung cấp 
	// Route::get('nhacungcap', function () {
	// 	if(in_array(6, Session::get("admin_q")))
	// 		return view('admin.nhacungcap');
	// 	else
	// 		return redirect(route("login"));
	// })->name("QLnhacungcap");

	// Route::group(["prefix" =>"nhacungcap"], function(){

	// 	Route::get('danhsach',  'NhacungcapController@index'); // load dánh sách

	// 	Route::post('store', "NhacungcapController@store");

	// 	Route::post('update/{id}', "NhacungcapController@update"); 

	// 	Route::delete('delete/{id}', "NhacungcapController@destroy");

	// 	Route::post('deleteAll', "NhacungcapController@destroyAll");
	// });
	// // kết thúc

	// Quản lý nhà khách hàng
	Route::get('khachhang', function () {
		if(in_array(8, Session::get("admin_q")))
			return view('admin.khachhang');
		else
			return redirect(route("login"));
	})->name("QLkhachhang");

	Route::group(["prefix" =>"khachhang"], function(){

		Route::get('danhsach',  'KhachhangController@index'); // load dánh sách

		Route::post('store', "KhachhangController@store");

		Route::post('update/{id}', "KhachhangController@update"); 

		Route::post('updatePassword/{id}', "KhachhangController@updatePassword"); 

		Route::delete('delete/{id}', "KhachhangController@destroy");

		Route::post('deleteAll', "KhachhangController@destroyAll");
	});
	// kết thúc

	// Quản lý  đánh giá
	Route::get('danhgia', function () {
		if(in_array(12, Session::get("admin_q")))
			return view('admin.danhgia');
		else
			return redirect(route("login"));
	})->name("QLdanhgia");

	Route::group(["prefix" =>"danhgia"], function(){

		Route::get('danhsach',  'DanhgiaController@index'); // load dánh sách

		Route::post('store', "DanhgiaController@store");

		Route::post('update/{id}', "DanhgiaController@update"); 

		Route::delete('delete/{id}', "DanhgiaController@destroy");

		Route::post('deleteAll', "DanhgiaController@destroyAll");
	});
	// kết thúc

	// Quản lý  Banner
	Route::get('banner', function () {
		if(in_array(13, Session::get("admin_q")))
			return view('admin.banner');
		else
			return redirect(route("login"));	
	})->name("QLbanner");

	Route::group(["prefix" =>"banner"], function(){

		Route::get('danhsach',  'bannerController@index'); // load dánh sách

		Route::post('store', "bannerController@store")->name("postStoreBanner");

		Route::post('update/{id}', "bannerController@update"); 

		Route::delete('delete/{id}', "bannerController@destroy");

		Route::post('deleteAll', "bannerController@destroyAll");
	});
	// kết thúc

	// Quản lý  Banner
	Route::get('donhang', function () {
		if(in_array(9, Session::get("admin_q")))
			return view('admin.donhang');
		else
			return redirect(route("login"));
		
	})->name("QLdonhang");

	Route::group(["prefix" =>"donhang"], function(){

		Route::get('danhsach',  'DonhangController@index'); // load dánh 

		Route::get('totalOrder',  'DonhangController@totalOrder'); // load dánh 

		Route::get('danhsachchitiet/{id}',  'DonhangController@getCTDHbyId');

		// Route::post('store', "DonhangController@store");

		Route::post('update/{id}', "DonhangController@update"); 

		Route::delete('delete/{id}', "DonhangController@destroy");

		Route::post('deleteAll', "DonhangController@destroyAll");

		Route::get('hoadon/{id}',  'DonhangController@getDonHangById');

		Route::get('orderMonth',  'DonhangController@donhang_thang');

		Route::get('inhoadon',  function () {
			return view('admin.hoadon');
		}); // load dánh 
	});
	// kết thúc

	// Quản lý  khuyến mãi
	Route::get('khuyenmai', function () {
		
		if(in_array(11, Session::get("admin_q")))
			return view('admin.khuyenmai');
		else
			return redirect(route("login"));
	})->name("QLkhuyenmai");

	Route::group(["prefix" =>"khuyenmai"], function(){

		Route::get('danhsach',  'KhuyenmaiController@index'); // load dánh 

		Route::post('store', "KhuyenmaiController@store");

		Route::post('update/{id}', "KhuyenmaiController@update"); 

		Route::get('danhsachSPbyIdLoai/{id}',  'KhuyenmaiController@danhsachSPbyIdLoai'); 

		Route::get('chitietkhuyenmai/{id}',  'KhuyenmaiController@chitietkhuyenmai');

		Route::get('deleteChitietkhuyenmai/{id}',  'KhuyenmaiController@deleteChitietkhuyenmai');

		Route::post('storeChitietkhuyenmai/{id}', "KhuyenmaiController@storeChitietkhuyenmai"); 

		Route::post('updateChitietkhuyenmai/{id}', "KhuyenmaiController@updateChitietkhuyenmai");
		
		Route::delete('delete/{id}', "KhuyenmaiController@destroy");

		// Route::post('deleteAll', "bannerController@destroyAll");
	});
	// kết thúc

	Route::group(["prefix" =>"thongke"], function(){

		Route::get('theonam', function () {

			if(in_array(10, Session::get("admin_q")))
				return view('admin.thongketheonam');
			else
				return redirect(route("login"));
		})->name("TKnam");

		Route::get('orderYeah',  'DonhangController@donhang_nam');

		Route::get('theoloai', function () {

			if(in_array(10, Session::get("admin_q")))
				return view('admin.thongketheoloai');
			else
				return redirect(route("login"));
		})->name("TKloai");

		Route::get('orderLoai',  'DonhangController@thongkeLoai');

	});

});
// kết thúc quản trị

// khách hàng

Route::get('/', function () {
		return redirect(route('homepage'));	
});

Route::get('/index', "HomepageController@index")->name("homepage");

Route::get('/tat-ca-san-pham', "HomepageController@getAllProducts")->name("getAllProducts");

Route::get('/chi-tiet-san-pham/{id}',"HomepageController@getProductDetail")->name("detail");

Route::get('/danh-muc/{id}',"HomepageController@getProductsByIdLoai")->name("Category");

Route::get('/nha-san-xuat/{id}',"HomepageController@getProductsByIdNSX")->name("Brand");

Route::get('/loc-du-lieu/{maLoai}/{maChude}/{giaTu}/{giaDen}',"HomepageController@getFilterProducts");

Route::post('/dang-nhap',"HomepageController@postLogin");

Route::get('/dang-xuat',"HomepageController@getLogout");

Route::post('/dang-ky',"HomepageController@postRegister");

Route::post('/dang-ky-2',"HomepageController@postRegister_2");

Route::post('/danh-gia/{id}', "HomepageController@postRate")->name("rate");

Route::get('/thong-tin-ca-nhan', "HomepageController@getProfile")->name("profile");

Route::post('/postProfile', "HomepageController@postProfile")->name("postProfile");

Route::post('/doi-mat-khau', "HomepageController@postPass")->name("postPass");

Route::get('/them-gio-hang/{id}', "HomepageController@addToCart");

Route::get('/them-gio-hang-2/{id}/{qty}/{mahuong}', "HomepageController@addToCart_2");

Route::get('/so-luong-gio-hang', "HomepageController@getQualityCart");

Route::get('/gio-hang', "HomepageController@getCart")->name("getCart");

Route::get('/detroyCart', "HomepageController@detroyCart")->name("detroyCart");

Route::post('/updateCart/{id}', "HomepageController@updateCart")->name("updateCart");

Route::get('/deleteCart/{id}', 'HomepageController@deleteCart')->name("deleteCart");

Route::get('/dang-nhap', 'HomepageController@loginToPay')->name("loginToPay");

Route::get('/thanh-toan', 'HomepageController@payment')->name("payment");

Route::post('/post-thanh-toan', 'HomepageController@postpayment')->name("postPayment");

Route::get('/chi-tiet-don-hang/{id}', 'HomepageController@orderDetail')->name("reviewOrder");

Route::get('/thanh-toan-thanh-cong/{id}', 'HomepageController@paymentSuccess')->name("paymentSucess");

Route::get("/getAllProductsToSearch/{name}", "HomepageController@getAllProductsToSearch");

Route::get("/searchProduct/{name}", "HomepageController@searchProduct");

Route::get("/searchProduct/{name}", "HomepageController@searchProduct");


Route::get('/404', function () {
		return view("error.404");	
})->name("error404");
// kết thúc khách hàng