@extends('admin.layout')
@section('content')
<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Abrir Caixa
                    </div>

                    <form role="form" action="{{ url('admin/caixas') }}" method="post">
                        {!! csrf_field() !!}
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                  <label>Data</label>
                                  <input class="form-control" value="{{ date('d/m/Y') }}" disabled="" type="text">
                                  <input type="hidden" name="date" value="{{ date('d/m/Y') }}" />
                                  <input type="hidden" name="caixa_id" value="{{ !empty($caixaMae) ? $caixaMae->id : '' }}" />
                                </div>

                                <div class="form-group col-md-6">
                                  <label>Hora da abertura</label>
                                  <input class="form-control" name="start_hour" value="{{ date('H:i') }}" type="text">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-12">
                                  <label>Saldo inicial R$</label>
                                  <input class="form-control formDin" name="opening_balance" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary pull-right">Abrir Caixa</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                @if(count($caixasHoje) > 0)
                <div class="card">
                    <div class="card-header">
                        Caixa Hoje
                    </div>

                    <div class="card-body">   
                        <div class="table-responsive">
                            <table class="table table-responsive-sm table-hover table-outline mb-0">
                                <thead>
                                    <tr>
                                        <th>Saldo inicial</th>
                                        <th>Saldo final</th>
                                        <th>Entradas</th>
                                        <th>Saídas</th>
                                        <th>Fechamento</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    @foreach($caixasHoje as $caixaHoje)
                                    <tr>
                                        <th>{{ $caixaHoje->saldo_inicial }}</th>
                                        <th>{{ $caixaHoje->saldo_final == '' ? 'em aberto' : $caixaHoje->saldo_final }}</th>
                                        <th>{{ $caixaHoje->total_entradas == '' ? 'em aberto' : $caixaHoje->saldo_final }}</th>
                                        <th>{{ $caixaHoje->total_saidas == '' ? 'em aberto' : $caixaHoje->total_saidas }}</th>
                                        <th>{{ $caixaHoje->hora_fechamento == '' ? 'em aberto' : $caixaHoje->hora_fechamento }}</th>
                                    </tr>
                                    @endforeach
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <th>Saldo inicial</th>
                                        <th>Saldo final</th>
                                        <th>Entradas</th>
                                        <th>Saídas</th>
                                        <th>Fechamento</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>       
@endsection