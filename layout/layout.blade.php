<!DOCTYPE html>
<html lang="en">
<head>

    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Transportes Ultrarrápidos-@yield('Transportes')</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="{{asset('assets/bootstrap.css')}}">
    <!-- style css -->
    <link rel="stylesheet" href="{{asset('assets/Home.css')}}">
    <!-- Responsive-->
    <link rel="stylesheet" href="{{asset('assets/responsive.css')}}">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="{{asset('assets/jquery.mCustomScrollbar.min.css')}}">
    <!-- Tweaks for older IEs-->
    <link href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="{{ asset('assets/form.css') }}" rel="stylesheet">

</head>
<body>
@section('sidebar')

    <div id="mySidepanel" class="sidepanel">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
        <a href="{{ route('transportista.index') }}">Transportistas</a>
        <a href="{{ route('camion.index') }}">Camiones</a>
        <a href="{{ route('ingreso.index') }}">Ingreso</a>
        <a href="{{ route('egreso.index') }}">Egreso</a>
        <a href="{{ route('ingreso.fecha') }}">Busqueda Ingreso</a>
        <a href="{{ route('egreso.fecha') }}">Busqueda Egreso</a>
    </div>

    <!-- header -->
    <header>
        <div class="header2">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                    </div>
                    <div class="col-md-8 col-sm-8">
                        <div class="right_bottun">

                            <button class="openbtn" onclick="openNav()"><img src={{asset('assets/menu_icon.png')}} alt="#" /> </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/jquery-3.0.0.min.js"></script>
<!-- sidebar -->
<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="js/custom.js"></script>
<script>
    function openNav() {
        document.getElementById("mySidepanel").style.width = "250px";
    }

    function closeNav() {
        document.getElementById("mySidepanel").style.width = "0";
    }
</script>
@show
<div class="container">
    @yield('contenido')
    @include('sweetalert::alert')
</div>
</body>
</html>
