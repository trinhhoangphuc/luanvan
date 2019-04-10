<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Huongvi extends Model {
    const     CREATED_AT    = 'hv_taoMoi';
    const     UPDATED_AT    = 'hv_capNhat';

    protected $table        = 'huongvi';
    protected $fillable     = ['hv_ten', 'hv_taoMoi', 'hv_capNhat'];
    protected $guarded      = ['hv_ma'];

    protected $primaryKey   = 'hv_ma';

    protected $dates        = ['hv_taoMoi', 'hv_capNhat'];
    protected $dateFormat   = 'Y-m-d H:i:s';
}