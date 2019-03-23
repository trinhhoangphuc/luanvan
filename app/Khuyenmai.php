<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Khuyenmai extends Model {
    const     CREATED_AT    = 'km_taoMoi';
    const     UPDATED_AT    = 'km_capNhat';

    protected $table        = 'khuyenmai';
    protected $fillable     = ['km_ten', 'km_moTaNgan','km_noiDung', 'km_batDau', 'km_ketThuc', 'nv_nguoiLap', 'km_ngayLap', 'km_taoMoi', 'km_capNhat', 'km_trangThai'];
    protected $guarded      = ['km_ma'];

    protected $primaryKey   = 'km_ma';

    protected $dates        = ['km_batDau', 'km_ketThuc', 'km_ngayLap', 'km_taoMoi', 'km_capNhat'];
    protected $dateFormat   = 'Y-m-d H:i:s';
}