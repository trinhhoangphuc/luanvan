<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model {
    public    $timestamps   = false;

    protected $table        = 'cusc_users';
    protected $fillable     = ['id', 'birthday', 'role'];
    protected $guarded      = [];

    protected $primaryKey   = ;

    protected $dates        = ['birthday'];
    protected $dateFormat   = 'Y-m-d H:i:s';
}