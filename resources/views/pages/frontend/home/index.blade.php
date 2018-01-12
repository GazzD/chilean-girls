@extends('templates.frontend.master.index')
@section('title')
    Inicio
@stop
@section('content')
    <div class="wrapper">
        <div class="slideshow">
            <ul class="slider">
                @foreach($carouselItems as $carouselItem)
                    <li><a href="{{$carouselItem->link}}" target="{{$carouselItem->target}}"><img src="{{asset($carouselItem->image)}}" alt="{!!$carouselItem->name!!}"></a></li>
                @endforeach
            </ul>
            <ol class="pagination">
            </ol>
            <div class="left">
                <span class="icon-chevron-thin-left"></span>
            </div>
            <div class="right">
                <span class="icon-chevron-thin-right"></span>
            </div>    
        </div>
    </div>
    
    <section id="banner">
        <h2>Conoce a las chilenas mas sensuales y seguidas de instagram</h2>
    </section>
    
    <div class="main">
        <ul class="list-imag">
            @foreach($models as $model)
                <li><a href="{!!route('models', $model->friendlyUrl)!!}"><img src="{{asset($model->promoPicture)}}" alt="" class="image"></a></li>
            @endforeach
        </ul>
    </div>
@endsection