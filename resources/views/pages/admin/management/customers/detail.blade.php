@extends('templates.admin.master.index') @section('title', 'Customer')
@section('content')
<div class="row">
	<div class="col-md-12">
		<!-- Body -->
		<div class="nav-tabs-custom margin">
			<ul class="nav nav-tabs language-tabs">
				<li id="parent_tab1" class="active"><a href="#tab1" data-toggle="tab">General</a></li>
			</ul>		
			{{ Form::model($customer, array('class'=>'form-horizontal panel-body','id' => 'detail-customer-form')) }}
				<div class="tab-content">
					<div class="tab-pane active" id="tab1">
						<div class="box-body">
							<div class="form-group">
								{{ Form::label(null, 'First name', array('class'=>'col-lg-2 col-sm-2 control-label')) }} 
								<div class="col-lg-8">								
									{{ Form::text('firstName', null, array('class'=>'form-control', 'id' => 'firstName', 'disabled')) }}
								</div>
							</div>
							<div class="form-group">
								{{ Form::label(null, 'Last name', array('class'=>'col-lg-2 col-sm-2 control-label')) }} 
								<div class="col-lg-8">								
									{{ Form::text('lastName', null, array('class'=>'form-control', 'id' => 'lastName', 'disabled')) }}
								</div>
							</div>
							<div class="form-group">
								{{ Form::label(null, 'Email', array('class'=>'col-lg-2 col-sm-2 control-label')) }} 
								<div class="col-lg-8">								
									{{ Form::text('email', null, array('class'=>'form-control', 'id' => 'email', 'disabled')) }}
								</div>
							</div>
							<div class="form-group">
								{{ Form::label(null, 'Phone', array('class'=>'col-lg-2 col-sm-2 control-label')) }} 
								<div class="col-lg-8">								
									{{ Form::text('phone', null, array('class'=>'form-control', 'id' => 'phone', 'disabled')) }}
								</div>
							</div>
							<div class="form-group">
								{{ Form::label(null, 'Status', array('class'=>'col-lg-2 col-sm-2 control-label')) }} 
								<div class="col-lg-8">								
									{{ Form::text('status', null, array('class'=>'form-control', 'id' => 'status', 'disabled')) }}
								</div>
							</div>
							<div class="form-group">
								{{ Form::label(null, 'Country', array('class'=>'col-lg-2 col-sm-2 control-label')) }} 
								<div class="col-lg-8">								
									{{ Form::text('countryId', $customer->country->name, array('class'=>'form-control', 'id' => 'countryId', 'disabled')) }}
								</div>
							</div>
							<div class="form-group">
								{{ Form::label(null, 'Address', array('class'=>'col-lg-2 col-sm-2 control-label')) }} 
								<div class="col-lg-8">								
									{{ Form::text('address', null, array('class'=>'form-control', 'id' => 'address', 'disabled')) }}
								</div>
							</div>
						</div>
					</div>
				
					<div class="box-body">
						<div class="form-group">
							<div class="col-lg-8 col-lg-offset-2">
								@if(App\Auth::hasPermission('management/customers/edit'))							
									<a  href="{{route('management/customers/edit', $customer->id)}}" class="btn btn-primary" >Edit</a>
								@endif
								<a class="btn btn-default" href="{{route('management/customers')}}">Back</a>					
							</div>
						</div>
					</div>
				</div>
			{{Form::close()}}
		</div>
	</div>
</div>
@stop 

