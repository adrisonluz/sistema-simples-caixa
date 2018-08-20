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
                    <form class="form-horizontal" action="{{route('admin.configuracoes.salvar')}}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="card-body">         
                            <div class="form-group">
                                <label for="logo">Logo</label>
                                <input class="form-control" id="logo" type="file" name="logo">
                            </div>

                            <div class="form-group">
                                <label for="cor_primaria_sistema">Cor primária (sistema)</label>
                                <input class="form-control" id="cor_primaria_sistema" placeholder="#fffff" type="text" name="cor_primaria_sistema" value="{{$cor_primaria_sistema or ''}}">
                            </div>

                            <div class="form-group">
                                <label for="cor_secundaria_sistema">Cor secundária (sistema)</label>
                                <input class="form-control" id="cor_secundaria_sistema" placeholder="#fffff" type="text" name="cor_secundaria_sistema" value="{{$cor_secundaria_sistema or ''}}">
                            </div>

                            <div class="form-group">
                                <label for="cor_primaria_fonte">Cor primária (fonte)</label>
                                <input class="form-control" id="cor_primaria_fonte" placeholder="#fffff" type="text" name="cor_primaria_fonte" value="{{$cor_primaria_fonte or ''}}">
                            </div>

                            <div class="form-group">
                                <label for="cor_secundaria_fonte">Cor secundária (fonte)</label>
                                <input class="form-control" id="cor_secundaria_fonte" placeholder="#fffff" type="text" name="cor_secundaria_fonte" value="{{$cor_secundaria_fonte or ''}}">
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