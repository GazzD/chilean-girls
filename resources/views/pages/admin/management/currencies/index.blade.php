@extends('templates.admin.master.index') 
@section('title', 'Currencies') 
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
				@if(App\Auth::hasPermission('management/currencies/add'))											
				<div class="margin text-right">
					<a href="{{route('management/currencies/add')}}" class="btn btn-default">Add new currency <i class="fa fa-plus"></i></a>
				</div>
				@endif
				<!-- Body -->
				<div class="box-body">
					<table id="currency-table" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
								<th>Symbol</th>
								<th class="text-center">Enabled</th>
								@if(App\Auth::hasAnyPermissions('management/currencies/detail,management/currencies/edit,management/currencies/delete'))											
								<th class="text-center btn-group-{{App\Auth::countPermissions('management/currencies/detail,management/currencies/edit,management/currencies/delete')}}">Actions</th>
								@endif
							</tr>
						</thead>
						<tbody>
							@foreach($currencies as $currency)
							<tr>
								<td>{{$currency->id}}</td>
								<td>{{$currency->name}}</td>
								<td>{{$currency->symbol}}</td>
								<td class="text-center">{{Form::checkbox('enabled', '', $currency->enabled, ['class' => 'minimal-red', 'disabled' => true])}}</td>
								@if(App\Auth::hasAnyPermissions('management/currencies/detail,management/currencies/edit,management/currencies/delete'))											
								<td class="text-center">
									<div class="btn-group">
										@if(App\Auth::hasPermission('management/currencies/detail'))									
										<a href="{{route('management/currencies/detail', $currency->id)}}" class="btn btn-sm btn-success" title="View">
											<i class="fa fa-file"></i>
										</a>
										@endif
										@if(App\Auth::hasPermission('management/currencies/edit'))									
										<a href="{{route('management/currencies/edit', $currency->id)}}" class="btn btn-sm btn-info" title="Edit">
											<i class="fa fa-pencil"></i>
										</a>
										@endif
										@if(App\Auth::hasPermission('management/currencies/delete'))											
										<button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal" data-whatever="{{$currency->id}}" title="Delete">
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

		$("#currency-table").DataTable({
			"iDisplayLength":pageDefault,
			"lengthMenu": [pageSizes, pageLabels]
		});
	});

	$('#deleteModal').on('show.bs.modal', function (event) {
		// Button that triggered the modal
		var button = $(event.relatedTarget) 
		
		// Get currency id
		var currencyId = button.data('whatever')
		
		// Open modal
		var modal = $(this)
		
		// Create URL
		var url = "{{ route('management/currencies/delete','') }}/" + currencyId;

		// Set message to modal body
		modal.find('.modal-body').text('Are you sure you want to delete the currency #' + currencyId + '?')
		
		// Set URL to modal href
		$("#confirmDeleteLink").attr('href', url);
	})
	
	// Styles to checkbox
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
		checkboxClass: 'icheckbox_minimal-red',
		radioClass: 'iradio_minimal-red'
    });
</script>
@stop
