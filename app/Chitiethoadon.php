<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chitiethoadon extends Model {
    public    $timestamps   = false;

    protected $table        = 'chitiethoadon';
    protected $fillable     = ['dh_ma', 'ctdh_soluong', 'ctdh_donGia', 'n_ma'];
    protected $guarded      = ['ctdh_ma'];

    protected $primaryKey   = 'ctdh_ma';}