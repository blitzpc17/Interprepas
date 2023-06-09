@extends('frontend.layouts.layout')


@push('css')
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"
/>  

<link rel="stylesheet" href="{{asset('Frontend/css/slider-eventos.css')}}">
<link rel="stylesheet" href="{{asset('Frontend/css/blog.css')}}">
<link rel="stylesheet" href="{{asset('Frontend/css/redes.css')}}">
<link rel="stylesheet" href="{{asset('Frontend/css/medallero.css')}}">
<link rel="stylesheet" href="{{asset('Frontend/css/diario.css')}}">
<link rel="stylesheet" href="{{asset('Frontend/css/culturales.css')}}">
<link rel="stylesheet" href="{{asset('Frontend/css/conocimiento.css')}}">
<link rel="stylesheet" href="{{asset('Frontend/css/cintillo_participantes.css')}}">


<style>
    .swiper{
        height:65vh;
        margin-top: 70px
    }

    .swiper-slide img {
      display: block;
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .autoplay-progress {
      position: absolute;
      right: 16px;
      bottom: 16px;
      z-index: 10;
      width: 48px;
      height: 48px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
      color: var(--swiper-theme-color);
    }

    .autoplay-progress svg {
      --progress: 0;
      position: absolute;
      left: 0;
      top: 0px;
      z-index: 10;
      width: 100%;
      height: 100%;
      stroke-width: 4px;
      stroke: var(--swiper-theme-color);
      fill: none;
      stroke-dashoffset: calc(125.6 * (1 - var(--progress)));
      stroke-dasharray: 125.6;
      transform: rotate(-90deg);
    }

    .swiper-button-next,
    .swiper-button-prev{
        background:var(--secundario);
        border-radius:5px;
        height:40px;
        width:45px;
        color:white;
        box-shadow: 3px 3px 5px black;

    }

    .swiper-button-next:after,
    .swiper-button-prev:after{
        font-size:18px;
        font-weight:700;
    }



    /* home */
    .home{
        width:100%;
        padding:2rem;
        display:flex;
        background:white;
        margin-top: 28%;        
    }

    .secciones.lateral{
      display:flex;
      flex-direction:column;
      justify-content: flex-start;
      align-items: center;
      
    }

   

    @media screen and (max-width:1279px){
        .home{
          
          flex-direction:column;
        }
        .lateral{
          display: flex!important;
          flex-direction: row!important;
          align-items: flex-start!important;
          justify-content: space-evenly!important;
        }

        .home .secciones{
          display:flex; 
          flex-direction:column;
          align-items:center;
        }
    }

    @media screen and (max-width:1820px) {
      .home{
        margin-top: 0;
      }
    }

    @media screen and (max-width:950px) {
      .home{
        padding:0;
        padding-bottom:2rem;
      }
      .lateral{
          display: flex!important;
          flex-direction: column!important;
        }
    }



    


   
    /* end home */
</style>
@endpush


@section('title', 'BIENVENIDOS')


@section('contenido')

    <!-- Swiper -->
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
            <!-- <div class="swiper-slide"><img src="https://wallpaperaccess.com/full/1398610.jpg" alt="" srcset=""></div>
            <div class="swiper-slide"><img src="https://images4.alphacoders.com/935/thumb-1920-935756.jpg" alt="" srcset=""></div>
            <div class="swiper-slide"><img src="https://fondosmil.com/fondo/7532.jpg" alt="" srcset=""></div>
            <div class="swiper-slide"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRnYCREsPpqZPGwbg2OE7hNSzTkFTcfMv0JKhs3LA916_zxreb_ht57OfrEmLW74MqV-10&usqp=CAU" alt="" srcset=""></div>
            <div class="swiper-slide"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSGCRx5DQaEFGsCmlS_5Y8dcmLmtpK-l2Wu4w&usqp=CAU" alt="" srcset=""></div>
            <div class="swiper-slide"><img src="https://assets.adnradio.cl/2022/11/cartelera-NBA-partidos-s%C3%A1bado-925x470.jpg" alt="" srcset=""></div>
            <div class="swiper-slide"><img src="https://library.sportingnews.com/styles/twitter_card_120x120/s3/2022-08/M%C3%A9xico%20voley.jpg?itok=xBzC9rEV" alt="" srcset=""></div>
            <div class="swiper-slide"><img src="https://s.yimg.com/ny/api/res/1.2/WTRYKqHzF8NsSFvkQd5WRg--/YXBwaWQ9aGlnaGxhbmRlcjt3PTk2MDtoPTY0MA--/https://media.zenfs.com/es/lanacion.com.ar/c805b280b760975f1d9cb9a2bfde1440" alt="" srcset=""></div>
            <div class="swiper-slide"><img src="https://img.olympicchannel.com/images/image/private/t_s_w1340/t_s_16_9_g_auto/f_auto/primary/fai12dwup6punxyn77am" alt="" srcset=""></div>--> 
            <div class="swiper-slide"><img src="{{asset('Frontend/img/prefecoInterprepas.jpg')}}" alt="" srcset=""></div>
           

            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
            <div class="autoplay-progress">
            <svg viewBox="0 0 48 48">
                <circle cx="24" cy="24" r="20"></circle>
            </svg>
            <span></span>
            </div>
        </div>
    <!-- end swiper-->


    @include('frontend.layouts.slider-eventos')

    <div class="home">

        <div class="wd-65 sm-100 secciones">

        @include('frontend.layouts.blog')


        @include('frontend.layouts.diario')

        @include('frontend.layouts.culturales')

        @include('frontend.layouts.conocimiento')

        </div>

        <div class="wd-35 sm-100 secciones lateral">


        @include('frontend.layouts.medallero')


        @include('frontend.layouts.redes')



        </div>


    </div>

    @include('frontend.layouts.cintillo_participantes')



@endsection




@push('js')

<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script
  src="https://code.jquery.com/jquery-3.6.4.js"
  integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
  crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment-with-locales.min.js"></script>


<script>

    const progressCircle = document.querySelector(".autoplay-progress svg");
    const progressContent = document.querySelector(".autoplay-progress span");
    var swiper = new Swiper(".mySwiper", {
      spaceBetween: 30,
      centeredSlides: true,
      autoplay: {
        delay: 5000,
        disableOnInteraction: false
      },
      pagination: {
        el: ".swiper-pagination",
        clickable: true
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev"
      },
      on: {
        autoplayTimeLeft(s, time, progress) {
          progressCircle.style.setProperty("--progress", 1 - progress);
          progressContent.textContent = `${Math.ceil(time / 1000)}s`;
        }
      }
    });




   

   

   


    let prepas;
    moment.locale('es')
    $(document).ready(function () {
        ListarData();
    });




    /*medallero */

    function ListarData(){

      console.log('vvolando...')
      $.ajax({
        method: "GET",
        url: "{{route('f.listar')}}",
        dataType: "json",
        success: function (res) {
            prepas = res.prepas;
            FillParticipantes(prepas)
            FillMedallero(res.medallero)
            FillBlog(res.noticias)
            FillEventosDeportivos(res.evDeportivos)
            FillEventosCulturales(res.evCulturales);
            FillEventosConocimiento(res.evConocimiento);
            

        }
      });
    }


    function FillMedallero(data){
      
      $('.tb-medallero tbody').empty();
      $.each(data, function (i, val) { 
        console.log(val)

          const medallas = val.Medallas.split("-")
          const html = ` <tr>
                          <td>${val.Posicion}</td>
                          <td>${val.Region}</td>
                          <td>${medallas[0]}</td>
                          <td>${medallas[1]}</td>
                          <td>${medallas[2]}</td>
                          <td>${medallas[3]}</td>
                        </tr>` ;

        $('.tb-medallero tbody').append(html);
      });
    }

    function FillBlog(data){
      $('.bg-container').empty();
      $.each(data, function (i, val) { 
         const html = `<div class="bg-item">
                          <div class="bg-img">
                              <img src="{{asset('${val.Img}')}}" alt="">
                          </div>
                          <div class="bg-contenido">
                            
                              <h3>${val.Titulo}</h3>                    
                              <span>${moment(val.Fecha).format('DD-MM-YYYY')}</span>
                              <p>${val.Contenido}</p>
                              <a href="#">Ver más</a>  
                              
                          </div>
                      </div>`;
        $('.bg-container').append(html);
      });
    }

    function FillEventosDeportivos(data){

      
      $('#deportivos').empty();

      $.each(data, function (i, val) { 
          const eventoData = JSON.parse(val.SourceData)
          const dataVisitante = eventoData[0].EquipoVisitante;
          const prepaVisitante = prepas.find(x=>x.Id == dataVisitante.Id)
          const dataLocal = eventoData[0].EquipoLocal;
          const prepaLocal = prepas.find(x=>x.Id == dataLocal.Id)


          const html=`<div class="dia-item swiper-slide">
                        <div class="categorias">
                            <h3>${val.Categoria}</h3>
                        </div>
                        <div class="logos">
                            <div class="equipos">
                                <div class="logos-item">
                                    <img src="{{asset('${prepaLocal.Logo}')}}" alt="">                
                                    <span>${dataLocal.Score}</span>
                                </div>
                                <div class="logos-item">
                                    <img src="{{asset('${prepaVisitante.Logo}')}}" alt="">
                                    <span>${dataVisitante.Score}</span>
                                </div>
                            </div>
                            <div class="programacion">
                                <span>${moment(val.FechaHora).format('MMMM D, h:mm a')}</span>
                                <img src="${val.CategoriaImagen}" alt="" srcset="">
                            </div>              
                        
                            
                        </div>
                        <div class="info">
                            <span>${val.Sede}</span>
                        </div> 
                    </div> `

                    $('#deportivos').append(html)
      });

       /*eventos deportivos */

      const swiperd = new Swiper('.swiper.deportivo', {
        // Optional parameters
        direction: 'horizontal',
        loop: true,


        // Navigation arrows
        navigation: {
          nextEl: '.swiper-button-next.deportivo',
          prevEl: '.swiper-button-prev.deportivo',
        },

        autoplay: {
          delay: 2000,
          disableOnInteraction: false,
          pauseOnMouseEnter: true
        },
        slidesPerView:"auto",
        centeredSlides: true,
        disableOnInteraction: true,
      });

    }

    function FillEventosCulturales(data){

        $('#culturales').empty();
        $.each(data, function (i, val) { 
            console.log(val)
            const html = `<div class="culturales-item swiper-slide">
                            <div class="contenido-cultural">
                                <h3><span>${val.SoloCategoria}</span></h3>
                                <img src="{{asset('${val.CategoriaImagen}')}}" alt="">                           
                                <p style="font-weight:701">${moment(val.FechaHora).format('MMMM D, h:mm a')}</p>
                                <span style="text-align: center; font-weight: 600; color: var(--primario);">${val.Sede}</span>                            
                            </div>
                        </div> `
                        $('#culturales').append(html)
        });

          /*eventos culturales */

          const swiperc = new Swiper('.swiper.culturales', {
              // Optional parameters
              direction: 'horizontal',
              loop: true,


              // Navigation arrows
              navigation: {
                nextEl: '.swiper-button-next.culturales',
                prevEl: '.swiper-button-prev.culturales',
              },

              autoplay: {
                delay: 2000,
                disableOnInteraction: false,
                pauseOnMouseEnter: true
              },
              slidesPerView:"auto",
              centeredSlides: true,
              disableOnInteraction: true,
              
            });

    }

    function FillEventosConocimiento(data){

      $('#conocimiento').empty();
        $.each(data, function (i, val) { 
            const html = `<div class="conocimiento-item swiper-slide">
                            <div class="contenido-conocimiento">
                                <h3><span>${val.SoloCategoria}</span></h3>
                                <img src="{{asset('${val.CategoriaImagen}')}}" alt="">                           
                                <p style="font-weight:701">${moment(val.FechaHora).format('MMMM D, h:mm a')}</p>
                                <span style="text-align: center; font-weight: 600; color: var(--primario);">${val.Sede}</span>                            
                            </div>
                        </div> `
                        $('#conocimiento').append(html)
        });

          /*eventos culturales */

          const swipercon = new Swiper('.swiper.conocimiento', {
              // Optional parameters
              direction: 'horizontal',
              loop: true,


              // Navigation arrows
              navigation: {
                nextEl: '.swiper-button-next.conocimiento',
                prevEl: '.swiper-button-prev.conocimiento',
              },

              autoplay: {
                delay: 2000,
                disableOnInteraction: false,
                pauseOnMouseEnter: true
              },
              slidesPerView:"auto",
              centeredSlides: true,
              disableOnInteraction: true,
              
            });


    }

    function FillParticipantes(data){
      $('#cparticipantes').empty();
      $.each(data, function (i, val) { 
         const html = `<div class="swiper-slide participantes"><img src="{{asset('${val.Logo}')}}" /></div>`
         $('#cparticipantes').append(html)
      });

       /*participantes*/

    const swiperp = new Swiper('.swiper.participantes', {
        direction: 'horizontal',
        loop: true,
        autoplay: {
                    delay: 1500,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: true
            } ,
            
            slidesPerView: "auto",
            centeredSlides: true,

    });
    }
   


</script>
    
@endpush