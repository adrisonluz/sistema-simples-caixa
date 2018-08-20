@extends('admin.layout')
@section('content')
<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Relatório administrativo

                        <a href="#" class="btn btn-sm btn-primary pull-right" title="Imprimir" alt="Imprimir">
                            <i class="fa fa-print"></i>
                        </a>
                    </div>
                        
                    <div class="card-body">
                        @if(Session::has('alert'))
                        <div class="alert alert-{{Session::get('alert')['type']}}" role="alert">{{Session::get('alert')['msg']}}</div>
                        @endif

                        @if(count($tipos) > 0 && count($data) > 0)
                        @foreach($tipos as $tipo)
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        @foreach($tipo->campos as $campo)
                                        <th>{{$campo->name}}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $d)
                                    @if($d->type_id == $tipo->id)
                                    <tr>
                                        @foreach($tipo->campos as $campo)
                                        <td>{{$campo->getValue($d->id)}}</td>
                                        @endforeach
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endforeach
                        @else
                            <div class="alert alert-warning" role="alert">Nenhum registro encontrado.</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection