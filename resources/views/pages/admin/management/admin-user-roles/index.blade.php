@extends('templates.admin.master.index') 
@section('title', 'Admin user roles') 
@section('content')
<section class="content">
	@if (count($errors) > 0)
		<div class="col-xs-12">
			<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<b><i class="icon fa fa-ban"></i>Error! </b> {{ $errors->first('message') }}
			</div>
		</div>
	@endif
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-danger">
				<!-- Header -->
				@if(App\Auth::hasPermission('management/admin-user-roles/add'))
					<div class="margin text-right">
						<a class="btn btn-default" href="{{route('management/admin-user-roles/add')}}" >Add new admin user role <i class="fa fa-plus"></i></a>
					</div>
				@endif
				<!-- Body -->
				<div class="box-body">
					<table id="admin-user-role-table" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
								<th class="text-center">Enabled</th>
								@if(App\Auth::hasAnyPermissions('management/admin-user-roles/detail,management/admin-user-roles/edit,management/admin-user-roles/delete'))
									<th class="text-center btn-group-{{App\Auth::countPermissions('management/admin-user-roles/detail,management/admin-user-roles/edit,management/admin-user-roles/delete')}}">Actions</th>
								@endif
							</tr>
						</thead>
						<tbody>
							@foreach($adminUserRoles as $adminUserRole)
							<tr>
								<td>{{$adminUserRole->id}}</td>
								<td>{{$adminUserRole->name}}</td>
								<td class="text-center">{{Form::checkbox('enabled', '', $adminUserRole->enabled, ['class' => 'minimal-red', 'disabled' => true])}}</td>
								<td class="text-center">
								@if(App\Auth::hasAnyPermissions('management/admin-user-roles/detail,management/admin-user-roles/edit,management/admin-user-roles/delete'))
									<div class="btn-group">
										@if(App\Auth::hasPermission('management/admin-user-roles/detail'))
											<a href="{{route('management/admin-user-roles/detail', $adminUserRole->id)}}" class="btn btn-sm btn-success" title="View">
												<i class="fa fa-file"></i>
											</a>
										@endif
										@if(App\Auth::hasPermission('management/admin-user-roles/edit'))
											<a href="{{route('management/admin-user-roles/edit', $adminUserRole->id)}}" class="btn btn-sm btn-info" title="Edit">
												<i class="fa fa-pencil"></i>
											</a>
										@endif
										@if(App\Auth::hasPermission('management/admin-user-roles/delete'))
											<a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal" data-whatever="{{$adminUserRole->id}}" title="Delete">
												<i class="fa fa-trash-o"></i>
											</a>
										@endif
									</div>
								</td>
								@endif
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	
	<!-- Modal -->
	<div class="modal modal fade" id="deleteModal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header bg-red">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Delete</h4>
              </div>
              <div class="modal-body">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">No</button>
                <a href="" id="confirmDeleteLink" class="btn btn-danger"> Yes</a>
              </div>
            </div>
		</div>
	</div>
</section>
@stop 
@section('custom_script')
<script type="text/javascript">
	$(function () {
		var pageDefault = {{ $pageDefault }};
		var pageSizes = [];
		var pageLabels = [];

		@foreach($pageSizes as $pageSize)
			pageSizes.push(parseInt({{ $pageSize }}));
			pageLabels.push({{ $pageSize }});
		@endforeach
		
	  	$("#admin-user-role-table").DataTable({
			"lengthMenu": [pageSizes, pageLabels],
			"iDisplayLength":pageDefault
		});
	});

	// Styles to checkbox
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
		checkboxClass: 'icheckbox_minimal-red',
		radioClass: 'iradio_minimal-red'
    });
	
	$('#deleteModal').on('show.bs.modal', function (event) {
		// Button that triggered the modal
		var button = $(event.relatedTarget) 
		
		// Get admin user role id
		var adminUserRoleId = button.data('whatever')
		
		// Open modal
		var modal = $(this)
		
		// Create URL
		var url = "{{ route('management/admin-user-roles/delete','') }}/" + adminUserRoleId;

		// Set message to modal body
		modal.find('.modal-body').text('Are you sure you want to delete admin user role #' + adminUserRoleId + '?')
		
		// Set URL to modal href
		$("#confirmDeleteLink").attr('href', url);
	})
	
</script>
@stop
