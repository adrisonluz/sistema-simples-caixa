<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.dashboard')}}">
                <i class="nav-icon icon-speedometer"></i> Dashboard
                {{--<span class="badge badge-primary">NEW</span>--}}
                </a>
            </li>
            <li class="nav-title">Administrativo</li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.usuarios.index')}}">
                <i class="nav-icon icon-people"></i> Usuários</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.relatorios.adm')}}">
                <i class="nav-icon icon-notebook"></i> Relatórios</a>
            </li>
            <li class="divider"></li>
            <li class="nav-title">Financeiro</li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.caixas.index')}}">
                <i class="nav-icon icon-briefcase"></i> Caixa</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.relatorios.fin')}}">
                <i class="nav-icon icon-notebook"></i> Relatórios</a>
            </li>
            <li class="divider"></li>
            <li class="nav-title">Configurações</li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.configuracoes.editar')}}">
                <i class="nav-icon icon-settings"></i> Geral</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.tipos.index')}}">
                <i class="nav-icon icon-options"></i> Tipos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.campos.index')}}">
                <i class="nav-icon icon-layers"></i> Campos</a>
            </li>
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
    </div>