@extends('templates.admin.public.index')
@section('title', 'Password recovery')
@section('content')
<div class="login-box">
	<div class="login-logo">
    	<a href="{{ route('admin') }}"><img src="{!! asset('admin/images/Logo-MedProzone-M.png') !!}"></a>
	</div>
	<div class="login-box-body">
		<p class="login-box-msg">Change your password</p>
		{!! Form::open(array('id' => 'change-password-form')) !!}
			@if(isset($adminUserPasswordRecovery))
				{!! Form::hidden('adminUserId', $adminUserPasswordRecovery->admin_user_id) !!}
				{!! Form::hidden('adminUserPasswordRecoveryId', $adminUserPasswordRecovery->id) !!}						    		
			@endif
			<div class="form-group has-feedback">
				@if (!isset ($errorMessage))
					<div class="form-group has-feedback">
						{!! Form::password('password', array('id' => 'password', 'class' => 'form-control', 'placeholder' => 'New password')) !!}
						<span class="glyphicon glyphicon-lock form-control-feedback"></span>
					</div>
					<div class="form-group has-feedback">
						{!! Form::password('repeatPassword', array('id' => 'repeatPassword', 'class' => 'form-control', 'placeholder' => 'Password confirmation')) !!}
						<span class="glyphicon glyphicon-lock form-control-feedback"></span>
					</div>
					@if (!isset ($errors))
						<div class="alert alert-danger">
							<p>{{$errors->first('password')}}</p>
							<p>{{$errors->first('repeatPassword')}}</p>
						</div>
					@endif
					@if (Session::has('successMessage'))
			   			<div class="alert alert-success">
							<p>{{ session('successMessage') }}</p>
						</div>
					@endif
				@else
					<div class="alert alert-danger">
						<p>{{ $errorMessage }}</p>
					</div>
					<center>
						<a href="{{route('sign-in')}}">Back to login.</a>
					</center>
				@endif
			</div>
			@if (!isset ($errorMessage))
				<div class="row">
					<div class="col-lg-6 col-lg-offset-3 col-xs-4">
						<button type="submit" class="btn btn-primary btn-block btn-flat">Change password</button>
					</div>
				</div>
			@endif
		{!! Form::close() !!}
	</div>
</div>

@stop

@section('custom_script')
	@if (isset($validator))
		{!! $validator !!}
	@endif
	<script type="text/javascript">
		$( document ).ready(function() {
			var adminUserPasswordRecovery =  '{{isset($adminUserPasswordRecovery) ? $adminUserPasswordRecovery : ''}}';
				
			if (adminUserPasswordRecovery == '') {
				$('#change-password-form :button[type=submit]').attr('disabled',true);
			}
	
			$('form').submit(function()
			{  
		        $('#change-password-form :button[type=submit]');
			}); 
		});
	</script>
@stop


