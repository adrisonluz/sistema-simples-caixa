@extends('admin.layout')
@section('content')
<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    Cadastrar novo tipo
                  </div>
                    <form class="form-horizontal" action="{{(isset($tipo) ? route('admin.tipos.update', ['id' => $tipo->id]) : route('admin.tipos.store'))}}" method="post">
                        @if(isset($tipo))
                        <input type="hidden" name="_method" value="put" />
                        @endif
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="card-body">                            
                            <div class="form-group">
                                <label for="nome">Nome</label>
                                <input class="form-control" id="nome" placeholder="Nome Completo" type="text" name="name" value="{{$tipo->name or ''}}">
                            </div>
                            
                            <div class="form-group">
                                <label for="label">Label</label>
                                <input class="form-control" id="label" placeholder="Nome" type="text" name="label" value="{{$tipo->label or ''}}">
                            </div>

                            <div class="form-group">
                                <label for="icone">Icone</label>
                                <input class="form-control" id="icone" placeholder="Icone Font Awesome" type="text" name="icon" value="{{$tipo->icon or ''}}">
                            </div>

                            <div class="form-group">
                                <label for="is_admin">Admin</label>
                                <br>
                                <input name="is_admin" id="is_admin" {{(isset($tipo) && $tipo->is_admin == 1 ? 'checked' : '')}} data-toggle="toggle" type="checkbox">
                            </div>

                            <div class="form-group">
                                <label for="descricao">Descrição</label>
                                <textarea class="form-control" id="descricao" name="description" rows="9" placeholder="Descrição ...">{{$tipo->description or ''}}</textarea>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button class="btn btn-sm btn-primary" type="submit">
                            <i class="fa fa-dot-circle-o"></i> Submit</button>
                            <button class="btn btn-sm btn-danger" type="reset">
                            <i class="fa fa-ban"></i> Reset</button>
                        </div>                                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection