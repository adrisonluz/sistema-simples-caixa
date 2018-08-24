<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Caixa;

class Movimentacao extends Model
{
    protected $table = 'movimentacao';

    /**
     * Caixa relacionado
     */
    public function caixa() {
        return $this->belongsTo('App\Caixa', 'caixa_id');
    }

    public function getSaldo($id){
        // Calcula o saldo parcial
        $caixa = Caixa::find($id);
        $entradas = $this->getEntradas($id);
        $saidas = $this->getSaidas($id);
        
        $saldo = (number_format(str_replace(',', '.', $caixa->opening_balance), 2, '.', '')) + $entradas - $saidas;
        return $saldo;
    }

    public function getEntradas($id){
        $entradas = Movimentacao::where(['caixa_id' => $id, 'type' => 'entry'])->get();

        $entradaParcial = 0;
        if(count($entradas) > 0 ){
            foreach($entradas as $valEntrada){
                $entradaParcial += (number_format(str_replace(',', '.', $valEntrada->value), 2, '.', ''));
            }
        }

        return $entradaParcial;
    }

    public function getSaidas($id){
        $saidas = Movimentacao::where(['caixa_id' => $id, 'type' => 'output'])->get();

        $saidaParcial = 0;
        if(count($saidas) > 0 ){
            foreach($saidas as $valSaida){
                $saidaParcial += (number_format(str_replace(',', '.', $valSaida->value), 2, '.', ''));
            }
        }

        return $saidaParcial;
    }
}
