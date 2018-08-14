<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campo extends Model
{
    protected $table = 'fields';

    public function tipo(){
        return $this->belongsTo('\App\Tipo', 'type_id');
    }

    public function styleFormatted(){
        switch($this->style){
            case 'date':
                $retorno = 'Data';
                break;
            case 'email':
                $retorno = 'Email';
                break;
            case 'number':
                $retorno = 'Número';
                break;
            case 'phone':
                $retorno = 'Telefone';
                break;
            case 'file':
                $retorno = 'Arquivo';
                break;
            default:
                $retorno = 'Texto';
        }

        return $retorno;
    }

    public function getValue($userId){
        $valor = Valor::where([
            'field_id' => $this->id,
            'user_id' => $userId
        ])->first();

        return (!empty($valor) ? $valor->value : null);
    }
}
