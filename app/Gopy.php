<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gopy extends Model {
    const     CREATED_AT    = 'gy_taoMoi';
    const     UPDATED_AT    = 'gy_capNhat';

    protected $table        = 'gopy';
    protected $fillable     = ['gy_sao', 'gy_noiDung', 'kh_ma', 'sp_ma', 'gy_trangThai', 'gy_taoMoi', 'gy_capNhat'];
    protected $guarded      = ['gy_ma'];

    protected $primaryKey   = 'gy_ma';

    protected $dates        = ['gy_taoMoi', 'gy_capNhat'];
    protected $dateFormat   = 'Y-m-d H:i:s';
}