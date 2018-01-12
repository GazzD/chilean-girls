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
            {!! Form::model($video, array('files' => true, 'id' => 'editGirlModelForm', 'class' => 'panel-body form-horizontal')) !!}
                <div class="tab-content">
                    <div class="tab-pane active" id="tab1">
                        <div class="box-body">
                            <div class="form-group">
                                {!! Form::label('name', 'Nombre', array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
                                <div class="col-lg-8">
                                    {!! Form::text('name', null, array('id' => 'name', 'class' => 'form-control')) !!}
                                    <span class="help-block help-block-error right-light">{!! $errors->first('name') !!}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('model', 'Modelo', array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
                                <div class="col-lg-8">
                                    <div>
                                        {!! Form::select('model', $models, $video->modelId ,array('class' => 'form-control select2', 'placeholder' => 'Selecciona una opci&oacute;n', 'style' => 'width:100% !important;')) !!}
                                    </div>
                                    <span class="help-block help-block-error right-light">{!! $errors->first('model') !!}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('price', 'Precio', array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
                                <div class="col-lg-8">
                                    {!! Form::text('price', null, array('id' => 'price', 'class' => 'form-control')) !!}
                                    <span class="help-block help-block-error right-light">{!! $errors->first('price') !!}</span>
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
                                {!! Form::label('summary', 'Descripción', array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
                                <div class="col-lg-8">
                                    {!! Form::textArea('summary', null, array('id' => 'summary', 'class' => 'form-control', 'rows' => '3')) !!}
                                    <span class="help-block help-block-error right-light">{!! $errors->first('summary') !!}</span>
                                </div>
                            </div>
                            <div class="form-group">
                            	{!! Form::label('video', 'Video', array('class' => 'col-lg-2 control-label')) !!}
                                <div class="col-lg-8">
                                    <video class="col-xs-6 col-md-4 col-sm-4 col-lg-4 responsive-img product-img" controls controlsList="nodownload" style="border: 1px solid #ddd;">
                                        <source src="{!!asset($video->video)!!}" type="video/mp4">
                                        <source src="{!!asset($video->video)!!}" type='video/webm; codecs="vp8, vorbis"'/> 
                                        <source src="{!!asset($video->video)!!}" type='video/ogg; codecs="theora, vorbis"'>
                                        <source src="{!!asset($video->video)!!}" type='video/3gpp; codecs="mp4v.20.8, samr"'>
                                        Disculpe, no puede ver este video porque su navegador no soporta HTML5.
                                    </video>
                                </div>
                            </div>
                            <div class="form-group" class="file-height">
                                <span class="has-error">{!! $errors->first('video') !!}</span>
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    {!! Form::label('video', 'Cambiar video', array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
                                    <div class="col-lg-8">
                                        {!! Form::file('video', array('id' => 'video', 'class' => 'file-upload', 'title' => 'Browse')) !!}
                                        <span class="right-light">{!! $errors->first('video') !!}</span>        
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('enabled', 'Habilitado' , array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
                                <div class="col-lg-8">
                                    <div class="checkbox">
                                        {!! Form::checkbox('enabled', null, $video->enabled ,array('class' => 'minimal-red')) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <div class="col-lg-8 col-lg-offset-2">
                                {!! Form::submit('Guardar', array('class' => 'btn btn-primary')) !!}
                                <a href="{!! route('management/videos') !!}" class="btn btn-default">Cancelar</a>
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
        $(".select2").select2({
            minimumResultsForSearch: Infinity
        });
        
        // Styles to checkbox
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass: 'iradio_minimal-red'
        });
        
        // Styles to file upload
        $('input[type=file]').bootstrapFileInput();
        $('.file-inputs').bootstrapFileInput();
    });

    
</script>
{!! $validator !!}
@stop