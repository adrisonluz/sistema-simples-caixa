<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Valor extends Model
{
    protected $table = 'values';

    public function campo(){
        return $this->belongsTo('\App\Campo', 'field_id');
    }
}
