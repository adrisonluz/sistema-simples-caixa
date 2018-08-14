<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Campo;
use App\Tipo;
use Session;

class AdminCamposController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campos = Campo::orderBy('order','ASC')->get();

        return view('admin.campos.index')->with(compact('campos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipos = Tipo::orderBy('order','ASC')->get();;

        return view('admin.campos.form')->with(compact('tipos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $campo = new Campo;
        $campo->name = $request->get('name');
        $campo->type_id = $request->get('type_id');
        $campo->style = $request->get('style');
        $campo->description = $request->get('description');

        if($campo->save()){
            Session::flash('alert', ['type' => 'success', 'msg' => 'Campo salvo com sucesso!']);
        } else {
            Session::flash('alert', ['type' => 'danger', 'msg' => 'Erro ao salvar campo. Tente novamente mais tarde.']);
        }

        return redirect('admin/campos');
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
        $campo = Campo::find($id);
        $tipos = Tipo::orderBy('order','ASC')->get();;

        return view('admin.campos.form')
        ->with([
            'campo' => $campo, 
            'tipos' => $tipos
        ]);
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
        $campo = Campo::find($id);
        $campo->name = $request->get('name');
        $campo->type_id = $request->get('type_id');
        $campo->style = $request->get('style');
        $campo->description = $request->get('description');

        if($campo->save()){
            Session::flash('alert', ['type' => 'success', 'msg' => 'Campo salvo com sucesso!']);
        } else {
            Session::flash('alert', ['type' => 'danger', 'msg' => 'Erro ao salvar campo. Tente novamente mais tarde.']);
        }

        return redirect('admin/campos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $campo = Campo::find($id);

        if($campo->delete()){
            $valores = Valor::where('field_id',$id)->delete();

            Session::flash('alert', ['type' => 'success', 'msg' => 'Usuário excluído com sucesso!']);
        } else {
            Session::flash('alert', ['type' => 'danger', 'msg' => 'Erro ao excluir campo. Tente novamente mais tarde.']);
        }

        return redirect('admin/campos');
    }
}
