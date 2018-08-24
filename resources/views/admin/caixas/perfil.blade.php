@extends('admin.layout')
@section('content')
<div class="container-fluid">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            {{ $caixa->end_hour !== '' ? 'Caixa ' . $caixa->data : 'Caixa Hoje' }}
          </div>

          <form role="form" action="{{ url('/caixa') }}" method="post">
              {!! csrf_field() !!}
              <div class="card-body">
                <div class="row">
                  <input type="hidden" name="caixa_id" value="{{ !empty($caixaMae) ? $caixaMae->id : '' }}" />
                  <div class="form-group col-md-1">
                    <label>Aberto</label>
                    <input class="form-control" name="start_hour" disabled="disabled" value="{{ $caixa->start_hour }}" type="text">
                  </div>
                  <div class="form-group col-md-1">
                    <label>Fechado</label>
                    <input class="form-control" name="end_hour" disabled="disabled" value="{{ ($caixa->end_hour == null ? 'Em aberto' : $caixa->end_hour) }}" type="text">
                  </div>
                  <div class="form-group col-md-2">
                    <label>Saldo inicial</label>
                    <input class="form-control" name="opening_balance" disabled="disabled" value="{{ $caixa->opening_balance }}" type="text">
                  </div>
                  <div class="form-group col-md-2">
                    <label>Total entradas</label>
                    <input class="form-control" name="total_entries" disabled="disabled" value="{{ ($caixa->total_entries == null ? 'Em aberto' : $caixa->total_entries) }}" type="text">
                  </div>
                  <div class="form-group col-md-2">
                    <label>Total saídas</label>
                    <input class="form-control" name="total_outputs" disabled="disabled" value="{{ ($caixa->total_outputs == null ? 'Em aberto' : $caixa->total_outputs) }}" type="text">
                  </div>
                  <div class="form-group col-md-2">
                    <label>Saldo parcial</label>
                    <input class="form-control" name="now_balance" disabled="disabled" value="{{ $saldo }}" type="text">
                  </div>
                  <div class="form-group col-md-2">
                    <label>Saldo final</label>
                    <input class="form-control" name="end_balance" disabled="disabled" value="{{ ($caixa->end_balance == null ? 'Em aberto' : $caixa->end_balance) }}" type="text">
                  </div>
                </div>
              </div>
          </form>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            Entradas neste caixa
          </div>

          <div class="card-body">
            @if(count($entradas) > 0)
            <table class="table  table-striped" cellspacing="0">
                <thead>
                    <tr>
                        <th>Hora</th>
                        <th>Valor</th>
                        <th>Descrição</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Hora</th>
                        <th>Valor</th>
                        <th>Descrição</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($entradas as $entrada)
                    <tr>
                        <td>{{ $entrada->created_at }}</td>
                        <td>{{ number_format(str_replace(',','.',$entrada->value), 2, ',', '') }}</td>
                        <td>{{ $entrada->description }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p>Nenhum registro encontrado.</p>
            @endif
          </div>
        </div>
      </div><!-- /.col -->

      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            Saidas neste caixa
          </div>

          <div class="card-body">
            @if(count($saidas) > 0)
            <table class="table  table-striped" cellspacing="0">
                <thead>
                    <tr>
                        <th>Hora</th>
                        <th>Valor</th>
                        <th>Descrição</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Hora</th>
                        <th>Valor</th>
                        <th>Descrição</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($saidas as $saida)
                    <tr>
                      <td>{{ $saida->created_at }}</td>
                      <td>{{ number_format(str_replace(',','.',$saida->value), 2, ',', '') }}</td>
                      <td>{{ $saida->description }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p>Nenhum registro encontrado.</p>
            @endif
          </div>
        </div><!-- /.col -->
      </div>
    </div>

    @if($caixa->end_balance == null)
    <div class="row">
      <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              Movimentação
            </div>

            <div class="card-body">
                <form role="form" action="{{ url('/admin/caixas/fechar/' . $caixa->id) }}" method="post">
                    {!! csrf_field() !!}
                  <a href="javascript:;" class="btn btn-primary btnEntrada" data-toggle="modal" data-target="#modalEntrada">Nova entrada</a>
                  <a href="javascript:;" class="btn btn-success btnSaida" data-toggle="modal" data-target="#modalSaida">Nova saida</a>
                  <button type="submit" class="btn btn-danger pull-right">Fechar caixa</button>
                  
                </form>
              </div><!-- /.box-header -->
          </div>
      </div>
    </div>
    @endif
    
  @if(count($caixasRelacionados) > 1)
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          Caixas relacionados
        </div>

        <div class="card-body">
          <!-- form start -->
          <form role="form" action="{{ url('/admin/caixas/fechar') }}" method="post">
              {!! csrf_field() !!}
              <div class="box-body">
                  @foreach($caixasRelacionados as $caixaRelacionado)
                  @if($caixaRelacionado->id == $caixa->id)

                  @else
                  <div class="row">
                    <div class="form-group col-md-2">
                      <label>Hora da abertura</label>
                      <input class="form-control" name="start_hour" disabled="disabled" value="{{ $caixaRelacionado->start_hour }}" type="text">
                    </div>
                    <div class="form-group col-md-2">
                      <label>Hora do fechamento</label>
                      <input class="form-control" name="end_hour" disabled="disabled" value="{{ $caixaRelacionado->end_hour }}" type="text">
                    </div>
                    <div class="form-group col-md-2">
                      <label>Saldo inicial</label>
                      <input class="form-control" name="opening_balance" disabled="disabled" value="{{ $caixaRelacionado->opening_balance }}" type="text">
                    </div>
                    <div class="form-group col-md-2">
                      <label>Total entradas</label>
                      <input class="form-control" name="total_entries" disabled="disabled" value="{{ $caixaRelacionado->total_entries }}" type="text">
                    </div>
                    <div class="form-group col-md-2">
                      <label>Total saídas</label>
                      <input class="form-control" name="total_outputs" disabled="disabled" value="{{ $caixaRelacionado->total_outputs }}" type="text">
                    </div>
                    <div class="form-group col-md-2">
                      <label>Saldo final</label>
                      <input class="form-control" name="end_balance" disabled="disabled" value="{{ $caixaRelacionado->end_balance }}" type="text">
                    </div>
                  </div>
                  @endif
                  @endforeach
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  @endif
@endsection

<div class="modal fade modalEntrada" id="modalEntrada" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        Nova entrada
      </div>
      <form role="form" action="{{ url('/admin/movimentacao/entrada') }}" method="post">
      <div class="modal-body">
          {!! csrf_field() !!}
            <div class="form-group">
              <label>Valor</label>
              <input class="form-control formDin" value="" name="value" type="text">
              <input type="hidden" name="caixa_id" value="{{ $caixa->id }}" />
            </div>

            <div class="form-group change">
              <label>Descrição</label>
              <textarea name="description" class="form-control" placeholder="Descreva esta entrada."></textarea>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary">Lançar</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade modalSaida" id="modalSaida" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        Nova Saida
      </div>
      <form role="form" action="{{ url('/admin/movimentacao/saida') }}" method="post">
      <div class="modal-body">
          {!! csrf_field() !!}
          <div class="form-group">
            <label>Valor</label>
            <input class="form-control formDin" value="" name="value" type="text">
            <input type="hidden" name="caixa_id" value="{{ $caixa->id }}" />
          </div>

          <div class="form-group change">
            <label>Descrição</label>
            <textarea name="description" class="form-control" placeholder="Descreva esta saida."></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary">Lançar</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
