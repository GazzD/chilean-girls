@extends('templates.admin.master.index') 
@section('title', 'Customer Addresses') 
@section('content')
<div class="row">
	<div class="col-md-12">
		<!-- Body -->
		<div class="nav-tabs-custom margin">
			<ul class="nav nav-tabs language-tabs">
				<li id="parent_tab1" class="active"><a href="#tab1" data-toggle="tab">General</a></li>
			</ul>	
			{!! Form::model($customerAddress, array('id' => 'editCustomerAddressForm', 'class' => 'panel-body form-horizontal')) !!}
				<div class="tab-content">
					<div class="tab-pane active" id="tab1">
						<div class="box-body">
							<div class="form-group">
								{{ Form::label('name', 'Name', array('class'=>'col-lg-2 col-sm-2 control-label')) }} 
								<div class="col-lg-8">
									{{ Form::text('name', null, array('class'=>'form-control', 'id' => 'name')) }}
								</div>
							</div>
							<div class="form-group">
								{!! Form::label('address_line_1', 'Address line 1' , array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
								<div class="col-lg-8">
									{!! Form::text('address_line_1', null, array('class'=>'form-control', 'id' => 'address_line_1')) !!}
								</div>
							</div>
							<div class="form-group">
								{!! Form::label('address_line_2', 'Address line 2' , array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
								<div class="col-lg-8">
									{!! Form::text('address_line_2', null, array('class'=>'form-control', 'id' => 'address_line_2')) !!}
								</div>
							</div>
							<div class="form-group">
								{!! Form::label('city', 'City' , array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
								<div class="col-lg-8">
									{!! Form::text('city', null, array('class'=>'form-control', 'id' => 'city')) !!}
								</div>
							</div>
							<div class="form-group">
								{!! Form::label('state', 'State' , array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
								<div class="col-lg-8">
									<div>
										{!! Form::select('state', $states, $customerAddress->state->id , array('class' => 'form-control select2', 'placeholder' => 'Select one option')) !!}
									</div>
								</div>
							</div>
							<div class="form-group">
								{!! Form::label('zip', 'ZIP' , array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
								<div class="col-lg-8">
									{!! Form::text('zip', null, array('class'=>'form-control', 'id' => 'city')) !!}
								</div>
							</div>
							<div class="form-group">
								{!! Form::label('country', 'Country' , array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
								<div class="col-lg-8">
									{!! Form::text('country', $customerAddress->country->name, array('class' => 'form-control', 'disabled')) !!}
								</div>
							</div>
							<div class="form-group">
								{!! Form::label('phone', 'Phone' , array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
								<div class="col-lg-8">
									{!! Form::text('phone', null, array('class'=>'form-control', 'id' => 'phone')) !!}
								</div>
							</div>
						</div>
					</div>
					<div class="box-body">
						<div class="form-group">
							<div class="col-lg-8 col-lg-offset-2">
								{!! Form::submit('Save', array('class' => 'btn btn-primary')) !!}
								<a href="{{ route('management/customers/addresses', $customerAddress->customerId) }}" class="btn btn-default">Cancel</a>
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
		$(".select2").select2();
		
		// Styles to checkbox
	    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
			checkboxClass: 'icheckbox_minimal-red',
			radioClass: 'iradio_minimal-red'
	    });
        
    });
    
</script>
{!! $validator !!}
@stop	