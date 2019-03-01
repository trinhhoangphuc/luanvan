<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model {
    const     CREATED_AT    = 'bn_taoMoi';
    const     UPDATED_AT    = 'bn_capNhat';

    protected $table        = 'banner';
    protected $fillable     = ['bn_hinh', 'bn_km', 'bn_trangThai', 'bn_taoMoi', 'bn_capNhat'];
    protected $guarded      = ['bn_ma'];

    protected $primaryKey   = 'bn_ma';

    protected $dates        = ['bn_taoMoi', 'bn_capNhat'];
    protected $dateFormat   = 'Y-m-d H:i:s';
}