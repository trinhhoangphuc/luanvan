<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diachi extends Model {
    public    $timestamps   = false;

    protected $table        = 'cusc_diachi';
    protected $fillable     = ['kh_ma', 'dc_md', 'dc_ten', 'dc_duong', 'dc_sdt'];
    protected $guarded      = ['dc_ma'];

    protected $primaryKey   = 'dc_ma';}