<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hinhanh extends Model {
    public    $timestamps   = false;

    protected $table        = 'hinhanh';
    protected $fillable     = ['sp_ma', 'ha_stt', 'ha_ten'];
    protected $guarded      = ['ha_ma'];

    protected $primaryKey   = 'ha_ma';}