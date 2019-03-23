<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chitietkhuyenmai extends Model {
    public    $timestamps   = false;

    protected $table        = 'chitietkhuyenmai';
    protected $fillable     = ['km_ma', 'sp_ma', 'kmsp_giaTri', 'kmsp_trangThai'];
    protected $guarded      = ['ctkm_ma'];

    protected $primaryKey   = 'ctkm_ma';}