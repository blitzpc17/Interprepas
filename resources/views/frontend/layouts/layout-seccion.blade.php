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
    height:60vh;
    background:var(--primario)    
  }

  .ban-template{
    width:100%;
    height:100%;
  }

  .columna{
    width:280px; 
    height:100vh;  
    display: flex;
    flex-direction:column;
  }

  .container{
    width:100%;
    margin-bottom:2.5rem;
    display:flex;
    flex-direction:row;
    align-items: flex-start;
    justify-content: space-around;
    position: relative;
    top: -10vh;   
  }

  .contenido{
    width:80%;
    height:100vh;
    border-top: 1px solid #bbb;
    border-left: 1px solid #bbb;
    box-shadow: 5px 5px #bbb;
    background:white;
    overflow-y: auto;
  }

  .sub-redes{
    box-shadow: 5px 5px #bbb;
    display: flex;
    flex-direction:column;
    justify-content: flex-end;
    width: 262px;
  }

  .subr-header{
    display:flex;
    align-items:center;
    justify-content:center;
    background:var(--secundario);
    padding:1rem;
    
  }
  .subr-header h3{
    color: var(--txt-bco)
  }

  .columna-movil{
      display:none;
    }

  @media screen and (max-width:1250px) {
    .columna-movil{
      display:block;
      width:100%;
      display:flex;      
      align-items: center;
      justify-content: center;
    }

    .contenido{
      width:100%;
      margin-bottom: 2rem;
    }

    .container{
      flex-direction:column;
      margin-bottom:0;
      top:0;
    }
    .columna{
      display:none;
    }

    .banner{
      height:40vh;
    }
  }
</style>
    
@endpush


@section('contenido')


<section class="banner"> 
  <img class="ban-template" src="https://static.vecteezy.com/system/resources/previews/010/791/227/non_2x/soccer-template-design-football-banner-sport-layout-design-green-theme-illustration-vector.jpg" alt="" srcset="">
</section>

<div class="container">

  <section class="columna">

    <div class="sub-redes">
      <div class="subr-header">
        <h3>REDES SOCIALES</h3>
      </div>
          <iframe 
              src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FUTTehuacan%2F&tabs=timeline&width=262&height=750&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" 
              width="262" 
              height="540" 
              style="border:none;overflow:hidden" 
              scrolling="no" 
              frameborder="0" 
              allowfullscreen="true" 
              allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share">
          </iframe>
    </div>


  </section>

  <section class="contenido">

    @section('sub-contenido')
    @show


  </section>

  <section class="columna-movil">
    <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FUTTehuacan&tabs=page&width=320&height=350&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=2003030306634376" 
      width="320" 
      style="border:none;overflow:hidden" 
      scrolling="no" 
      frameborder="0" 
      allowfullscreen="true" 
      allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share">
    </iframe>
  </section>

  
</div>








@endsection



@push('js')

<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

    
@endpush