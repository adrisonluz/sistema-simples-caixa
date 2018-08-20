<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Campo;
use App\Tipo;
use App\Valor;
use Session;
use Auth;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = User::todos()->where('id', '!=', Auth::user()->id)->get();

        return view('admin.usuarios.index')->with(compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $campos = Campo::all();
        $tipos = Tipo::all();

        return view('admin.usuarios.form')
        ->with([
            'campos' => $campos,
            'tipos' => $tipos,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $type = Tipo::find($request->get('type_id'));
        
        $usuario = new User;
        $usuario->name = $request->get('name');
        $usuario->email = $request->get('email');
        $usuario->type_id = $type->id;
        $usuario->permission = ($type->is_admin == 1 ? 'admin' : 'user');
        $usuario->password = ($request->has('password') ? bcrypt($request->get('password')) : null);

        if($usuario->save()){
            $camposIds = $request->except([
                'name',
                'email',
                'password',
                'password_confirm',
                'type_id',
                '_token'
            ]);
                
            foreach($camposIds as $campoId => $value){
                $campo = Campo::find($campoId);
                if($campo->style !== 'file'){
                    $valor = new Valor;
                    $valor->user_id = $usuario->id;
                    $valor->field_id = $campoId;
                    $valor->value = $value;
                    $valor->save();
                }
            }

            Session::flash('alert', ['type' => 'success', 'msg' => 'Usuário salvo com sucesso!']);
        } else {
            Session::flash('alert', ['type' => 'danger', 'msg' => 'Erro ao salvar usuario. Tente novamente mais tarde.']);
        }

        return redirect('admin/usuarios');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuario = User::find($id);
        $campos = Campo::all();
        $tipos = Tipo::all();

        return view('admin.usuarios.perfil')
        ->with([
            'usuario' => $usuario,
            'campos' => $campos,
            'tipos' => $tipos,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario = User::find($id);
        $campos = Campo::all();
        $tipos = Tipo::all();

        return view('admin.usuarios.form')
        ->with([
            'usuario' => $usuario,
            'campos' => $campos,
            'tipos' => $tipos,
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
        $usuario = User::find($id);
        $usuario->name = ($request->has('name') ? $request->get('name') : $usuario->name);
        $usuario->email = ($request->has('email') ? $request->get('email') : $usuario->email);
        $usuario->type_id = ($request->has('type_id') ? $request->get('type_id') : $usuario->type_id);
        $usuario->password = ($request->has('password') ? bcrypt($request->get('password')) : $usuario->password);

        if($usuario->save()){
            $camposIds = $request->except([
                'name',
                'email',
                'password',
                'password_confirm',
                'type_id',
                '_token',
                '_method'
            ]);

            foreach($camposIds as $campoId => $value){
                $campo = Campo::find($campoId);
                if($campo->style !== 'file'){
                    $valor = Valor::where([
                        'field_id' => $campoId,
                        'user_id' => $usuario->id
                    ])->first();

                    if(empty($valor)){
                        $valor = new Valor;
                        $valor->user_id = $usuario->id;
                        $valor->field_id = $campoId;
                    }

                    $valor->value = $value;
                    $valor->save();
                }
            }

            Session::flash('alert', ['type' => 'success', 'msg' => 'Usuário editado com sucesso!']);
        } else {
            Session::flash('alert', ['type' => 'danger', 'msg' => 'Erro ao editar usuario. Tente novamente mais tarde.']);
        }

        return redirect('admin/usuarios');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = User::find($id);

        if($usuario->delete()){
            $valores = Valor::where('user_id',$id)->delete();

            Session::flash('alert', ['type' => 'success', 'msg' => 'Usuário excluído com sucesso!']);
        } else {
            Session::flash('alert', ['type' => 'danger', 'msg' => 'Erro ao excluído usuario. Tente novamente mais tarde.']);
        }

        return redirect('admin/usuarios');
    }
}
