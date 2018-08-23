<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Caixa extends Model
{
    protected $table = 'caixa';

    /**
     * Turmas relacionadas
     */
    public function movimentacao() {
        return $this->hasMany('App\Movimentacao');
    }
}
