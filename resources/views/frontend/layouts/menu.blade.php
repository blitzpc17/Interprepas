
  <nav>
    <div class="navbar">
      <i class='bx bx-menu'></i>
      <div class="logo"><a href="#">INTERPREPAS{{date('Y')}}</a></div>
      <div class="nav-links">
        <div class="sidebar-logo">
          <span class="logo-name">INTERPREPAS{{date('Y')}}</span>
          <i class='bx bx-x' ></i>
        </div>
        <ul class="links">
          <li><a href="#">Inicio</a></li>          
          <li>
            <a href="#">Categorías</a>
            <i class='bx bxs-chevron-down js-arrow arrow '></i>
            <ul class="js-sub-menu sub-menu">
              @foreach($categorias as $cat)
                <li><a href="{{route('cat.resultados')}}?cat={{$cat->Id}}">{{$cat->Nombre}}</a></li>
              @endforeach
            </ul>
          </li>
          
        </ul>
      </div>

    </div>
  </nav>
