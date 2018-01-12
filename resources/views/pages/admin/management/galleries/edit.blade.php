@extends('templates.admin.master.index') 
@section('title', 'Modelos') 
@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- Body -->
        <div class="nav-tabs-custom margin">
            <ul class="nav nav-tabs language-tabs">
                <li id="parent_tab1" class="active"><a href="#tab1" data-toggle="tab">General</a></li>
                <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
            </ul>
            {!! Form::model($gallery, array('files' => true, 'id' => 'editGalleryForm', 'class' => 'panel-body form-horizontal')) !!}
                <div class="tab-content">
                    <div class="tab-pane active" id="tab1">
                        <div class="box-body">
                            <div class="form-group">
                                {!! Form::label('name', 'Nombre', array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
                                <div class="col-lg-8">
                                    {!! Form::text('name', null, array('id' => 'name', 'class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('model', 'Modelo', array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
                                <div class="col-lg-8">
                                    <div>
                                        {!! Form::select('model', $models, $gallery->model->id ,array('class' => 'form-control select2', 'placeholder' => 'Selecciona una opci&oacute;n', 'style' => 'width:100% !important;')) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('price', 'Precio', array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
                                <div class="col-lg-8">
                                    {!! Form::text('price', null, array('id' => 'price', 'class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('categoryId', 'Categoría', array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
                                <div class="col-lg-8">
                                    <div>
                                        {!! Form::select('categoryId', $categories, null ,array('class' => 'form-control select2', 'placeholder' => 'Selecciona una opci&oacute;n', 'style' => 'width:100% !important;')) !!}
                                    </div>
                                    <span class="help-block help-block-error right-light">{!! $errors->first('categoryId') !!}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label(null, 'Imagen principal', array('class'=>'col-lg-2 col-sm-2 control-label')) !!} 
                                <div class="col-lg-8">                                
                                    <a id="single_image" href="{!!asset($gallery->mainImage)!!}" title=""> <img class="col-xs-6 col-md-4 col-sm-4 col-lg-4 responsive-img product-img" src="{!!asset($gallery->mainImage)!!}" alt="" style="border: 1px solid #ddd;"/> </a>
                                </div>
                            </div>
                            <div class="form-group" class="file-height">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    {!! Form::label('mainPicture', 'Cambiar imagen principal', array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
                                    <div class="col-lg-8">
                                        {!! Form::file('mainPicture', array('id' => 'mainPicture', 'class' => 'file-upload', 'title' => 'Browse')) !!}
                                        <span class="right-light">{!! $errors->first('mainPicture') !!}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('enabled', 'Habilitado' , array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
                                <div class="col-lg-8">
                                    {!! Form::checkbox('enabled', null, null ,array('class' => 'minimal-red')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('enabled', 'Fotos' , array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
                                <div class="col-lg-8">
                                    @foreach($gallery->pictures as $i => $picture)
                                        <a id="single_image_{{$i}}" href="{!!asset($picture->image)!!}" data-id="{{$i}}" >
                                            <img class="col-xs-6 col-md-4 col-sm-4 col-lg-4 responsive-img product-img" src="{!!asset($picture->image)!!}" style="border: 1px solid #ddd;" />
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('pictures', 'Cambiar las fotos', array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
                                <div class="col-lg-8">
                                    <ul id="pictureList" class="todo-list">
                                        <li id="li-1">
                                            <div class="form-group option-container">
                                                <span class="handle">
                                                    <i class="fa fa-ellipsis-v"></i>
                                                    <i class="fa fa-ellipsis-v"></i>
                                                </span>
                                                <div class="tools">
                                                    <i class="fa fa-trash-o deleteOption" data-id="1"  data-parameter="1"></i>
                                                </div>
                                                <input id="video" class="file-upload" title="Browse" name="pictures[1]" type="file">
                                                <span class="help-block help-block-error right-light">{{ $errors->first('options') }}</span>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="form-group">
                                        <div class="col-lg-12">
                                            <a class="btn btn-primary addOptionButton">Agregar nuevo <i class="fa fa-plus"></i></a>
                                            <br/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <div class="col-lg-8 col-lg-offset-2">
                                {!! Form::submit('Guardar', array('class' => 'btn btn-primary')) !!}
                                <a href="{!! route('management/galleries') !!}" class="btn btn-default">Cancelar</a>
                            </div>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@stop

@section('custom_script')
<script type="text/javascript">

    $(document).ready(function() {
    	// Styles to select
        $(".select2").select2({});
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
        
        // Styles to file upload
        $('input[type=file]').bootstrapFileInput();
        $('.file-inputs').bootstrapFileInput();
        var index = 1;
        var counter = 1;
        $('.addOptionButton').click(function(e){
            e.preventDefault();
            index++;
            counter++;
            
            // Create new row
            var newRow = '<li id="li-'+index+'">'+
                '<div class="form-group option-container">'+
                    '<span class="handle">'+
                        '<i class="fa fa-ellipsis-v"></i>'+
                        '<i class="fa fa-ellipsis-v"></i>'+
                    '</span>'+
                    '<div class="tools">'+
                        '<i class="fa fa-trash-o deleteOption" data-id="'+index+'"  data-parameter="'+index+'"></i>'+
                    '</div>'+
                    '<input id="picture-'+index+'" class="file-upload" title="Browse" name="pictures['+index+']" type="file">'+
                '</div>'+
            '</li>'
            
            var categoryId = $(this).data('id');
            // Add row
            $('#pictureList').append(newRow);
            
            // Add styles
            $('#picture-'+index).bootstrapFileInput();
        });
        
        // Event to remove old option
        $('#pictureList').on('click', '.deleteOption', function(e){
            if(counter>=2){
                // Get element to delete
                var deleteElement = $(this).parent('div').parent('div').parent('li');
                var dataValue = $(this).attr('data-id');
                
                // Remove element
                deleteElement.remove();
                
                // Get element to delete
                var deleteSecondElement = $('i[data-id='+dataValue+']').parent('div').parent('div').parent('li');
                
                // Remove second element            
                deleteSecondElement.remove();
                
                counter--;
            }else{
                alert('La galería tiene que tener al menos una imagen.');
            }
        });
    });

    
</script>
{!! $validator !!}
@stop