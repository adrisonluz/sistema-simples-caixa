@extends('admin.layout')
@section('content')
<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Caixa
                    </div>

                    <div class="card-body">
                        @if(count($caixas) > 0)
                        <table class="table table-striped tabData" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Data</th>
                                    <th>Hora Abertura</th>
                                    <th>Hora Fechamento</th>
                                    <th>Saldo Inicial</th>
                                    <th>Saldo Final</th>
                                    <th>Total Entradas</th>
                                    <th>Total Saidas</th>
                                    <th>Ver</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Data</th>
                                    <th>Hora Abertura</th>
                                    <th>Hora Fechamento</th>
                                    <th>Saldo Inicial</th>
                                    <th>Saldo Final</th>
                                    <th>Total Entradas</th>
                                    <th>Total Saidas</th>
                                    <th>Ver</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($caixas as $caixa)
                                <tr>
                                    <th>{{ $caixa->id }}</th>
                                    <th>{{ $caixa->data }}</th>
                                    <th>{{ $caixa->hora_abertura }}</th>
                                    <th>{{ $caixa->hora_fechamento == '' ? 'em aberto' : $caixa->hora_fechamento }}</th>
                                    <th>{{ $caixa->saldo_inicial }}</th>
                                    <th>{{ $caixa->saldo_final == '' ? 'em aberto' : $caixa->saldo_final }}</th>
                                    <th>{{ $caixa->total_entradas == '' ? 'em aberto' : $caixa->saldo_final }}</th>
                                    <th>{{ $caixa->total_saidas == '' ? 'em aberto' : $caixa->total_saidas }}</th>
                                    <th><a href="{{ url('caixa/' . $caixa->id ) }}" title="Ver movimentação"><i class="icon fa fa-search"></i></a></th>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <h5>
                            Nenhum registro de caixa.
                        </h5>
                        <a href="{{url('admin/caixas/create')}}" class="btn btn-primary">Abrir caixa</a>
                        @endif  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
