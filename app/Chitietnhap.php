<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chitietnhap extends Model {
    public    $timestamps   = false;

    protected $table        = 'chitietnhap';
    protected $fillable     = ['pn_ma', 'sp_ma', 'ctn_soLuong', 'ctn_donGia', 'sp_ngaySX', 'sp_hanSD', 'sp_tonKho', 'ctn_thanhTien'];
    protected $guarded      = ['ctn_ma'];

    protected $primaryKey   = 'ctn_ma';

    protected $dates        = ['sp_ngaySX', 'sp_hanSD', 'sp_tonghanSD'];
    protected $dateFormat   = 'Y-m-d H:i:s';
}