<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Khuyenmai extends Model {
    public    $timestamps   = false;

    protected $table        = 'cusc_khuyenmai';
    protected $fillable     = [];
    protected $guarded      = [];

    protected $primaryKey   = ;
    public    $incrementing = false;
}