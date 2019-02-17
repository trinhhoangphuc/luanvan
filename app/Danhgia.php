<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Danhgia extends Model {
    const     CREATED_AT    = 'dg_taoMoi';
    const     UPDATED_AT    = 'dg_capNhat';

    protected $table        = 'danhgia';
    protected $fillable     = ['dg_sao', 'sp_ma', 'kh_ma', 'dg_taoMoi', 'dg_capNhat', 'dg_trangThai', 'dg_noiDung'];
    protected $guarded      = ['dg_ma'];

    protected $primaryKey   = 'dg_ma';

    protected $dates        = ['dg_taoMoi', 'dg_capNhat'];
    protected $dateFormat   = 'Y-m-d H:i:s';
}