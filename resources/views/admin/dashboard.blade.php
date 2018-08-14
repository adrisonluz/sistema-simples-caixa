@extends('admin.layout')
@section('content')
<div class="container-fluid">
    @if(Session::has('alert'))
        <div class="alert alert-{{Session::get('alert')['type']}} alert-dismissible fade show" role="alert">
            {{Session::get('alert')['text']}}
            <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>    
        </div>
    @endif
    <div class="animated fadeIn">    
    <!-- /.card-->
    <div class="row">
        <div class="col-sm-6 col-lg-3">
            <div class="brand-card">
                <div class="brand-card-header bg-facebook">
                <i class="fa fa-users"></i>
                </div>
                <div class="brand-card-body">
                <div>
                    <div class="text-value">{{count($usuariosAtivos)}}</div>
                    <div class="text-uppercase text-muted small">Ativos</div>
                </div>
                <div>
                    <div class="text-value">{{count($usuariosInativos)}}</div>
                    <div class="text-uppercase text-muted small">Inativos</div>
                </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection