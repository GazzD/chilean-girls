@extends('templates.admin.master.index') 
@section('title', 'Account') 
@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-danger">
                <!-- Body -->
                {!! Form::model($adminUser, array('id' => 'settingsForm', 'class' => 'panel-body form-horizontal')) !!}
                <div class="box-body">
                    <div class="form-group">
                        {!! Form::label('firstName', 'Nombre', array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
                        <div class="col-lg-8">
                            {!! Form::text('firstName', null, array('id' => 'firstName', 'class' => 'form-control', 'disabled')) !!}
                            <span class="help-block help-block-error right-light">{!! $errors->first('firstName') !!}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('lastName', 'Apellido', array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
                        <div class="col-lg-8">
                            {!! Form::text('lastName', null, array('id' => 'lastName', 'class' => 'form-control', 'disabled')) !!}
                            <span class="help-block help-block-error right-light">{!! $errors->first('lastName') !!}</span>
                        </div>
                    </div>            
                    <div class="form-group">
                        {!! Form::label('email', 'Correo electrónico', array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
                        <div class="col-lg-8">
                            {!! Form::text('email', null, array('id' => 'email', 'class' => 'form-control', 'disabled')) !!}
                            <span class="help-block help-block-error right-light">{!! $errors->first('email') !!}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('phone', 'Teléfono', array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
                        <div class="col-lg-8">
                            {!! Form::text('phone', null, array('id' => 'phone', 'class' => 'form-control', 'disabled')) !!}
                            <span class="help-block help-block-error right-light">{!! $errors->first('phone') !!}</span>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <div class="col-lg-8 col-lg-offset-2">
                            <a class="btn btn-primary" href="{!!route('account/change-password')!!}">Cambiar contraseña</a>
                            <a href="{!!route('admin')!!}" class="btn btn-default">Cancelar</a>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>        
        </div>
    </div>
</section>
@stop

@section('custom_script')
{!! $validator !!}
@stop