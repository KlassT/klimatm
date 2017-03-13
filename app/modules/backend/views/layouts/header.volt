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
    {{ stylesheet_link('css/adminLTE/css/AdminLTE.min.css') }}
    {{ stylesheet_link('css/adminLTE/css/skins/_all-skins.min.css') }}
    {{ stylesheet_link('css/admin.css') }}
    {{ javascript_include('plugins/jQuery/jquery-2.2.3.min.js') }}
</head>
<body class="{{ bodyclass }}">
    {{ content() }}