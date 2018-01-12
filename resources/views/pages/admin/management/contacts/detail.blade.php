@extends('templates.admin.master.index') @section('title', 'Contact')
@section('content')
<div class="row">
	<div class="col-md-12">
		<!-- Body -->
		<div class="nav-tabs-custom margin">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tab1" data-toggle="tab">General</a></li>
			</ul>
			{{ Form::model($contact, array('class'=>'form-horizontal panel-body','id' => 'detail-contact-form')) }}
				<div class="tab-content">
					<div class="tab-pane active" id="tab1">
						<div class="box-body">
							<div class="form-group">
								{{ Form::label(null, 'First name', array('class'=>'col-lg-2 col-sm-2 control-label')) }}
								<div class="col-lg-8">
									{{ Form::text('firstName', null, array('class'=>'form-control', 'id'=> 'firstName', 'disabled')) }}
								</div>
							</div>
							<div class="form-group">
								{{ Form::label(null, 'Last name', array('class'=>'col-lg-2 col-sm-2 control-label')) }} 
								<div class="col-lg-8">
								 	{{ Form::text('lastName', null, array('class'=>'form-control', 'id' => 'lastName', 'disabled')) }}
								</div>
							</div>
							<div class="form-group">
								{{ Form::label(null, 'Profession', array('class'=>'col-lg-2 col-sm-2 control-label')) }} 
								<div class="col-lg-8">
									{{ Form::text('profession', null, array('class'=>'form-control', 'id' => 'profession', 'disabled')) }}
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
								{{ Form::label(null, 'Mobile', array('class'=>'col-lg-2 col-sm-2 control-label')) }} 
								<div class="col-lg-8">
									{{ Form::text('mobile', null, array('class'=>'form-control', 'id' => 'mobile', 'disabled')) }}
								</div>
							</div>
							<div class="form-group">
								{{ Form::label(null, 'Ip address', array('class'=>'col-lg-2 col-sm-2 control-label')) }} 
								<div class="col-lg-8">
									{{ Form::text('ipAddress', null, array('class'=>'form-control', 'id' => 'ipAddress', 'disabled')) }}
								</div>
							</div>
							<div class="form-group">
								{{ Form::label(null, 'Date', array('class'=>'col-lg-2 col-sm-2 control-label')) }}
								<div class="col-lg-8">
									{{ Form::text('dateContact', App\Helpers::adminFormatDate($contact->dateContact), array('class'=>'form-control', 'id'=> 'dateContact', 'disabled')) }}
								</div>
							</div>
							<div class="form-group">
								{{ Form::label(null, 'Subject', array('class'=>'col-lg-2 col-sm-2 control-label')) }} 
								<div class="col-lg-8">
									{{ Form::text('subject', null, array('class'=>'form-control', 'id' => 'subject', 'disabled')) }}
								</div>
							</div>
							<div class="form-group">
								{{ Form::label(null, 'Message', array('class'=>'col-lg-2 col-sm-2 control-label')) }} 
								<div class="col-lg-8">
									{{ Form::textarea('message', null, array('class'=>'form-control', 'id' => 'message', 'disabled')) }}
								</div>
							</div>
						</div>
					</div>
				
					<div class="box-body">
						<div class="form-group">
							<div class="col-lg-8 col-lg-offset-2">
								<a class="btn btn-default" href="{{route('management/contacts')}}">Back</a>					
							</div>
						</div>
					</div>
				</div>
			{{Form::close()}}
		</div>
	</div>
</div>
@stop 