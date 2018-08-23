<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Caixa;
use App\Movimentacao;
use App\Usuario;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Auth;
use Carbon\Carbon;

class AdminCaixasController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return redirect('admin/caixas/extrato');
    }

    public function extrato() {
        $caixas = Caixa::all();
        
        return view('admin.caixas.index')->with(compact('caixas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $caixasHoje = Caixa::where(['date' => Carbon::now()->toDateString()])->get();
        //$data->where('deleted_at','>', Carbon::parse($deleted_date_ini)->startOfDay());
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $rules = array(
            'date' => 'required',
            'hora_abertura' => 'required',
            'saldo_inicial' => 'required',
        );

        $validator = Validator($request->all(), $rules);

        if ($validator->fails()) {
            return redirect($this->area . '/create')
                            ->withErrors($validator)
                            ->withInput($request->all());
        } else {
            // store
            $caixa = new Caixa;
            $caixa->caixa_id = $request->get('caixa_id');
            $caixa->date = $request->get('date');
            $caixa->hora_abertura = $request->get('hora_abertura');
            $caixa->saldo_inicial = $request->get('saldo_inicial');

            $caixa->save();

            // redirect
            Session::flash('success', 'Caixa aberto com sucesso!');
            return redirect($this->area . '/extrato');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $caixa = Caixa::find($id);
        $caixasRelacionados = Caixa::where(['date' => $caixa->date])->get();
        $entradas = Movimentacao::where(['tipo' => 'entrada', 'caixa_id' => $id])->get();
        $saidas = Movimentacao::where(['tipo' => 'saida', 'caixa_id' => $id])->get();
        $alunos = Usuario::where(['nivel' => 'aluno', 'lixeira' => null])->get();

        $saldoParcial = new Movimentacao;
        $saldo = $saldoParcial->getSaldo($caixa->id);

        $pageTitle = 'Caixa - ' . $caixa->date;

        $this->arrayReturn += [
            'caixa' => $caixa,
            'saldo' => number_format($saldo, 2, '.', ''),
            'entradas' => $entradas,
            'caixasRelacionados' => $caixasRelacionados,
            'saidas' => $saidas,
            'alunos' => $alunos,
            'page_title' => $pageTitle,
            'mapList' => $this->mapList
        ];

        return view($this->area . '.perfil', $this->arrayReturn);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $caixa = Caixa::find($id);

        $professores = Usuario::where(['nivel' => 'aluno_prof', 'lixeira' => null])->get();
        $alunos = Usuario::where(['nivel' => 'aluno', 'lixeira' => null])->get();
        $cursos = Curso::all();

        $pageTitle = 'Usuários - Editar: ' . $turma->curso->nome . ' | ' . $turma->professor->nome;
        $this->mapList[] = array('nome' => 'Editar', 'icon' => 'fa-edit', 'link' => '/' . $this->area . '/' . $id . '/edit');

        if ($turma) {
            $this->arrayReturn += [
                'turma' => $turma,
                'alunos' => $alunos,
                'professores' => $professores,
                'cursos' => $cursos,
                'page_title' => $pageTitle,
                'mapList' => $this->mapList
            ];

            return view($this->area . '/editar', $this->arrayReturn);
        } else {
            Session::flash('error', 'Turma não encontrada!');
            return redirect($this->area);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $rules = array(
            'date' => 'required',
            'hora_abertura' => 'required',
            'saldo_inicial' => 'required',
        );

        $validator = Validator($request->all(), $rules);

        if ($validator->fails()) {
            return redirect($this->area . '/edit/' . $id)
                            ->withErrors($validator)
                            ->withInput($request->all());
        } else {
            // store
            $turma = Caixa::finc($id);
            $turma->hora_fechamento = $request->get('hora_fechamento');
            $turma->saldo_final = $request->get('saldo_final');
            $turma->total_entradas = $request->get('total_entradas');
            $turma->total_saidas = $request->get('total_saidas');

            $turma->save();

            // redirect
            Session::flash('success', 'Caixa fechado com sucesso!');
            return redirect($this->area);
        }
    }

    public function fechar(Request $request, $id) {

        // store
        $caixa = Caixa::find($id);
        $caixa->hora_fechamento = date('H:i');

        $mov = new Movimentacao;
        $caixa->saldo_final = $mov->getSaldo($id);
        $caixa->total_entradas = $mov->getEntradas($id);
        $caixa->total_saidas = $mov->getSaidas($id);

        $caixa->save();

        // redirect
        Session::flash('success', 'Caixa fechado com sucesso!');
        return redirect('caixa/extrato');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
