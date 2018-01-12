<div class="wrapper">
    <div class="logotipo"> 
        <a href="{{route('home')}}"><img src="{{asset('frontend/images/logo.png')}}" style="max-height: 45px;" alt="ChileanGirls"></a>
    </div>
    <div class="menu_bar">
        <a class="bt-menu" style="cursor: pointer;"><span class="icon-menu"></span></a>
    </div>
    <nav>
        <ul>
            <li><a href="#">Modelos</a></li>
            <li class="submenu">
                <a href="#">Categor&iacute;as<span class="caret icon-chevron-small-down"></span></a>
                <ul class="children">
                    <li><a href="#">Profesional <span class="icon-dot-single"></span></a></li>
                    <li><a href="#">Amateur <span class="icon-dot-single"></span></a></li>
                    <li><a href="#">Cosplays <span class="icon-dot-single"></span></a></li>
                </ul>
            </li>
            @if(Auth::check())
            <li><a>{{Auth::user()->name}}</a></li>
            <li><a href="{{route('flogout')}}">Cerrar sesión</a></li>
            @else
            <li><a href="{{route('register')}}">Reg&iacute;strate</a></li>
            <li><a href="{{route('flogin')}}">Ingresa</a></li>
            @endif
        </ul>
    </nav>
</div>