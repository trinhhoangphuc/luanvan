<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chitiethoadon extends Model {
    public    $timestamps   = false;

    protected $table        = 'cusc_chitiethoadon';
    protected $fillable     = ['dh_ma', 'sp_ma', 'ctdh_soluong', 'ctdh_donGia'];
    protected $guarded      = ['ctdh_ma'];

    protected $primaryKey   = 'ctdh_ma';}