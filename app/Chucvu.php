<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chucvu extends Model {
    const     CREATED_AT    = 'cv_taoMoi';
    const     UPDATED_AT    = 'cv_capNhat';

    protected $table        = 'chucvu';
    protected $fillable     = ['cv_ten', 'cv_quyen', 'cv_taoMoi', 'cv_capNhat', 'cv_trangThai'];
    protected $guarded      = ['cv_ma'];

    protected $primaryKey   = 'cv_ma';

    protected $dates        = ['cv_taoMoi', 'cv_capNhat'];
    protected $dateFormat   = 'Y-m-d H:i:s';
}