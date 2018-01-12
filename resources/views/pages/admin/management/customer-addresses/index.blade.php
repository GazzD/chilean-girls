@extends('templates.admin.master.index') 
@section('title', 'Customer address') 
@section('content')
<!-- Main content -->
<section class="content">
	@if (count($errors) > 0)
		<div class="col-xs-12">
			<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<b><i class="icon fa fa-ban"></i>Error! </b> {{ $errors->first('message') }}
			</div>
		</div>
	@endif
	<div class="col-md-2 col-md-offset-10" style="margin-bottom: 10px;">
		<a href="{{route('management/customers/addresses/add', $customerId)}}" class="btn btn-default btn-block col-md-6">Add customer address <i class="fa fa-plus"></i></a>
	</div>
	
	<div class="row">
		<div class="col-xs-12">
			@if(count($customerAddresses) >0)
				@foreach($customerAddresses as $customerAddress)
					<div class="col-md-3">
						<div class="box box-danger">
							<div class="box-body box-profile">
								<h3 class=" ellipsis-center profile-username text-center">{{$customerAddress->name}}</h3>
			
								<p class="text-muted text-center">Entry #{{$customerAddress->id}}</p>
			
								<ul class="list-group list-group-unbordered">
									<li class="list-group-item"><b>Address line 1</b> <span class="ellipsis-right pull-right">{{$customerAddress->address_line_1}}</span>
									</li>
									<li class="list-group-item"><b>Address line 2</b> <span class="ellipsis-right pull-right">{{$customerAddress->address_line_2}}</span>
									</li>
									<li class="list-group-item"><b>City</b> <span class="ellipsis-right pull-right">{{$customerAddress->city}}</span>
									</li>
									<li class="list-group-item"><b>State</b> <span class="pull-right">{{$customerAddress->state->name}}</span>
									</li>
									<li class="list-group-item"><b>ZIP</b> <span class="pull-right">{{$customerAddress->zip}}</span>
									</li>
									<li class="list-group-item"><b>Country</b> <span class="pull-right">{{$customerAddress->country->name}}</span>
									</li>
									<li class="list-group-item"><b>Phone</b> <span class="pull-right">{{$customerAddress->phone}}</span>
									</li>
								</ul>
								<span class="col-lg-6"><a href="{{route('management/customers/addresses/edit', [$customerId, $customerAddress->id])}}" class="btn btn-primary btn-block col-md-6"><b>Edit</b></a></span>
								<span class="col-lg-6">
									<button type="button" class="btn btn-danger btn-block col-md-6" data-toggle="modal" data-target="#deleteModal" data-whatever="{{$customerAddress->id}}">
										<b>Delete</b>
									</button>
								</span>
							</div>
							<!-- /.box-body -->
						</div>
						<!-- /.box -->
					</div>
				@endforeach
			@else
				<div class="row">
					<div class="col-md-12">
						<div class="box box-danger">
							<div class="box-body box-profile">
								<div class="col-xs-12 alert text-center">
									There are not any address assigned to customer #{{$customerId}}
								</div>
							</div>
						</div>
					</div>
				</div>
			@endif
		</div>
	</div>
		
	<!-- Modal -->
	<div class="modal modal fade" id="deleteModal">
		<div class="modal-dialog">
			<div class="modal-content">
            	<div class="modal-header bg-red">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                  <span aria-hidden="true">&times;</span>
					</button>
                	<h4 class="modal-title">Delete</h4>
              	</div>
              	<div class="modal-body"></div>
              	<div class="modal-footer">
                	<button type="button" class="btn btn-default pull-left" data-dismiss="modal">No</button>
                	<a href="" id="confirmDeleteLink" class="btn btn-danger"> Yes</a>
              	</div>
			</div>
		</div>
	</div>
</section>
<!-- /.content -->
@stop
@section('custom_script')
<script type="text/javascript">

	$('#deleteModal').on('show.bs.modal', function (event) {
		// Button that triggered the modal
		var button = $(event.relatedTarget) 
		
		// Get the carousel item id
		var customerAddressesId = button.data('whatever')
		
		// Open modal
		var modal = $(this)
		
		// Create URL
		var url = "{{ Request::fullUrl() }}/delete/" + customerAddressesId;

		// Set message to modal body
		modal.find('.modal-body').text('Are you sure you want to delete the customer address #' + customerAddressesId + '?')
		
		// Set URL to modal href
		$("#confirmDeleteLink").attr('href', url);
	});
	
</script>
@stop