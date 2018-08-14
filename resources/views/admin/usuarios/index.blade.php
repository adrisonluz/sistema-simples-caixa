@extends('admin.layout')
@section('content')
<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Lista de usuários cadastrados
                        <a href="{{route('admin.usuarios.create')}}" class="btn btn-sm btn-success pull-right" title="Novo" alt="Novo">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                  
                  <div class="card-body">
                    @if(Session::has('alert'))
                        <div class="alert alert-{{Session::get('alert')['type']}}" role="alert">{{Session::get('alert')['msg']}}</div>
                    @endif

                    @if(count($usuarios) > 0)
                    <table class="table table-responsive-sm table-hover table-outline mb-0">
                        <thead class="thead-light">
                            <tr>
                                <!--th class="text-center">
                                    <i class="icon-people"></i>
                                </th-->
                                <th>Nome</th>
                                <th>Email</th>
                                <th class="text-center">Tipo</th>
                                <th>Status</th>
                                <th style="width: 10%;">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($usuarios as $usuario)
                            <tr>
                                <!--td class="text-center">
                                    <div class="avatar">
                                        <img class="img-avatar" src="{{asset('img/avatars/1.jpg')}}" alt="admin@bootstrapmaster.com">
                                    </div>
                                </td-->
                                <td>
                                <div>{{$usuario->name}}</div>
                                <div class="small text-muted">
                                    {{--<span>New</span> | Registered: Jan 1, 2015</div>--}}
                                </td>
                                <td>
                                    {{$usuario->email}}
                                </td>
                                <td class="text-center">
                                    <i class="fa {{$usuario->tipo->icon}}" style="font-size:24px"></i>
                                </td>
                                <td>
                                    <strong>Ativo</strong>
                                </td>
                                <td>
                                    <form class="form-horizontal" action="{{route('admin.usuarios.destroy',['id' => $usuario->id])}}" method="post">
                                        <a href="{{route('admin.usuarios.edit',['id' => $usuario->id])}}" class="btn btn-primary" type="button" style="margin-bottom: 4px; width: 48%;">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <input type="hidden" name="_method" value="delete" />
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button class="btn btn-danger" style="margin-bottom: 4px; width: 48%;">
                                            <i class="fa fa-trash-o"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="alert alert-warning" role="alert">Nenhum usuário encontrado. Por favor cadastre ao menos um.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection