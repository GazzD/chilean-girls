@extends('templates.admin.public.index')
@section('title', 'Password recovery')
@section('content')
<div class="login-box">
	<div class="login-logo">
    	<a href="{{ route('admin') }}"><img src="{!! asset('admin/images/Logo-MedProzone-M.png') !!}"></a>
	</div>
	<div class="login-box-body">
		<p class="login-box-msg">Password recovery</p>
		@if(session()->has('errorMessage'))
			<div class="alert alert-danger">
				<p>{{ session('errorMessage') }}</p>
			</div>
		@endif
		@if (Session::has('successMessage'))
   			<div class="alert alert-success">
				<p>{{ session('successMessage') }}</p>
			</div>
		@endif
		<p class="login-box-msg">
			<a href="{{route('sign-in')}}">Back to login.</a>
		<p class="login-box-msg">
	</div>
</div>
	
@stop



