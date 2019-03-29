<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tintuc extends Model {
    const     CREATED_AT    = 'tt_taoMoi';
    const     UPDATED_AT    = 'tt_capNhat';

    protected $table        = 'tintuc';
    protected $fillable     = ['tt_hinh', 'tt_tieuDe', 'tt_moTaNgan', 'tt_noiDung', 'nv_ma', 'tt_trangThai', 'tt_taoMoi', 'tt_capNhat'];
    protected $guarded      = ['tt_ma'];

    protected $primaryKey   = 'tt_ma';

    protected $dates        = ['tt_taoMoi', 'tt_capNhat'];
    protected $dateFormat   = 'Y-m-d H:i:s';
}