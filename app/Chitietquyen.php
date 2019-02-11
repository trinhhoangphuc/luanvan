<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chitietquyen extends Model {
    public    $timestamps   = false;

    protected $table        = 'chitietquyen';
    protected $fillable     = ['cv_ma', 'q_ma'];
    protected $guarded      = ['ctq_ma'];

    protected $primaryKey   = 'ctq_ma';}