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
			{!! Form::model($customer, array('id' => 'addCustomerForm', 'class' => 'panel-body form-horizontal')) !!}
			<div class="tab-content">
				<div class="tab-pane active" id="tab1">			
					<div class="box-body">
						<div class="form-group">
							{!! Form::label('firstName', 'First name', array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
							<div class="col-lg-8">
								{!! Form::text('firstName', '', array('id' => 'firstName', 'class' => 'form-control')) !!}
								<span class="help-block help-block-error right-light">{{ $errors->first('firstName') }}</span>									
							</div>
						</div>
						<div class="form-group">
							{!! Form::label('lastName', 'Last name', array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
							<div class="col-lg-8">
								{!! Form::text('lastName', '', array('id' => 'lastName', 'class' => 'form-control')) !!}
								<span class="help-block help-block-error right-light">{{ $errors->first('lastName') }}</span>									
							</div>
						</div>			
						<div class="form-group">
							{!! Form::label('email', 'Email', array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
							<div class="col-lg-8">
								{!! Form::text('email', '', array('id' => 'email', 'class' => 'form-control')) !!}
								<span class="help-block help-block-error right-light">{{ $errors->first('email') }}</span>									
							</div>
						</div>
						<div class="form-group">
							{!! Form::label('phone', 'Phone', array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
							<div class="col-lg-8">
								{!! Form::text('phone', '', array('id' => 'phone', 'class' => 'form-control')) !!}
								<span class="help-block help-block-error right-light">{{ $errors->first('phone') }}</span>									
							</div>
						</div>
						<div class="form-group">
							{!! Form::label('country', 'Country', array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
							<div class="col-lg-8">
								<div>
									{!! Form::select('country', $countries, null, array('class' => 'form-control select2', 'placeholder' => 'Select one option', 'style' => 'width:100% !important;')) !!}
								</div>
								<span class="right-light">{{ $errors->first('country') }}</span>
							</div>
						</div>						
						<div class="form-group">
							{!! Form::label('address', 'Address', array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
							<div class="col-lg-8">
								{!! Form::textArea('address', '', array('id' => 'address', 'class' => 'form-control')) !!}
								<span class="help-block help-block-error right-light">{{ $errors->first('address') }}</span>									
							</div>
						</div>	
						<div class="form-group">
							{!! Form::label('password', 'Password', array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
							<div class="col-lg-8">
								{!! Form::password('password', array('id' => 'password', 'class'=>'form-control')) !!}				
								<span class="help-block help-block-error right-light">{{ $errors->first('password') }}</span>									
							</div>
						</div>	
						<div class="form-group">
							{!! Form::label('passwordConfirm', 'Password confirmation', array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
							<div class="col-lg-8">
								{!! Form::password('passwordConfirm', array('id' => 'passwordConfirm', 'class'=>'form-control')) !!}				
								<span class="help-block help-block-error right-light">{{ $errors->first('passwordConfirm') }}</span>									
							</div>
						</div>	
					</div>
					<div class="box-body">
						<div class="form-group">
							<div class="col-lg-8 col-lg-offset-2">
								{!! Form::submit('Save', array('class' => 'btn btn-primary')) !!}
								<a href="{{ route('management/customers') }}" class="btn btn-default">Cancel</a>
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
<script type="text/javascript">

    $(document).ready(function() {
    	// Styles to select
		$(".select2").select2({
			minimumResultsForSearch: Infinity
		});

    });
    
</script>
@stop