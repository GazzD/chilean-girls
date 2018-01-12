@extends('templates.frontend.master.index')
@section('title') Modelos -   
@stop
@section('content')
    <div class="wrapper5">
        <div class="perfil">
            <img style="float:left;" src="{{asset($model->profilePicture)}}" alt="{!!$model->nickname!!}}">
            <div class="nombre">
                <h5 style="text-transform: uppercase;">{!!$model->nickname!!}</h5>
                <h6>{!!$model->summary!!}</h6>
                <div class="barrasocial">
                    <ul>
                        <li><a class="texto">Síguela en</a></li>
                        <li><a href="https://instagram.com/{!!$model->instagram!!}" target="_blank" class="icon-instagram"></a></li>
                        <li><a class="texto">Compartir en</a></li>
                        <li><a href="#" class="icon-facebook"></a></li>
                        <li><a href="#" class="icon-twitter"></a></li>
                    </ul>
                </div>
                @if($model->promoVideo)
                    <div style="text-align: center; padding-top: 2em;">
                        <video id="promoVideo" class="" controls controlsList="nodownload" width="300" style="border: 1px solid #ddd;">
                            <source src="{!!asset($model->promoVideo)!!}" type="video/mp4">
                            <source src="{!!asset($model->promoVideo)!!}" type='video/webm; codecs="vp8, vorbis"'/> 
                            <source src="{!!asset($model->promoVideo)!!}" type='video/ogg; codecs="theora, vorbis"'>
                            <source src="{!!asset($model->promoVideo)!!}" type='video/3gpp; codecs="mp4v.20.8, samr"'>
                            Disculpe, no puede ver este video porque su navegador no soporta HTML5. 
                        </video>
                    </div>
                @endif
            </div>
        </div>
    </div>
    @if($model->galleries->count()>0 || $model->videos->count()>0)
    <section id="banner3">
        <nav>
            <ul>
                <li style="cursor: pointer;"><a>FOTOS</a></li>
                <li style="cursor: pointer;"><a>VIDEOS</a></li>
            </ul>
        </nav>
    </section>
    <div class="main2">
        <ul class="list-imag">
            @foreach($model->galleries as $gallery)
                <li><a href="#"><img src="{{asset($gallery->mainImage)}}" alt="{!!$gallery->name!!}" class="image"></a></li>
            @endforeach
        </ul>
    </div>
    @endif
@endsection
@section('custom_script')
    <script type="text/javascript">
        $(document).ready(function() {
            // Block video to be downloaded
            $('#promoVideo').bind('contextmenu',function() { return false; });
        });
    </script>
@stop