<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Adrison Luz">
    <title>{{ config('app.name', 'Laravel') }} | Admin</title>
    <!-- Icons-->
    <link href="{{asset('plugins/@coreui/icons/css/coreui-icons.min.css')}}" rel="stylesheet">
    <link href="{{asset('plugins/flag-icon-css/css/flag-icon.min.css')}}" rel="stylesheet">
    <link href="{{asset('plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('plugins/simple-line-icons/css/simple-line-icons.css')}}" rel="stylesheet">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <!-- Main styles for this application-->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link href="vendors/pace-progress/css/pace.min.css" rel="stylesheet">
  </head>
  <body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
    @include('admin.partials.header')
    <div class="app-body">
      @include('admin.partials.sidebar')
      <main class="main">
        @include('admin.partials.breadcrumb')  

        @yield('content')
        
      </main>
      @include('admin.partials.right_sidebar')
    </div>
    <footer class="app-footer">
      <div>
        <a href="{{ config('app.url', '#') }}">{{ config('app.name', 'Laravel') }}</a>
        <span>&copy; 2018 Todos os direitos reservados.</span>
      </div>
      <div class="ml-auto">
        <span>Desenvolvido por</span>
        <a href="http://adrisonluz.com" target="_blank">Adrison Luz</a>
      </div>
    </footer>
    <!-- CoreUI and necessary plugins-->
    <script src="{{asset('plugins/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('plugins/popper.js/dist/umd/popper.min.js')}}"></script>
    <script src="{{asset('plugins/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('plugins/pace-progress/pace.min.js')}}"></script>
    <script src="{{asset('plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('plugins/@coreui/coreui/dist/js/coreui.min.js')}}"></script>
    <!-- Plugins and scripts required by this view-->
    <script src="{{asset('plugins/chart.js/dist/Chart.min.js')}}"></script>
    <script src="{{asset('plugins/@coreui/coreui-plugin-chartjs-custom-tooltips/dist/js/custom-tooltips.min.js')}}"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="{{asset('js/main.js')}}"></script>
  </body>
</html>