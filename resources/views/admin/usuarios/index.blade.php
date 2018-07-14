@extends('admin.layout')
@section('content')
<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                  <div class="card-header">Lista de usuários cadastrados</div>
                  
                  <div class="card-body">
                    <table class="table table-responsive-sm table-hover table-outline mb-0">
                        <thead class="thead-light">
                        <tr>
                            <th class="text-center">
                            <i class="icon-people"></i>
                            </th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th class="text-center">Tipo</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="text-center">
                                <div class="avatar">
                                    <img class="img-avatar" src="{{asset('img/avatars/1.jpg')}}" alt="admin@bootstrapmaster.com">
                                </div>
                            </td>
                            <td>
                            <div>Adrison Luz</div>
                            <div class="small text-muted">
                                {{--<span>New</span> | Registered: Jan 1, 2015</div>--}}
                            </td>
                            <td>
                                adrison701@gmail.com
                            </td>
                            <td class="text-center">
                                <i class="fa fa-address-card-o" style="font-size:24px"></i>
                                <i class="fa fa-building-o" style="font-size:24px"></i>
                            </td>
                            <td>
                                <strong>Ativo</strong>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection