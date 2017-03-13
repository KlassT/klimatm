<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{ get_title() }}
    {{ stylesheet_link('css/bootstrap/css/bootstrap.min.css') }}
    {{ stylesheet_link('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css') }}
    {{ stylesheet_link('https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css') }}
    {{ stylesheet_link('css/admin.css') }}
    {{ stylesheet_link('plugins/select2/select2.min.css') }}
    {{ stylesheet_link('css/adminLTE/css/AdminLTE.min.css') }}
    {{ stylesheet_link('css/adminLTE/css/skins/_all-skins.min.css') }}
    {{ javascript_include('plugins/jQuery/jquery-2.2.3.min.js') }}
</head>
<body class="{{ bodyclass }}">
<div class="wrapper">
    <header class="main-header">
        <a href="{{ url('') }}" class="logo">
            <span class="logo-mini"><b>F</b>ma</span>
            <span class="logo-lg"><b>Fir</b>ma</span>
        </a>
        <nav class="navbar navbar-static-top">
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Навигация</span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="">
                        {{ link_to('auth/logout', '<i class="fa fa-sign-out"></i>') }}
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <aside class="main-sidebar">
        <section class="sidebar">
            {{ navigation.getAdminMenu() }}
        </section>
    </aside>
    <div class="content-wrapper">
        {{ flashSession.output() }}
        {{ content() }}
    </div>
</div>
{{ javascript_include('https://code.jquery.com/ui/1.11.4/jquery-ui.min.js') }}
{{ javascript_include('plugins/jQuery/jquery-2.2.3.min.js') }}
{{ javascript_include('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js') }}
{{ javascript_include('https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js') }}
{{ javascript_include('plugins/morris/morris.min.js') }}
{{ javascript_include('plugins/sparkline/jquery.sparkline.min.js') }}
{{ javascript_include('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}
{{ javascript_include('plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}
{{ javascript_include('plugins/knob/jquery.knob.js') }}
{{ javascript_include('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js') }}
{{ javascript_include('plugins/daterangepicker/daterangepicker.js') }}
{{ javascript_include('plugins/datepicker/bootstrap-datepicker.js') }}
{{ javascript_include('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}
{{ javascript_include('plugins/slimScroll/jquery.slimscroll.min.js') }}
{{ javascript_include('plugins/fastclick/fastclick.js') }}
{{ javascript_include('plugins/select2/select2.full.min.js') }}
{{ javascript_include('js/app.min.js') }}
{{ javascript_include('js/demo.js') }}
{{ javascript_include('js/admin.js') }}
</body>
</html>