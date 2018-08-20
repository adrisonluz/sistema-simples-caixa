@extends('admin.layout')
@section('content')
<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Relatório administrativo
                    </div>

                    <form class="form-horizontal" action="{{route('admin.relatorios.emitir', ['type' => $relTipo])}}" method="post">  
                        <div class="card-body">
                            @if(Session::has('alert'))
                            <div class="alert alert-{{Session::get('alert')['type']}}" role="alert">{{Session::get('alert')['msg']}}</div>
                            @endif
                        
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_type" value="{{$relTipo}}">

                            <h4>Selecione os campos desejados que serão exibidos no relatório:</h4>
                            @foreach($tipos as $tipo)
                            <div class="form-group row">
                                <div class="col-md-12 col-form-label">
                                    <div class="form-check form-check-inline mr-1">
                                        <!--input data-tipo="{{$tipo->id}}" class="form-check-input" id="{{$tipo->id}}" type="checkbox" value="{{$tipo->id}}" name="search_types[]"-->
                                        <label class="form-check-label" for="{{$tipo->id}}"><i class="fa {{$tipo->icon}}"></i> {{$tipo->name}}</label>
                                    </div>                 
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <div class="col-md-12 col-form-label">
                                    @if(count($tipo->campos) > 0)
                                    @foreach($tipo->campos as $campo)
                                    <div class="form-check form-check-inline mr-1">
                                        <input data-tipo="{{$tipo->id}}" class="form-check-input" id="{{$campo->id}}" type="checkbox" value="{{$campo->id}}" name="search_fields[]">
                                        <label class="form-check-label" for="{{$campo->id}}">{{$campo->name}}</label>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>
                            </div>

                            <hr>
                            @endforeach

                            <h4>Filtro:</h4>

                            <div class="form-group row">
                                <div class="col-md-4 col-form-label">
                                    <label for="created_date">Data de cadastro:</label>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <input type="date" class="form-control" id="created_date_ini" name="created_date_ini" value="">
                                        </div>

                                        <div class="col-sm-6">
                                            <input type="date" class="form-control" id="created_date_end" name="created_date_end" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 col-form-label">
                                    <label for="deleted_date">Data de exclusão:</label>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <input type="date" class="form-control" id="deleted_date_ini" name="deleted_date_ini" value="">
                                        </div>

                                        <div class="col-sm-6">
                                            <input type="date" class="form-control" id="deleted_date_end" name="deleted_date_end" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 col-form-label">
                                    <label for="status">Status:</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="">Todos</option>
                                        <option value="active">Ativos</option>
                                        <option value="inative">Inativos</option>
                                    </select>
                                </div>
                            </div>

                            @if(isset($tipos) && count($tipos) > 0)
                            <hr>

                            <h4>Avançado:</h4>

                            <div class="form-group row">
                                <div class="col-md-4 col-form-label">
                                    <label for="_where">Onde ...</label>
                                    <select class="form-control" id="_where" name="_where" size="5" multiple="">
                                        @foreach($tipos as $tipo)
                                        <optgroup label="{{$tipo->name}}">
                                            @foreach($tipo->campos as $campo)
                                            <option value="{{$campo->id}}">{{$campo->name}}</option>
                                            @endforeach
                                        </optgroup>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4 col-form-label">
                                    <label for="_for">For ...</label>
                                    <select class="form-control" id="_for" name="_for">
                                        <option value="=">Igual à</option>
                                        <option value="<>">Diferente de</option>
                                        <option value="LIKE">Parecido com</option>
                                        <option value=">">Maior que</option>
                                        <option value="<">Menor que</option>
                                    </select>
                                </div>

                                <div class="col-md-4 col-form-label">
                                    <label for="_value">Valor ...</label>
                                    <input type="text" class="form-control" id="_value" name="_value" value="">
                                </div>
                            </div>
                            @endif
                        </div>

                        <div class="card-footer">
                            <button class="btn btn-sm btn-primary" type="submit">
                            <i class="fa fa-dot-circle-o"></i> Emitir</button>
                            <button class="btn btn-sm btn-danger" type="reset">
                            <i class="fa fa-ban"></i> Reset</button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>
@endsection