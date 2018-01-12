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
            {!! Form::model($model, array('class'=>'form-horizontal panel-body','id' => 'detail-model-form')) !!}
                <div class="tab-content">
                    <div class="tab-pane active" id="tab1">
                        <div class="box-body">
                            <div class="form-group">
                                {!! Form::label('nickname', 'Apodo', array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
                                <div class="col-lg-8">
                                    {!! Form::text('nickname', null, array('id' => 'nickname', 'class' => 'form-control', 'disabled')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('instagram', 'Instagram', array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
                                <div class="col-lg-8">
                                    <div class="input-group">
                                        <span class="input-group-addon">@</span>
                                        {!! Form::text('instagram', null, array('id' => 'instagram', 'class' => 'form-control', 'disabled')) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('summary', 'Resumen', array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
                                <div class="col-lg-8">
                                    {!! Form::textArea('summary', null, array('id' => 'summary', 'class' => 'form-control', 'rows' => '3', 'disabled')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label(null, 'Foto de perfil', array('class'=>'col-lg-2 col-sm-2 control-label')) !!} 
                                <div class="col-lg-8">                                
                                    <a id="single_image" href="{!!asset($model->profilePicture)!!}" title=""> <img class="col-xs-6 col-md-4 col-sm-4 col-lg-4 responsive-img product-img" src="{!!asset($model->profilePicture)!!}" alt="" style="border: 1px solid #ddd;"/> </a>
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label(null, 'Imagen promocional', array('class'=>'col-lg-2 col-sm-2 control-label')) !!} 
                                <div class="col-lg-8">                                
                                    <a id="single_image" href="{!!asset($model->promoPicture)!!}" title=""> <img class="col-xs-6 col-md-4 col-sm-4 col-lg-4 responsive-img product-img" src="{!!asset($model->promoPicture)!!}" alt="" style="border: 1px solid #ddd;"/> </a>
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label(null, 'Video promocional', array('class'=>'col-lg-2 col-sm-2 control-label')) !!} 
                                <div class="col-lg-8">                                
                                    <video id="promoVideo" class="col-xs-6 col-md-4 col-sm-4 col-lg-4 responsive-img product-img" controls controlsList="nodownload" style="border: 1px solid #ddd;">
                                        <source src="{!!asset($model->promoVideo)!!}" type="video/mp4">
                                        <source src="{!!asset($model->promoVideo)!!}" type='video/webm; codecs="vp8, vorbis"'/> 
                                        <source src="{!!asset($model->promoVideo)!!}" type='video/ogg; codecs="theora, vorbis"'>
                                        <source src="{!!asset($model->promoVideo)!!}" type='video/3gpp; codecs="mp4v.20.8, samr"'>
                                        Disculpe, no puede ver este video porque su navegador no soporta HTML5. 
                                    </video>
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label(null, 'Habilitado', array('class'=>'col-lg-2 col-sm-2 control-label')) !!} 
                                <div class="col-lg-8">
                                    <div class="checkbox">
                                    {!! Form::checkbox('enabled', '', null, array('class' => 'minimal-red','disabled' => true)) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <div class="box-body">
                        <div class="form-group">
                            <div class="col-lg-2 col-sm-2"></div>
                            <div class="col-lg-8">
                                <a href="{!!route('management/models/edit', $model->id)!!}" class="btn btn-primary">Editar</a>
                                <a class="btn btn-default" href="{!!route('management/models')!!}">Volver</a>                    
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
            // Block video to be downloaded
            $('#promoVideo').bind('contextmenu',function() { return false; });
            
            // Styles to checkbox
            $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
                checkboxClass: 'icheckbox_minimal-red',
                radioClass: 'iradio_minimal-red'
            });
            
            $('#single_image').on('click',function() {
               $(this).attr('title','<a href="'+ '{!!asset($model->profilePicture)!!}" download> <i class="fa fa-download"></i> Descarga</a>' );
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