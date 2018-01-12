@extends('templates.admin.master.index') 
@section('title', 'Countries') 
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
				@if(App\Auth::hasPermission('management/countries/add'))
					<div class="margin text-right">
						<a href="{{route('management/countries/add')}}" class="btn btn-default">Add new country <i class="fa fa-plus"></i></a>
					</div>
				@endif
				<!-- Body -->
				<div class="box-body">
					<table id="country-table" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
								<th>ISO code</th>
								<th class="text-center">Enabled</th>
								@if(App\Auth::hasAnyPermissions('management/countries/detail,management/countries/edit,management/countries/delete'))
									<th class="text-center btn-group-{{App\Auth::countPermissions('management/countries/detail,management/countries/edit,management/countries/delete')}}"">Actions</th>
								@endif
							</tr>
						</thead>
						<tbody>
							@foreach($countries as $country)
							<tr>
								<td>{{$country->id}}</td>
								<td>{{$country->name}}</td>
								<td>{{$country->isoCode}}</td>
								<td class="text-center">{{Form::checkbox('enabled', '', $country->enabled, ['class' => 'minimal-red', 'disabled' => true])}}</td>
								@if(App\Auth::hasAnyPermissions('management/countries/detail,management/countries/edit,management/countries/delete'))
									<td class="text-center">
										<div class="btn-group">
											@if(App\Auth::hasPermission('management/countries/detail'))
												<a href="{{route('management/countries/detail', $country->id)}}" class="btn btn-sm btn-success" title="View">
													<i class="fa fa-file"></i>
												</a>
											@endif
											@if(App\Auth::hasPermission('management/countries/edit'))
												<a href="{{route('management/countries/edit', $country->id)}}" class="btn btn-sm btn-info" title="Edit">
													<i class="fa fa-pencil"></i>
												</a>
											@endif
											@if(App\Auth::hasPermission('management/countries/delete'))
												<a href="{{route('management/countries/delete', $country->id)}}" class="btn btn-sm btn-danger" title="Delete">
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
		
	  	$("#country-table").DataTable({
			"lengthMenu": [pageSizes, pageLabels],
	  		"iDisplayLength":pageDefault
		});
	});
	
	// Styles to checkbox
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
		checkboxClass: 'icheckbox_minimal-red',
		radioClass: 'iradio_minimal-red'
    });
</script>
@stop
