<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="{{asset('packages/serverfireteam/panel/favicon.ico')}}" type="image/x-icon">
    <link rel="icon" href="{{asset('packages/serverfireteam/panel/favicon.ico')}}" type="image/x-icon">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link media="all" type="text/css" rel="stylesheet" href="{{asset("packages/zofe/rapyd/assets/demo/style.css")}}">
    <!--link media="all" type="text/css" rel="stylesheet" href="{{asset("packages/zofe/rapyd/assets/redactor/css/redactor.css")}}"-->
    <link media="all" type="text/css" rel="stylesheet" href="{{asset("packages/zofe/rapyd/assets/datepicker/datepicker3.css")}}">
    <link media="all" type="text/css" rel="stylesheet" href="{{asset("packages/zofe/rapyd/assets/autocomplete/autocomplete.css")}}">
    <link media="all" type="text/css" rel="stylesheet" href="{{asset("packages/zofe/rapyd/assets/autocomplete/bootstrap-tagsinput.css")}}">
    <link media="all" type="text/css" rel="stylesheet" href="{{asset("packages/zofe/rapyd/assets/colorpicker/css/bootstrap-colorpicker.min.css")}}">
    <!--link media="all" type="text/css" rel="stylesheet" href="{{asset("packages/serverfireteam/rapyd-laravel/assets/colorpicker/css/bootstrap-colorpicker.min.css")}}" -->

    <title>{{isset($title) ? $title : 'Panel'}}</title>
    <!-- compiled styles -->


    <link href="{{asset("packages/serverfireteam/panel/css/styles.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("packages/serverfireteam/panel/font-icon/icomoon/style.css")}}" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href='http://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'>
    @if (App::getLocale() == 'fa')
      <link href="{{URL::asset('css/fonts/fonts.css')}}" rel="stylesheet">
      <link href="{{URL::asset('css/fa-fonts.css')}}" rel="stylesheet">
      <link href="{{URL::asset('css/rtl.css')}}" rel="stylesheet">
    @endif
    
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- jQuery Version 1.11.0 -->
    <script src="{{asset("packages/serverfireteam/panel/js/jquery-1.11.0.js")}}"></script>

</head>

<body class="@yield('bodyClass')">
    @yield('body')
    <!-- /#wrapper -->


    <!-- Bootstrap Core JavaScript -->
    <script src="{{asset("packages/serverfireteam/panel/js/bootstrap.min.js")}}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{asset("packages/serverfireteam/panel/js/sb-admin-2.js")}}"></script>

    <!--script src="{{asset("packages/zofe/rapyd/assets/redactor/jquery.browser.min.js")}}"></script-->
    <!--script src="{{asset("packages/zofe/rapyd/assets/redactor/redactor.min.js")}}"></script-->
    <script src="{{asset("packages/zofe/rapyd/assets/datepicker/bootstrap-datepicker.js")}}"></script>
    <script src="{{asset("packages/zofe/rapyd/assets/datepicker/locales/bootstrap-datepicker.it.js")}}"></script>
    <script src="{{asset("packages/zofe/rapyd/assets/autocomplete/typeahead.bundle.min.js")}}"></script>
    <script src="{{asset("packages/zofe/rapyd/assets/template/handlebars.js")}}"></script>
    <script src="{{asset("packages/zofe/rapyd/assets/autocomplete/bootstrap-tagsinput.min.js")}}"></script>
    <script src="{{asset("packages/zofe/rapyd/assets/colorpicker/js/bootstrap-colorpicker.min.js")}}"></script>
    <!--script src="{{asset("packages/serverfireteam/rapyd-laravel/assets/colorpicker/js/bootstrap-colorpicker.min.js")}}"></script-->


    {!! Rapyd::scripts() !!}

</body>

</html>
