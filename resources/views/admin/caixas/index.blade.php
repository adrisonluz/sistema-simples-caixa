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
                                    <th>{{ $caixa->date }}</th>
                                    <th>{{ $caixa->start_hour }}</th>
                                    <th>{{ !empty($caixa->end_hour) ? $caixa->end_hour : 'em aberto' }}</th>
                                    <th>{{ $caixa->opening_balance }}</th>
                                    <th>{{ !empty($caixa->end_balance) ? $caixa->end_balance : 'em aberto' }}</th>
                                    <th>{{ !empty($caixa->total_entries) ? $caixa->total_entries : (empty($caixa->end_balance) ? 'em aberto' : '0,00') }}</th>
                                    <th>{{ !empty($caixa->total_outputs) ? $caixa->total_outputs : (empty($caixa->end_balance) ? 'em aberto' : '0,00') }}</th>
                                    <th><a href="{{ url('admin/caixas/' . $caixa->id ) }}" title="Ver movimentação"><i class="icon fa fa-search"></i></a></th>
                                </tr>
                                @endforeach
                            </tbody>    
                        </table>
                        @else
                        <h5>
                            Nenhum registro de caixa.
                        </h5>
                        @endif  
                    </div>

                    @if(count($caixas) == 0 || empty($caixaAberto))
                    <div class="card-footer">
                        <p><a href="{{url('admin/caixas/create')}}" class="btn btn-primary pull-right">Abrir caixa</a></p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
