<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tipo;
use Session;

class AdminTiposController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipos = Tipo::orderBy('order','ASC')->get();;

        return view('admin.tipos.index')->with(compact('tipos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tipos.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tipo = new Tipo;
        $tipo->name = $request->get('name');
        $tipo->label = $request->get('label');
        $tipo->icon = $request->get('icon');
        $tipo->is_admin = ($request->has('is_admin') ? 1 : null);
        $tipo->description = $request->get('description');

        if($tipo->save()){
            Session::flash('alert', ['type' => 'success', 'msg' => 'Tipo salvo com sucesso!']);
        } else {
            Session::flash('alert', ['type' => 'danger', 'msg' => 'Erro ao salvar tipo. Tente novamente mais tarde.']);
        }

        return redirect('admin/tipos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipo = Tipo::find($id);

        return view('admin.tipos.form')->with('tipo', $tipo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tipo = Tipo::find($id);
        $tipo->name = $request->get('name');
        $tipo->label = $request->get('label');
        $tipo->icon = $request->get('icon');
        $tipo->is_admin = ($request->has('is_admin') ? 1 : null);
        $tipo->description = $request->get('description');

        if($tipo->save()){
            Session::flash('alert', ['type' => 'success', 'msg' => 'Tipo editado com sucesso!']);
        } else {
            Session::flash('alert', ['type' => 'danger', 'msg' => 'Erro ao editar tipo. Tente novamente mais tarde.']);
        }

        return redirect('admin/tipos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipo = Tipo::find($id);

        if($tipo->delete()){
            Session::flash('alert', ['type' => 'success', 'msg' => 'Tipo excluído com sucesso!']);
        } else {
            Session::flash('alert', ['type' => 'danger', 'msg' => 'Erro ao excluir tipo. Tente novamente mais tarde.']);
        }

        return redirect('admin/tipos');
    }
}
