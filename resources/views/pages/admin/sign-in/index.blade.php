@extends('templates.admin.public.index')
@section('title', trans('frontend/sections.sign-in'))

@section('content')	 

<div class="login-box">
    <div class="login-logo">
        <a href="{{ route('admin') }}"><img src="{!! asset('frontend/images/logo-all.png') !!}" style="max-height: 200px;"></a>
    </div>
	<div class="login-box-body">
		<p class="login-box-msg">Iniciar sesi&oacute;n</p>
		{!! Form::open(array('route' => 'sign-in/authenticate', 'id' => 'sign-in-form')) !!}
			<div class="form-group has-feedback">
				{!! Form::text('email', null, array('id' => 'email', 'class' => 'form-control', 'placeholder' => 'Correo electrónico')) !!}
				<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
				<span class="error-help-block">{{$errors->first('email')}}</span>
			</div>
			
			<div class="form-group has-feedback">
				{!! Form::password('password', array('id' => 'password', 'class' => 'form-control', 'placeholder' => 'Contraseña')) !!}
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			</div>
			
			@if(session()->has('error-message'))
				<div class="row">
					<div class="col-xs-12">
						<div class="alert alert-danger">
							<p>{{ session('error-message') }}</p>
						</div>
					</div>
				</div>
			@endif
			
			<div class="row">
				<div class="col-xs-8">
					<div class="checkbox icheck">
						<label>
							<a href="{{route('password-recovery')}}">Olvid&eacute; mi contrase&ntilde;a</a><br>
						</label>
					</div>
				</div>
				
				<div class="col-xs-4">
					<button type="submit" class="btn btn-primary btn-block btn-flat">Enviar</button>
				</div>
			</div>
		{!! Form::close() !!}
	</div>
</div>
@stop

@section('custom_script')
	{!! $validator !!}
@stop