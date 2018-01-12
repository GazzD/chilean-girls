@extends('templates.admin.master.index') 
@section('title', 'Modelos')
@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- Body -->
        <div class="nav-tabs-custom margin">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab1" data-toggle="tab">General</a></li>
            </ul>
            {!! Form::model($gallery, array('class'=>'form-horizontal panel-body','id' => 'detail-video-form')) !!}
                <div class="tab-content">
                    <div class="tab-pane active" id="tab1">
                        <div class="box-body">
                            <div class="form-group">
                                {!! Form::label('name', 'Nombre', array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
                                <div class="col-lg-8">
                                    {!! Form::text('name', null, array('id' => 'name', 'class' => 'form-control', 'disabled')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('model', 'Modelo', array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
                                <div class="col-lg-8">
                                    <div>
                                        {!! Form::text('model', $gallery->model->nickname,array('class' => 'form-control select2', 'disabled')) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('price', 'Precio', array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
                                <div class="col-lg-8">
                                    {!! Form::text('price', null, array('id' => 'price', 'class' => 'form-control', 'disabled')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('category', 'Categoría', array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
                                <div class="col-lg-8">
                                    <div>
                                        {!! Form::text('category', $gallery->category->name,array('class' => 'form-control select2', 'disabled')) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label(null, 'Imagen principal', array('class'=>'col-lg-2 col-sm-2 control-label')) !!} 
                                <div class="col-lg-8">                                
                                    <a id="single_image" href="{!!asset($gallery->mainImage)!!}" title=""> <img class="col-xs-6 col-md-4 col-sm-4 col-lg-4 responsive-img product-img" src="{!!asset($gallery->mainImage)!!}" alt="" style="border: 1px solid #ddd;"/> </a>
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('enabled', 'Habilitado' , array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
                                <div class="col-lg-8">
                                    {!! Form::checkbox('enabled', null, null ,array('class' => 'minimal-red', 'disabled')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('enabled', 'Imágenes' , array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
                                <div class="col-lg-8">
                                    @foreach($gallery->pictures as $picture)
                                        <a id="single_image" href="{!!asset($picture->image)!!}" title="">
                                            <img class="col-xs-6 col-md-4 col-sm-4 col-lg-4 responsive-img product-img" src="{!!asset($picture->image)!!}" style="border: 1px solid #ddd;" />
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="box-body">
                        <div class="form-group">
                            <div class="col-lg-2 col-sm-2"></div>
                            <div class="col-lg-8">
                                <a href="{!!route('management/galleries/edit', $gallery->id)!!}" class="btn btn-primary">Editar</a>
                                <a class="btn btn-default" href="{!!route('management/galleries')!!}">Volver</a>                    
                            </div>
                        </div>
                    </div>
                </div>
            {!!Form::close()!!}
        </div>
    </div>
</div>
@stop
@section('custom_script')

    {!! Html::script('frontend/js/collapse/simple-expand.min.js') !!}
    {!! Html::script('frontend/js/jquery.magnific-popup.js') !!}
    
    <script type="text/javascript">
    
        $(document).ready(function() {
    
            // Styles to checkbox
            $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
                checkboxClass: 'icheckbox_minimal-red',
                radioClass: 'iradio_minimal-red'
            });

            $('#single_image').on('click',function() {
               $(this).attr('title','<a href="'+ '{!!asset($gallery->mainImage)!!}" download> <i class="fa fa-download"></i> Descarga</a>' );
                $('#single_image').fancybox({
                    helpers : {
                        title: {
                            type: 'inside'
                        }
                    },
                });
            });
            
        });
    
        
    </script>
@stop