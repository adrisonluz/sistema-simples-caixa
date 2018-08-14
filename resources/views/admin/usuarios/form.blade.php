@extends('admin.layout')
@section('content')
<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div id="accordion">
                    @if(count($tipos) > 0)
                    @foreach($tipos as $tipo)
                        @if(!isset($usuario) || ($usuario->type_id == $tipo->id))
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" data-toggle="collapse" data-target="#tipo{{$tipo->id}}" aria-expanded="true" aria-controls="collapseOne">
                                    <i class="fa {{$tipo->icon}}"></i> {{$tipo->name}}
                                    </button>
                                </h5>
                            </div>
                            
                            <div id="tipo{{$tipo->id}}" class="collapse {{(isset($usuario) && $usuario->type_id == $tipo->id ? 'show' : '')}}" aria-labelledby="headingOne" data-parent="#accordion">
                                @if(count($tipo->campos) > 0)
                                <form class="form-horizontal" action="{{(isset($usuario) ? route('admin.usuarios.update', ['id' => $usuario->id, 'type_id' => $tipo->id]) : route('admin.usuarios.store', ['type_id' => $tipo->id]))}}" method="post">
                                    @if(isset($usuario))
                                    <input type="hidden" name="_method" value="put" />
                                    @endif
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="type_id" value="{{$tipo->id}}">
                                    
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="name">Nome</label>
                                            <input class="form-control" id="name" name="name" value="{{$usuario->name or ''}}">
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input class="form-control" id="email" name="email" value="{{$usuario->email or ''}}">
                                        </div>

                                        @if($tipo->is_admin == 1)
                                        <div class="form-group">
                                            <label for="password">Senha</label>
                                            <input type="password" class="form-control" id="password" name="password" value="">
                                        </div>

                                        <div class="form-group">
                                            <label for="password_confirm">Confirmação de senha</label>
                                            <input type="password" class="form-control" id="password_confirm" name="password_confirm" value="">
                                        </div>
                                        @endif

                                        @foreach($tipo->campos as $campo)
                                            <div class="form-group">
                                                <label for="{{$campo->id}}">{{$campo->name}}</label>
                                                <input class="form-control" id="{{$campo->id}}" type="{{$campo->style}}" name="{{$campo->id}}" value="{{(!empty($usuario) ? $campo->getValue($usuario->id) : '')}}">
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="card-footer">
                                        <button class="btn btn-sm btn-primary" type="submit">
                                        <i class="fa fa-dot-circle-o"></i> Enviar</button>
                                        <button class="btn btn-sm btn-danger" type="reset">
                                        <i class="fa fa-ban"></i> Limpar</button>
                                    </div>
                                </form>
                                @else
                                <div class="card-body">      
                                    <div class="alert alert-warning" role="alert">Nenhum campo encontrado. Por favor cadastre ao menos um.</div>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endif
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection