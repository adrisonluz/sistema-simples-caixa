<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $usuariosAtivos = User::ativos()->get();
        $usuariosInativos = User::inativos()->get();

        return view('admin.dashboard')
            ->with([
                'usuariosAtivos' => $usuariosAtivos,
                'usuariosInativos' => $usuariosInativos
            ]);
    }
}
