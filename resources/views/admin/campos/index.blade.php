@extends('admin.layout')
@section('content')
<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    Lista de campos cadastrados 
                    <a href="{{route('admin.campos.create')}}" class="btn btn-sm btn-success pull-right" title="Novo" alt="Novo">
                        <i class="fa fa-plus"></i>
                    </a>
                  </div>
                  
                  <div class="card-body">
                    @if(Session::has('alert'))
                    <div class="alert alert-{{Session::get('alert')['type']}}" role="alert">{{Session::get('alert')['msg']}}</div>
                    @endif

                    @if(count($campos) > 0)
                    <table class="table table-responsive-sm table-hover table-outline mb-0">
                        <thead class="thead-light">
                        <tr>
                            <th>Nome</th>
                            <th>Estilo</th>
                            <th>Tipo</th>
                            <th>Ordem</th>
                            <th style="width: 10%;">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($campos as $campo)
                        <tr>
                            <td>
                                <div>{{$campo->name}}</div>
                            </td>
                            <td>
                            {{$campo->styleFormatted()}}
                            </td>
                            <td>
                            {{$campo->tipo->name}}
                            </td>
                            <td>
                            {{$campo->order}}
                            </td>
                            <td>
                                <form class="form-horizontal" action="{{route('admin.campos.destroy',['id' => $campo->id])}}" method="post">
                                    <a href="{{route('admin.campos.edit',['id' => $campo->id])}}" class="btn btn-primary" type="button" style="margin-bottom: 4px; width: 48%;">
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
                    <div class="alert alert-warning" role="alert">Nenhum campo encontrado. Por favor cadastre ao menos um.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection