@extends('templates.admin.master.index') 
@section('title', 'Account') 
@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-danger">
                <!-- Body -->
                {!! Form::model($adminUser, array('id' => 'changePasswordForm', 'class' => 'panel-body form-horizontal')) !!}
                <div class="box-body">
                    <div class="tab-pane active" id="tab1">
                        <div class="box-body">
                            <div class="form-group">
                                {!! Form::label('password', 'Nueva contraseña', array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
                                <div class="col-lg-8">
                                    {!! Form::password('password', array('id' => 'password', 'class'=>'form-control')) !!}
                                    <span class="help-block help-block-error right-light">{!! $errors->first('password') !!}</span>
                                </div>
                            </div>    
                            <div class="form-group">
                                {!! Form::label('passwordConfirmation', 'Confirmación de contraseña', array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
                                <div class="col-lg-8">
                                    {!! Form::password('passwordConfirmation', array('id' => 'passwordConfirmation', 'class'=>'form-control')) !!}
                                    <span class="help-block help-block-error right-light">{!! $errors->first('passwordConfirmation') !!}</span>
                                </div>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <div class="col-lg-8 col-lg-offset-2">
                                    {!! Form::submit('Guardar', array('class' => 'btn btn-primary')) !!}
                                    <a href="{!! route('account') !!}" class="btn btn-default">Cancelar</a>
                                </div>
                            </div>
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