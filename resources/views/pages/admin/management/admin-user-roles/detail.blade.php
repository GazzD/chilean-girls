@extends('templates.admin.master.index') 
@section('title', 'Admin user roles')
@section('content')
<div class="row">
	<div class="col-md-12">
		<!-- Body -->
		<div class="nav-tabs-custom margin">
			<ul class="nav nav-tabs language-tabs">
				<li id="parent_tab1" class="active"><a href="#tab1" data-toggle="tab">General</a></li>
			</ul>
			{{ Form::model($adminUserRole, array('class'=>'form-horizontal panel-body','id' => 'detail-admin-user-role-form')) }}
				<div class="tab-content">
					<div class="box-body">
						<div class="form-group">
							{{ Form::label(null, 'Name', array('class'=>'col-lg-2 col-sm-2 control-label')) }} 
							<div class="col-lg-8">
								{{ Form::text('name', null, array('class'=>'form-control', 'id' => 'name', 'disabled')) }}
							</div>
						</div>
						<div class="form-group">
							{{ Form::label(null, 'Permissions', array('class'=>'col-lg-2 col-sm-2 control-label')) }} 
							<div class="col-lg-8">
							@foreach ($adminUserRole->permissions as $adminUserPermission)
							 	{{ Form::text('adminUserPermission', $adminUserPermission->code.'-'.$adminUserPermission->name, array('class'=>'form-control', 'id' => 'role', 'disabled')) }}
							@endforeach
							</div>
						</div>
						<div class="form-group">
							{{ Form::label(null, 'Enabled', array('class'=>'col-lg-2 col-sm-2 control-label')) }} 
							<div class="col-lg-8">	
								<div class="checkbox">
								{{ Form::checkbox('enabled', '', null, array('class' => 'minimal-red','disabled' => true)) }}
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="box-body">
					<div class="form-group">
						<div class="col-lg-8 col-lg-offset-2">
						@if(App\Auth::hasPermission('management/admin-user-roles/edit'))
							<a  href="{{route('management/admin-user-roles/edit', $adminUserRole->id)}}" class="btn btn-primary">Edit</a>
						@endif	
							<a class="btn btn-default" href="{{route('management/admin-user-roles')}}">Back</a>					
						</div>
					</div>
				</div>			
			{{Form::close()}}
		</div>
	</div>
</div>
@stop

@section('custom_script')

	<script type="text/javascript">
	    $(document).ready(function() {
			// Styles to checkbox
		    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({  
				checkboxClass: 'icheckbox_minimal-red',
				radioClass: 'iradio_minimal-red'
		    });
	    });
	</script>
@stop