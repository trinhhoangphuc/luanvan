<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hang extends Model {
    const     CREATED_AT    = 'h_taoMoi';
    const     UPDATED_AT    = 'h_capNhat';

    protected $table        = 'hang';
    protected $fillable     = ['h_ten', 'h_taoMoi', 'h_capNhat', 'h_trangThai'];
    protected $guarded      = ['h_ma'];

    protected $primaryKey   = 'h_ma';

    protected $dates        = ['h_taoMoi', 'h_capNhat'];
    protected $dateFormat   = 'Y-m-d H:i:s';
}