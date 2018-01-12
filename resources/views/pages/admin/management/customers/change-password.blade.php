@extends('templates.admin.master.index') 
@section('title', 'Customers') 
@section('content')
<div class="row">
	<div class="col-md-12">
	<!-- Body -->
	<div class="nav-tabs-custom margin">
		<ul class="nav nav-tabs language-tabs">
			<li id="parent_tab1" class="active"><a href="#tab1" data-toggle="tab">General</a></li>
		</ul>		
		{!! Form::model($customer, array('route' => array('management/customers/change-password', $customer->id), 'id' => 'changePasswordForm', 'class' => 'panel-body form-horizontal')) !!}
		<div class="tab-content">
			<div class="tab-pane active" id="tab1">		
				<div class="box-body">		
					<div class="form-group">
						{!! Form::label('password', 'Password', array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
						<div class="col-lg-8">
							{!! Form::password('password', array('id' => 'password', 'class'=>'form-control')) !!}				
							<span class="help-block help-block-error right-light">{{ $errors->first('password') }}</span>									
						</div>
					</div>	
					<div class="form-group">
						{!! Form::label('passwordConfirmation', 'Password confirmation', array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
						<div class="col-lg-8">
							{!! Form::password('passwordConfirmation', array('id' => 'passwordConfirmation', 'class'=>'form-control')) !!}				
							<span class="help-block help-block-error right-light">{{ $errors->first('passwordConfirmation') }}</span>									
						</div>
					</div>	
				</div>
				<div class="box-body">
					<div class="form-group">
						<div class="col-lg-8 col-lg-offset-2">
							{!! Form::submit('Save', array('class' => 'btn btn-primary')) !!}
							@if(App\Auth::hasPermission('management/customers/edit'))							
								<a href="{{ route('management/customers/edit', $customer->id) }}" class="btn btn-default">Cancel</a>
							@endif							
						</div>
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
	{!! $validator !!}
@stop