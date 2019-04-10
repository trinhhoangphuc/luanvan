<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nhap extends Model {
    public    $timestamps   = false;

    protected $table        = 'nhap';
    protected $fillable     = ['sp_ma', 'n_soLuongNhap', 'n_soLuong', 'n_ngaySX', 'n_hanSD', 'hv_ma'];
    protected $guarded      = ['n_ma'];

    protected $primaryKey   = 'n_ma';

    protected $dates        = ['n_ngaySX', 'n_hanSD'];
    protected $dateFormat   = 'Y-m-d H:i:s';
}