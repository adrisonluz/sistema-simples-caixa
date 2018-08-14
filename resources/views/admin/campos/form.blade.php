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
                    <form class="form-horizontal" action="{{(isset($campo) ? route('admin.campos.update', ['id' => $campo->id]) : route('admin.campos.store'))}}" method="post">
                        @if(isset($campo))
                        <input type="hidden" name="_method" value="put" />
                        @endif
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="card-body">                            
                            <div class="form-group">
                                <label for="nome">Nome</label>
                                <input class="form-control" id="nome" placeholder="Nome Completo" type="text" name="name" value="{{$campo->name or ''}}">
                            </div>
                            
                            <div class="form-group">
                                <label for="label">Tipo</label>
                                <select name="type_id" class="form-control" require>
                                    @if(count($tipos) > 0)
                                    @foreach($tipos as $tipo)
                                    <option value="{{$tipo->id}}" {{(!empty($campo) && $campo->type_id == $tipo->id ? 'selected="selected"' : '')}}>{{$tipo->name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="label">Estilo</label>
                                        <select name="style" class="form-control" require>
                                            <option value="text" {{(!empty($campo) && $campo->style == 'text' ? 'selected="selected"' : '')}}>Texto</option>
                                            <option value="email" {{(!empty($campo) && $campo->style == 'email' ? 'selected="selected"' : '')}}>Email</option>
                                            <option value="number" {{(!empty($campo) && $campo->style == 'number' ? 'selected="selected"' : '')}}>Número</option>
                                            <option value="phone" {{(!empty($campo) && $campo->style == 'phone' ? 'selected="selected"' : '')}}>Telefone</option>
                                            <option value="date" {{(!empty($campo) && $campo->style == 'date' ? 'selected="selected"' : '')}}>Data</option>
                                            <option value="file" {{(!empty($campo) && $campo->style == 'file' ? 'selected="selected"' : '')}}>Arquivo</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="order">Ordem</label>
                                        <input class="form-control" id="order" type="number" name="order" value="{{$campo->order or 1}}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="descricao">Descrição</label>
                                <textarea class="form-control" id="descricao" name="description" rows="9" placeholder="Descrição ...">{{$campo->description or ''}}</textarea>
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