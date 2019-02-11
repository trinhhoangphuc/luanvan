<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Khachhang extends Model {
    const     CREATED_AT    = 'kh_taoMoi';
    const     UPDATED_AT    = 'kh_capNhat';

    protected $table        = 'khachhang';
    protected $fillable     = ['kh_email', 'kh_matKhau', 'kh_hoTen', 'kh_diaChi', 'kh_dienThoai', 'kh_taoMoi', 'kh_capNhat', 'kh_trangThai', 'kh_gioiTinh'];
    protected $guarded      = ['kh_ma'];

    protected $primaryKey   = 'kh_ma';

    protected $dates        = ['kh_taoMoi', 'kh_capNhat'];
    protected $dateFormat   = 'Y-m-d H:i:s';
}