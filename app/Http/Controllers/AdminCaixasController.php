<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use App\Caixa;
use App\Movimentacao;
use App\Usuario;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Auth;
use Carbon\Carbon;

class AdminCaixasController extends Controller {
    public function index() {
        return redirect('admin/caixas/extrato');
    }

    public function extrato() {
        $caixas = Caixa::all();
        $caixaAberto = Caixa::where(['date' => Carbon::now()->toDateString(), 'end_balance' => null])->first();

        return view('admin.caixas.index')->with([
            'caixas' => $caixas
            'caixa_aberto' => $caixaAberto
        ]);
    }

    public function create() {
        $caixasHoje = Caixa::where(['date' => Carbon::now()->toDateString()])->get();
        $caixaMae = Caixa::where(['date' => Carbon::now()->toDateString()])->first();
        
        $caixaAberto = Caixa::where(['date' => Carbon::now()->toDateString(), 'end_balance' => null])->first();

        if (count($caixaAberto) > 0) {
            return redirect('admin/caixas/' . $caixaAberto->id);
        }

        return view('admin.caixas.form')->with([
            'caixasHoje' => $caixasHoje,
            'caixaMae' => $caixaMae
        ]);
    }

    public function store(Request $request) {
        $rules = array(
            'date' => 'required',
            'start_hour' => 'required',
            'opening_balance' => 'required',
        );

        $validator = Validator($request->all(), $rules);

        if ($validator->fails()) {
            return redirect('admin/caixas/create')
                            ->withErrors($validator)
                            ->withInput($request->all());
        } else {
            $caixa = new Caixa;
            $caixa->caixa_id = $request->get('caixa_id');
            $caixa->date = $request->get('date');
            $caixa->start_hour = $request->get('start_hour');
            $caixa->opening_balance = $request->get('opening_balance');
            $caixa->save();

            Session::flash('success', 'Caixa aberto com sucesso!');
            return redirect('admin/caixas/extrato');
        }
    }

    public function show($id) {
        $caixa = Caixa::find($id);
        $caixasRelacionados = Caixa::where(['date' => $caixa->date])->get();
        $entradas = Movimentacao::where(['type' => 'entry', 'caixa_id' => $id])->get();
        $saidas = Movimentacao::where(['type' => 'output', 'caixa_id' => $id])->get();
        $usuarios = User::all();

        $saldoParcial = new Movimentacao;
        $saldo = $saldoParcial->getSaldo($caixa->id);

        return view('admin.caixas.perfil')->with([
            'caixa' => $caixa,
            'saldo' => number_format($saldo, 2, '.', ''),
            'entradas' => $entradas,
            'caixasRelacionados' => $caixasRelacionados,
            'saidas' => $saidas,
            'usuarios' => $usuarios
        ]);
    }

    public function edit($id) {
        $caixa = Caixa::find($id);

        $professores = User::where(['nivel' => 'aluno_prof', 'lixeira' => null])->get();
        $usuarios = User::where(['nivel' => 'aluno', 'lixeira' => null])->get();
        $cursos = Curso::all();

        if ($turma) {
            return view('admin/caixas/editar')->with([
                'turma' => $turma,
                'alunos' => $alunos,
                'professores' => $professores,
                'cursos' => $cursos
            ]);
        } else {
            Session::flash('error', 'Turma não encontrada!');
            return redirect('admin/caixas');
        }
    }

    public function update(Request $request, $id) {
        $rules = array(
            'date' => 'required',
            'start_hour' => 'required',
            'opening_balance' => 'required',
        );

        $validator = Validator($request->all(), $rules);

        if ($validator->fails()) {
            return redirect('admin/caixas/edit/' . $id)
                            ->withErrors($validator)
                            ->withInput($request->all());
        } else {
            $turma = Caixa::finc($id);
            $turma->end_hour = $request->get('end_hour');
            $turma->end_balance = $request->get('end_balance');
            $turma->total_entries = $request->get('total_entries');
            $turma->total_outputs = $request->get('total_outputs');
            $turma->save();

            Session::flash('success', 'Caixa fechado com sucesso!');
            return redirect('admin/caixas');
        }
    }

    public function fechar(Request $request, $id) {
        $caixa = Caixa::find($id);
        $caixa->end_hour = date('H:i');

        $mov = new Movimentacao;
        $caixa->end_balance = $mov->getSaldo($id);
        $caixa->total_entries = $mov->getEntradas($id);
        $caixa->total_outputs = $mov->getSaidas($id);
        $caixa->save();

        Session::flash('success', 'Caixa fechado com sucesso!');
        return redirect('admin/caixas/extrato');
    }

    public function destroy($id) {
        //
    }

}
