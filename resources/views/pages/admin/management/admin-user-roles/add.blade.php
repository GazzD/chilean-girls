@extends('templates.admin.master.index') 
@section('title', 'Admin user Roles') 
@section('content')
<div class="row">
	<div class="col-md-12">
		<!-- Body -->
		<div class="nav-tabs-custom margin">
			<ul class="nav nav-tabs language-tabs">
				<li id="parent_tab1" class="active"><a href="#tab1" data-toggle="tab">General</a></li>
			</ul>
			{!! Form::model($adminUserRole, array('files' => true, 'id' => 'addAdminUserRoleForm', 'class' => 'panel-body form-horizontal')) !!}
				<div class="tab-content">
					<div class="tab-pane active" id="tab1">
						<div class="box-body">
							<div class="form-group">
								{!! Form::label('name', 'Name', array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
								<div class="col-lg-8">
									{!! Form::text('name', null , array('class' => 'form-control')) !!}
									<span class="help-block help-block-error right-light">{{ $errors->first('name') }}</span>									
								</div>
							</div>
							<div class="form-group">
								{!! Form::label('adminUserPermissionIds', 'Permissions', array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
								<div class="col-lg-8">
									<div>
										{!! Form::select('adminUserPermissionIds[]', $adminUserPermissions, null, array('class' => 'form-control select2', 'multiple')) !!}
									</div>
									<span class="help-block help-block-error right-light">{{ $errors->first('adminUserPermissionIds') }}</span>									
								</div>
							</div>
							<div class="form-group">
								{!! Form::label('enabled', 'Enabled' , array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
								<div class="col-lg-8">
									{!! Form::checkbox('enabled', null, '' ,array('class' => 'minimal-red')) !!}
								</div>
							</div>
						</div>
					</div>
				</div>
					
				<div class="box-body">
					<div class="form-group">
						<div class="col-lg-8 col-lg-offset-2">
							{!! Form::submit('Save', array('class' => 'btn btn-primary')) !!}
							<a href="{{ route('management/admin-user-roles') }}" class="btn btn-default">Cancel</a>
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
        
		// Styles to file upload
    	$('input[type=file]').bootstrapFileInput();
    	$('.file-inputs').bootstrapFileInput();
    });

    
</script>
    {!! $validator !!}	
@stop