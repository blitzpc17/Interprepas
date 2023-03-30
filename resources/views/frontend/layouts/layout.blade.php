<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INTERPREPAS {{date('Y')}} | @yield('title')</title>

    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="{{asset('Frontend/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('Frontend/css/menu.css')}}">
    <link rel="stylesheet" href="{{asset('Frontend/css/footer.css')}}">

    <link rel="icon" type="image/jpg" href="{{asset('favicon.ico')}}"/>
    @stack('css')
</head>
<body>

@include('frontend.layouts.menu')


@section('contenido')
@show





  
@include('frontend.layouts.footer')


<script src="{{asset('Frontend/js/main.js')}}"></script>

@stack('js')

</body>
</html>