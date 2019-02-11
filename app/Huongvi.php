<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Huongvi extends Model {
    public    $timestamps   = false;

    protected $table        = 'huongvi';
    protected $fillable     = ['sp_ma', 'hv_ten'];
    protected $guarded      = ['hv_ma'];

    protected $primaryKey   = 'hv_ma';}