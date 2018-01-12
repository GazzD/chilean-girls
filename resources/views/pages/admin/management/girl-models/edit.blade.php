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
            {!! Form::model($model, array('files' => true, 'id' => 'editGirlModelForm', 'class' => 'panel-body form-horizontal')) !!}
                <div class="tab-content">
                    <div class="tab-pane active" id="tab1">
                        <div class="box-body">
                            <div class="form-group">
                                {!! Form::label('nickname', 'Apodo', array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
                                <div class="col-lg-8">
                                    {!! Form::text('nickname', null, array('id' => 'nickname', 'class' => 'form-control')) !!}
                                    <span class="help-block help-block-error right-light">{!! $errors->first('nickname') !!}</span>                                    
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('instagram', 'Instagram', array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
                                <div class="col-lg-8">
                                    <div class="input-group">
                                        <span class="input-group-addon">@</span>
                                        {!! Form::text('instagram', null, array('id' => 'instagram', 'class' => 'form-control')) !!}
                                    </div>
                                        <span class="help-block help-block-error right-light">{!! $errors->first('instagram') !!}</span>                                    
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('summary', 'Resumen', array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
                                <div class="col-lg-8">
                                    {!! Form::textArea('summary', null, array('id' => 'summary', 'class' => 'form-control', 'rows' => '3')) !!}
                                    <span class="help-block help-block-error right-light">{!! $errors->first('summary') !!}</span>                                    
                                </div>
                            </div>
                            <div class="form-group">
                            	{!! Form::label('profileImage', 'Foto de perfil', array('class' => 'col-lg-2 control-label')) !!}
                                <div class="col-lg-8">                                
                                    <img class="col-xs-6 col-md-4 col-sm-4 col-lg-4 responsive-img" src="{!!asset($model->profilePicture)!!}" style="border: 1px solid #ddd;"/>
                                </div>
                            </div>
                            <div class="form-group" class="file-height">
                                <span class="has-error">{!! $errors->first('profileImage]') !!}</span>
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    {!! Form::label('profileImage', 'Cambiar imagen', array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
                                    <div class="col-lg-8">
                                        {!! Form::file('profileImage', array('id' => 'profileImage', 'class' => 'file-upload', 'title' => 'Browse')) !!}
                                        <span class="right-light">{!! $errors->first('profileImage') !!}</span>        
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                            	{!! Form::label('promoPicture', 'Imagen promocional', array('class' => 'col-lg-2 control-label')) !!}
                                <div class="col-lg-8">                                
                                    <img class="col-xs-6 col-md-4 col-sm-4 col-lg-4 responsive-img" src="{!!asset($model->promoPicture)!!}" style="border: 1px solid #ddd;"/>
                                </div>
                            </div>
                            <div class="form-group" class="file-height">
                                <span class="has-error">{!! $errors->first('promoPicture]') !!}</span>
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    {!! Form::label('promoPicture', 'Cambiar imagen', array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
                                    <div class="col-lg-8">
                                        {!! Form::file('promoPicture', array('id' => 'promoPicture', 'class' => 'file-upload', 'title' => 'Browse')) !!}
                                        <span class="right-light">{!! $errors->first('promoPicture') !!}</span>        
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                            	{!! Form::label('promoVideo', 'Video promocional', array('class' => 'col-lg-2 control-label')) !!}
                                <div class="col-lg-8">
                                    @if($model->promoVideo)
                                    <video class="col-xs-6 col-md-4 col-sm-4 col-lg-4 responsive-img product-img" controls controlsList="nodownload" style="border: 1px solid #ddd;">
                                        <source src="{!!asset($model->promoVideo)!!}" type="video/mp4">
                                        <source src="{!!asset($model->promoVideo)!!}" type='video/webm; codecs="vp8, vorbis"'/> 
                                        <source src="{!!asset($model->promoVideo)!!}" type='video/ogg; codecs="theora, vorbis"'>
                                        <source src="{!!asset($model->promoVideo)!!}" type='video/3gpp; codecs="mp4v.20.8, samr"'>
                                        Disculpe, no puede ver este video porque su navegador no soporta HTML5. 
                                    </video>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group" class="file-height">
                                <span class="has-error">{!! $errors->first('promoVideo]') !!}</span>
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    {!! Form::label('promoVideo', 'Cambiar video', array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
                                    <div class="col-lg-8">
                                        {!! Form::file('promoVideo', array('id' => 'promoVideo', 'class' => 'file-upload', 'title' => 'Browse')) !!}
                                        <span class="right-light">{!! $errors->first('promoVideo') !!}</span>        
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('enabled', 'Habilitado' , array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
                                <div class="col-lg-8">
                                    <div class="checkbox">
                                        {!! Form::checkbox('enabled', null, $model->enabled ,array('class' => 'minimal-red')) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <div class="col-lg-8 col-lg-offset-2">
                                {!! Form::submit('Guardar', array('class' => 'btn btn-primary')) !!}
                                <a href="{!! route('management/models') !!}" class="btn btn-default">Cancelar</a>
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