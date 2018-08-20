<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Configuracao;
use Session;
use Auth;

class AdminConfiguracoesController extends Controller
{
    public function index(){
    	$configuracoes = Configuracao::all();

        return view('admin.configuracoes.form')
        ->with(compact('configuracoes'));
    }

    public function save(){
    	$configuracoes = Configuracao::all();

        return view('admin.configuracoes.form')
        ->with(compact('configuracoes'));
    }
}
