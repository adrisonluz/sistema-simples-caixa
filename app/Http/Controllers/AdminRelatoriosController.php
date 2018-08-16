<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Campo;
use App\Tipo;
use App\Valor;
use Session;
use Auth;

class AdminRelatoriosController extends Controller
{
    public function reportAdmin()
    {
        $campos = Campo::all();
        $tipos = Tipo::all();

        return view('admin.relatorios.index')
        ->with([
            'campos' => $campos,
            'tipos' => $tipos,
            'type' => 'adm'
        ]);
    }

    public function reportFinancial()
    {
        $campos = Campo::all();
        $tipos = Tipo::all();

        return view('admin.relatorios.index')
        ->with([
            'campos' => $campos,
            'tipos' => $tipos,
            'type' => 'fin'
        ]);
    }

    public function send()
    {
        return view('admin.relatorios.view');
    }
}
