<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    protected $table = 'types';

    public function campos(){
        return $this->hasMany('\App\Campo', 'type_id');
    }
}
