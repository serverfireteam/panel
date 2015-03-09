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
    <link media="all" type="text/css" rel="stylesheet" href="{{asset("packages/serverfireteam/rapyd-laravel/assets/demo/style.css")}}">    
    <link media="all" type="text/css" rel="stylesheet" href="{{asset("packages/serverfireteam/rapyd-laravel/assets/redactor/css/redactor.css")}}">
    <link media="all" type="text/css" rel="stylesheet" href="{{asset("packages/serverfireteam/rapyd-laravel/assets/datepicker/datepicker3.css")}}">
    <link media="all" type="text/css" rel="stylesheet" href="{{asset("packages/serverfireteam/rapyd-laravel/assets/autocomplete/autocomplete.css")}}">
    <link media="all" type="text/css" rel="stylesheet" href="{{asset("packages/serverfireteam/rapyd-laravel/assets/autocomplete/bootstrap-tagsinput.css")}}" >
    <link media="all" type="text/css" rel="stylesheet" href="{{asset("packages/serverfireteam/rapyd-laravel/assets/colorpicker/css/bootstrap-colorpicker.min.css")}}" >


    <title>@yield('title')</title>
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

    <!-- jQuery Version 1.11.0 -->
    <script src="{{asset("packages/serverfireteam/panel/js/jquery-1.11.0.js")}}"></script>

</head>

<body class="@yield('bodyClass')">
    @yield('body')
    <!-- /#wrapper -->


    <!-- Bootstrap Core JavaScript -->
    <script src="{{asset("packages/serverfireteam/panel/js/bootstrap.min.js")}}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{asset("packages/serverfireteam/panel/js/plugins/metisMenu/metisMenu.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("packages/serverfireteam/panel/js/plugins/tinymce/tinymce.min.js")}}" ></script>
    <script type="text/javascript">
        tinymce.init({
            selector: "textarea",
            menubar: false,
        toolbar_items_size: 'small',
         protect: [
        /\<\/?(if|endif)\>/g, // Protect <if> & </endif>
        /\<xsl\:[^>]+\>/g, // Protect <xsl:...>
        /<\?php.*?\?>/g // Protect php code
        ],
       plugins: [
                "sh4tinymce advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "table contextmenu directionality emoticons template textcolor paste  textcolor "
        ],
        toolbar1: " newdocument fullpage |  bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect | cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo",
        toolbar2: "sh4tinymce link unlink anchor image media code | inserttime preview | forecolor backcolor table | r removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft",
        image_advtab: true,
        });
    </script>

 

    <!-- Custom Theme JavaScript -->
    <script src="{{asset("packages/serverfireteam/panel/js/sb-admin-2.js")}}"></script>

    <script src="{{asset("packages/serverfireteam/rapyd-laravel/assets/redactor/jquery.browser.min.js")}}"></script>
    <script src="{{asset("packages/serverfireteam/rapyd-laravel/assets/redactor/redactor.min.js")}}"></script>
    <script src="{{asset("packages/serverfireteam/rapyd-laravel/assets/datepicker/bootstrap-datepicker.js")}}"></script>
    <script src="{{asset("packages/serverfireteam/rapyd-laravel/assets/datepicker/locales/bootstrap-datepicker.it.js")}}"></script>
    <script src="{{asset("packages/serverfireteam/rapyd-laravel/assets/autocomplete/typeahead.bundle.min.js")}}"></script>
    <script src="{{asset("packages/serverfireteam/rapyd-laravel/assets/template/handlebars.js")}}"></script>
    <script src="{{asset("packages/serverfireteam/rapyd-laravel/assets/autocomplete/bootstrap-tagsinput.min.js")}}"></script>
    <script src="{{asset("packages/serverfireteam/rapyd-laravel/assets/colorpicker/js/bootstrap-colorpicker.min.js")}}"></script>

    
    {!! Rapyd::scripts() !!} 
    
</body>

</html>
