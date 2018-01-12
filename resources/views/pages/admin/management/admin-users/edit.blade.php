@extends('templates.admin.master.index') 
@section('title', 'Admin users') 
@section('content')
<div class="row">
		<div class="col-md-12">
			<!-- Body -->
			<div class="nav-tabs-custom margin">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#tab1" data-toggle="tab">General</a></li>
				</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="tab1">
							{!! Form::model($adminUser, array('files' => true, 'id' => 'editAdminUserForm', 'class' => 'panel-body form-horizontal')) !!}
							<div class="box-body">
								<div class="form-group">
									{!! Form::label('firstName', 'Nombre', array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
									<div class="col-lg-8">
										{!! Form::text('firstName', $adminUser->firstName, array('class' => 'form-control')) !!}
										<span class="help-block help-block-error right-light">{!! $errors->first('firstName') !!}</span>
									</div>
								</div>
								<div class="form-group">
									{!! Form::label('lastName', 'Apellido', array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
									<div class="col-lg-8">
										{!! Form::text('lastName', $adminUser->lastName, array('class' => 'form-control')) !!}
										<span class="help-block help-block-error right-light">{!! $errors->first('lastName') !!}</span>
									</div>
								</div>
								<div class="form-group">
									{!! Form::label('email', 'Correo electr&oacute;nico', array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
									<div class="col-lg-8">
										{!! Form::text('email', $adminUser->email, array('class' => 'form-control')) !!}
										<span class="help-block help-block-error right-light">{!! $errors->first('email') !!}</span>
									</div>
								</div>
								<div class="form-group">
									{!! Form::label('phone', 'Tel&eacute;fono', array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
									<div class="col-lg-8">
										{!! Form::text('phone', $adminUser->phone, array('class' => 'form-control')) !!}
										<span class="help-block help-block-error right-light">{!! $errors->first('phone') !!}</span>
									</div>
								</div>
								<div class="form-group">
									{!! Form::label('adminUserRoleId', 'Rol', array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
									<div class="col-lg-8">
										<div>
											{!! Form::select('adminUserRoleId', $adminUserRoles, $adminUser->adminUserRole->id, array('class' => 'form-control select2')) !!}
										</div>
										<span class="help-block help-block-error right-light">{!! $errors->first('adminUserRoleId') !!}</span>
									</div>
								</div>
								<div class="form-group">
									{!! Form::label('enabled', 'Habilitado' , array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
									<div class="col-lg-8">
										<div class="checkbox">
											{!! Form::checkbox('enabled', null, $adminUser->enabled, array('class' => 'minimal-red')) !!}
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="box-body">
							<div class="form-group">
								<div class="col-lg-8 col-lg-offset-2">
									{!! Form::submit('Guardar', array('class' => 'btn btn-primary')) !!}
									<a href="{{ route('management/admin-users/change-password', $adminUser->id) }}" class="btn btn-primary">Cambiar contraseña</a>
									<a href="{{ route('management/admin-users') }}" class="btn btn-default">Cancelar</a>
								</div>
							</div>
						</div>
				{!! Form::close() !!}
			</div>
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
    {!! $editValidator !!}	
@stop