<section class="ev-culturales">

    <div class="ev-culturales-header">
        <h3>Eventos culturales</h3>        
        <a href="#">Ver calendario</a>
    </div>

    <div class="ev-culturales-container">


        <div class="swiper culturales">

            <div class="swiper-wrapper">

                @for($i=1; $i<=10; $i++)

                <div class="culturales-item swiper-slide">
                    <div class="contenido-cultural">
                        <h3><span>Rondalla</span></h3>
                        <img src="http://3.bp.blogspot.com/-MO1z-KcGjyQ/TqcxHR1rsyI/AAAAAAAAAAQ/xdyzGR5VuxI/s1600/prefeco.jpg" alt="">                                              
                        <h3>Nombre Escuela</h3>                       
                        <p>Lun 27, 12:00 hrs</p>
                        <span>Cancha Exterior PREFECO</span>                            
                    </div>
                </div> 

                @endfor

            </div>


            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev culturales"></div>
            <div class="swiper-button-next culturales"></div>

        </div>

       

    </div>




</section>