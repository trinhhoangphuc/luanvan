<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donhang extends Model {
    const     CREATED_AT    = 'dh_taoMoi';
    const     UPDATED_AT    = 'dh_capNhat';

    protected $table        = 'donhang';
    protected $fillable     = ['kh_ma', 'dh_nguoiNhan', 'dh_diaChi', 'dh_dienThoai', 'dh_daThanhToan', 'nv_xuLy', 'dh_nguoiXuLy', 'dh_ngayXuLy', 'dh_taoMoi', 'dh_capNhat', 'dh_trangThai', 'tt_ma', 'vc_ma', 'vc_gia', 'dh_tongTien'];
    protected $guarded      = ['dh_ma'];

    protected $primaryKey   = 'dh_ma';

    protected $dates        = ['dh_ngayXuLy', 'dh_taoMoi', 'dh_capNhat'];
    protected $dateFormat   = 'Y-m-d H:i:s';
}