<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'loging';
    protected $primaryKey = 'id';

    public $guarded = [];

    public $timestamps = false;
}
