<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chitiethuong extends Model {
    public    $timestamps   = false;

    protected $table        = 'chitiethuong';
    protected $fillable     = ['sp_ma', 'hv_ma'];
    protected $guarded      = ['cthv_ma'];

    protected $primaryKey   = 'cthv_ma';}