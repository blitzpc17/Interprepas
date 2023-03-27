@extends('frontend.layouts.layout')

@push('css')
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">

<link rel="stylesheet" href="{{asset('Frontend/css/noticia.css')}}">


<style>
  .banner{
    position:relative;
    top:71px;
    width:100%;
    height:40vh;
    background:var(--primario)    
  }

  .ban-template{
    width:100%;
    height:100%;
  }

  
</style>
    
@endpush


@section('contenido')


<section class="banner">

<img class="ban-template" src="https://static.vecteezy.com/system/resources/previews/010/791/227/non_2x/soccer-template-design-football-banner-sport-layout-design-green-theme-illustration-vector.jpg" alt="" srcset="">

  
</section>


@include('frontend.layouts.noticia')



@endsection



@push('js')

<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

<script>
   
</script>
    
@endpush