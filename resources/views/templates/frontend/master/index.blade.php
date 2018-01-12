<!DOCTYPE html>
<html>
    <head>
        @include('templates.frontend.master.head')
    </head>
    <body>
        <div class="contenedor">
            <header>
                @include('templates.frontend.master.header')
            </header>
            
            @yield('content')
            <section id="banner2">
                <h2>¿Quieres formar parte de las modelos? contactanos o escribe un mail a postulacion@chileangirls.cl</h2>
            </section>
            <div class="pago">
                 M&eacute;todos de Pago.
                 <img src="{{asset('frontend/images/webpay.png')}}">
            </div>
            <footer>
                @include('templates.frontend.master.footer')
            </footer>
        </div>
        <!-- SCRIPTS -->
        @include('templates.frontend.master.script')
        @yield('custom_script')
    </body>
</html>