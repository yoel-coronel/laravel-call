<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TiendaApi extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at','created_at','updated_at'];

    protected $fillable = ['tienda_id','api_token','nombre','url_api','message'];
}
