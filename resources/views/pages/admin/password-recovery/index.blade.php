@extends('templates.admin.public.index')
@section('title', 'Password recovery')
@section('content')	 

<div class="login-box">
	<div class="login-logo">
    	<a href="{{ route('admin') }}"><img src="{!! asset('admin/images/Logo-MedProzone-M.png') !!}"></a>
	</div>
	<div class="login-box-body">
		<p class="login-box-msg">Password recovery</p>
		{!! Form::open(array('id' => 'password-recovery-form')) !!}
			<div class="form-group has-feedback">
				{!! Form::text('email', null, array('id' => 'email', 'class' => 'form-control', 'placeholder' => 'Email')) !!}
				<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
				<span class="error-help-block">{{$errors->first('email')}}</span>
			</div>
			
			<div class="row">
				<div class="col-xs-12">
					@if(session()->has('errorMessage'))
						<div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<p>{{ session('errorMessage') }}</p>
						</div>
					@endif
					@if (Session::has('successMessage'))
			   			<div class="alert alert-success">
			   				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<p>{{ session('successMessage') }}</p>
						</div>
					@endif
				</div>
			</div>
			
			<div class="row">
				<div class="col-lg-6 col-lg-offset-3 col-xs-4">
					<button type="submit" class="btn btn-primary btn-block btn-flat">Recover password</button>
				</div>
				<div class="col-lg-6 col-lg-offset-4 col-xs-4">
					<a href="{{route('sign-in')}}">Back to login.</a>
				</div>
			</div>
		{!! Form::close() !!}
	</div>
</div>
@stop

@section('custom_script')
	{!! $validator !!}
@stop