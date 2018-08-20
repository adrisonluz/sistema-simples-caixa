<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Campo;
use App\Tipo;
use App\Valor;
use Session;
use Auth;
use Carbon\Carbon;

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
            'relTipo' => 'adm'
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
            'relTipo' => 'fin'
        ]);
    }

    public function send(Request $request)
    { 
        $search_fields = $request->get('search_fields');

        $_type = $request->get('_type');
        $_where = $request->get('_where');
        $_for = $request->get('_for');
        $_value = $request->get('_value');

        $created_date_ini = $request->get('created_date_ini');
        $created_date_end = $request->get('created_date_end');
        $deleted_date_ini = $request->get('deleted_date_ini');
        $deleted_date_end = $request->get('deleted_date_end');
        $status = $request->get('status');

        switch ($_type) {
            case 'adm':
                $search_types = $request->get('search_types');
                $search_fields = $request->get('search_fields');
                
                $data = User::whereNotNull('id');
                break;
            
            case 'fin':
                # code...
                break;
        }

        if($status && $status == 'inative'){
            $data->inativos();

            if($deleted_date_ini){
                $data->where('deleted_at','>', Carbon::parse($deleted_date_ini)->startOfDay());
            }

            if($deleted_date_end){
                $data->where('deleted_at','<', Carbon::parse($deleted_date_end)->endOfDay());
            }
        } elseif (!$status){
            $data->todos();
        }

        if($created_date_ini){
            $data->where('created_at','>', Carbon::parse($created_date_ini)->startOfDay());
        }

        if($deleted_date_end){
            $data->where('created_at','<', Carbon::parse($deleted_date_end)->endOfDay());
        }

        if($_where && (!empty($_for) && !empty($_value))){
            if($_for == 'LIKE'){
                $_value = '%' . $_value . '%';
            }

            $usuariosIds = Valor::where('value', "like", $_value)->where('field_id', $_where)->pluck('user_id');
            $data->whereIn('id', $usuariosIds);
        }

        $tipos = Tipo::with(array('campos' => function($query) use ($search_fields){
            $query->whereIn('fields.id', $search_fields);
        }))->get();
        
        return view('admin.relatorios.' . $_type)
        ->with([
            'data' => $data->get(),
            'tipos' => $tipos
        ]);
    }
}
