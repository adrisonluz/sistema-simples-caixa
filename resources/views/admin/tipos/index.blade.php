@extends('admin.layout')
@section('content')
<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    Lista de tipos cadastrados 
                    <a href="{{route('admin.tipos.create')}}" class="btn btn-sm btn-success pull-right" title="Novo" alt="Novo">
                        <i class="fa fa-plus"></i>
                    </a>
                  </div>
                  
                  <div class="card-body">
                    @if(Session::has('alert'))
                    <div class="alert alert-{{Session::get('alert')['type']}}" role="alert">{{Session::get('alert')['msg']}}</div>
                    @endif

                    @if(count($tipos) > 0)
                    <table class="table table-responsive-sm table-hover table-outline mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>Nome</th>
                                <th>Label</th>
                                <th>Icone</th>
                                <th>Admin</th>
                                <th style="width: 10%;">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tipos as $tipo)
                            <tr>
                                <td>
                                    <div>{{$tipo->name}}</div>
                                </td>
                                <td>
                                {{$tipo->label}}
                                </td>
                                <td>
                                    <i class="fa {{$tipo->icon or ''}}" style="font-size: 30px;"></i>
                                </td>
                                <td>
                                    {{($tipo->is_admin == 1 ? 'Sim' : 'Não')}}
                                </td>
                                <td>
                                    <form class="form-horizontal" action="{{route('admin.tipos.destroy',['id' => $tipo->id])}}" method="post">
                                        <a href="{{route('admin.tipos.edit',['id' => $tipo->id])}}" class="btn btn-primary" type="button" style="margin-bottom: 4px; width: 48%;">
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
                    <div class="alert alert-warning" role="alert">Nenhum tipo encontrado. Por favor cadastre ao menos um.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection