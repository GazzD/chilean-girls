@extends('templates.admin.master.index') 
@section('title', 'Contacts') 
@section('content')
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-danger">
				<!-- Header -->
				<!-- Body -->
				<div class="box-body">
					<table id="contact-table" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>#</th>
								<th>First name</th>
								<th>Last name</th>
								<th>Email</th>
								<th>Subject</th>
								<th>Date contact</th>
								
								@if(App\Auth::hasAnyPermissions('management/contacts/detail'))
									<th class="text-center btn-group-{{App\Auth::countPermissions('management/contacts/detail')}}">Actions</th>
								@endif
								
							</tr>
						</thead>
						<tbody>
							@foreach($contacts as $contact)
							<tr>
								<td>{{$contact->id}}</td>
								<td>{{$contact->firstName}}</td>
								<td>{{$contact->lastName}}</td>
								<td>{{$contact->email}}</td>
								<td>{{$contact->subject}}</td>
								<td>{{App\Helpers::adminFormatDate($contact->dateContact)}}</td>
								
								@if(App\Auth::hasAnyPermissions('management/contacts/detail'))
									<td class="text-center">
										<div class="btn-group">
											@if(App\Auth::hasPermission('management/contacts/detail'))
												<a href="{{route('management/contacts/detail', $contact->id)}}" class="btn btn-sm btn-success" title="View"> 
													<i class="fa fa-file"></i>
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
		
	  	$("#contact-table").DataTable({
            "iDisplayLength":pageDefault,
			"lengthMenu": [pageSizes, pageLabels]
		});
	});
</script>
@stop
