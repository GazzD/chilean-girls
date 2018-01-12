@extends('templates.admin.master.index') 
@section('title', 'Customers') 
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
				@if(App\Auth::hasPermission('management/customers/add'))							
				<div class="margin text-right">
					<a class="btn btn-default" href="{{route('management/customers/add')}}" >Add new customer <i class="fa fa-plus"></i></a>
				</div>
				@endif
				<!-- Body -->
				<div class="box-body">
					<table id="customer-table" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>#</th>
								<th>First name</th>
								<th>Last name</th>
								<th>Email</th>
								<th>Phone</th>
								<th class="text-center">Status</th>
								@if(App\Auth::hasAnyPermissions('management/customers/detail,management/customers/edit,management/customers/delete')) 
									<th class="text-center btn-group-{{App\Auth::countPermissions('management/customers/detail,management/customers/edit,management/customers/delete,management/customers/addresses')}}">Actions</th>
								@endif
							</tr>
						</thead>
						<tbody>
							@foreach($customers as $customer)
							<tr>
								<td>{{$customer->id}}</td>
								<td>{{$customer->firstName}}</td>
								<td>{{$customer->lastName}}</td>
								<td>{{$customer->email}}</td>
								<td>{{$customer->phone}}</td>
								@if($customer->status == 'NEW')
										<td class="text-center"><span class="label label-primary label-mini">NEW</span></td>
									@elseif ($customer->status == 'ACTIVE')
										<td class="text-center"><span class="label label-success label-mini">ACTIVE</span></td>
									@elseif ($customer->status == 'DISABLED')
										<td class="text-center"><span class="label label-danger label-mini">DISABLED</span></td>
									@endif
								@if(App\Auth::hasAnyPermissions('management/customers/detail,management/customers/edit,management/customers/delete,management/customers/addresses'))									
								<td class="text-center">
									<div class="btn-group">
										@if(App\Auth::hasPermission('management/customers/detail'))							
											<a href="{{route('management/customers/detail', $customer->id)}}" class="btn btn-sm btn-success" title="View">
												<i class="fa fa-file"></i>
											</a>
										@endif
										@if(App\Auth::hasPermission('management/customers/edit'))							
											<a href="{{route('management/customers/edit', $customer->id)}}" class="btn btn-sm btn-info" title="Edit">
												<i class="fa fa-pencil"></i>
											</a>
										@endif
										@if(App\Auth::hasPermission('management/customers/addresses'))											
											<a  href="{{route('management/customers/addresses', $customer->id)}}" class="btn bg-gray btn-sm" title="Addresses">
												<i class="fa fa-map-marker"></i>
											</a>
										@endif	
										@if(App\Auth::hasPermission('management/customers'))							
											<button type="button" title="Delete" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal" data-whatever="{{$customer->id}}">
												<i class="fa fa-trash-o"></i>
											</button>										
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
		
	  	$("#customer-table").DataTable({
			"lengthMenu": [pageSizes, pageLabels],
			"iDisplayLength":pageDefault
	
		});
	});
	
    $(document).ready(function() {
        
		$('#deleteModal').on('show.bs.modal', function (event) {
			// Button that triggered the modal
			var button = $(event.relatedTarget) 
			
			// Get the carousel item id
			var customerId = button.data('whatever')
			
			// Open modal
			var modal = $(this)
			
			// Create URL
			var url = "{{ route('management/customers/delete','') }}/" + customerId;
	
			// Set message to modal body
			modal.find('.modal-body').text('Are you sure you want to delete the customer #' + customerId + '?')
			
			// Set URL to modal href
			$("#confirmDeleteLink").attr('href', url);
		})

    });
</script>
@stop
