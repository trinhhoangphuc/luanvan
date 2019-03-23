<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sanphamkhuyenmai extends Model {
    public    $timestamps   = false;

    protected $table        = 'sanphamkhuyenmai';
    protected $fillable     = ['sp_ma', 'km_ma'];
    protected $guarded      = ['spkm_ma'];

    protected $primaryKey   = 'spkm_ma';}