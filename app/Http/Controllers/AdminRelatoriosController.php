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

    public function send(Request $request)
    {
        $created_date_ini = $request->get('created_date_ini');
        $created_date_end = $request->get('created_date_end');
        $deleted_date_ini = $request->get('deleted_date_ini');
        $deleted_date_end = $request->get('deleted_date_end');
        $status = $request->get('status');
        $where = $request->get('where');
        $where = $request->get('where');
        $value = $request->get('value');

        return view('admin.relatorios.view');
    }
}
