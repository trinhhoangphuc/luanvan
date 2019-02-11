<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gopy extends Model {
    public    $timestamps   = false;

    protected $table        = 'gopy';
    protected $fillable     = ['gy_sao', 'gy_noiDung', 'kh_ma', 'sp_ma', 'gy_trangThai'];
    protected $guarded      = ['gy_ma'];

    protected $primaryKey   = 'gy_ma';
}