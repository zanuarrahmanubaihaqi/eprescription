<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $table = 'user_level';
    protected $primaryKey = 'level';

    public function user() {
      return $this->hasOne(User::class);
    }
}
