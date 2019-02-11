<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Migrations extends Model {
    public    $timestamps   = false;

    protected $table        = 'cusc_migrations';
    protected $fillable     = [];
    protected $guarded      = [];

    protected $primaryKey   = ;
    public    $incrementing = false;
}