<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sanpham extends Model {
    const     CREATED_AT    = 'sp_taoMoi';
    const     UPDATED_AT    = 'sp_capNhat';

    protected $table        = 'sanpham';
    protected $fillable     = ['sp_ten', 'sp_giaBan', 'sp_giamGia', 'sp_hinh', 'sp_anh360', 'sp_thongTin', 'sp_danhGia', 'sp_tinhTrang', 'sp_taoMoi', 'sp_capNhat', 'sp_trangThai', 'l_ma', 'h_ma'];
    protected $guarded      = ['sp_ma'];

    protected $primaryKey   = 'sp_ma';

    protected $dates        = ['sp_taoMoi', 'sp_capNhat'];
    protected $dateFormat   = 'Y-m-d H:i:s';
}