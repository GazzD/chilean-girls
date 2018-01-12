@extends('templates.admin.master.index') 
@section('title', 'Modelos') 
@section('content')
<section class="content">
	@if (count($errors) > 0)
		<div class="col-xs-12">
			<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<b><i class="icon fa fa-ban"></i>Error! </b> {!! $errors->first('message') !!}
			</div>
		</div>
	@endif
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-danger">
				<!-- Header -->
				<div class="margin text-right">
					<a href="{!!route('management/models/add')!!}" class="btn btn-default">Agregar <i style="padding-left:5px;" class="fa fa-plus"></i></a>
				</div>
				<!-- Body -->
				<div class="box-body">
					<table id="girl-model-table" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>#</th>
								<th>Apodo</th>
								<th>Instagram</th>
								<th class="text-center">Habilitado</th>
								<th class="text-center">Acciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach($models as $i => $girlModel)
							<tr>
								<td>{!!$girlModel->id!!}</td>
								<td>{!!$girlModel->nickname!!}</td>
								<td>{!!$girlModel->instagram!!}</td>
								<td class="text-center">{!!Form::checkbox('enabled', '', $girlModel->enabled, ['class' => 'minimal-red', 'disabled' => true])!!}</td>
								<td class="text-center">
									<div class="btn-group">
										<a href="{!!route('management/models/detail', $girlModel->id)!!}" title="View" class="btn btn-sm btn-success">
											<i class="fa fa-file"></i>
										</a>
										<a href="{!!route('management/models/edit', $girlModel->id)!!}" title="Edit" class="btn btn-sm btn-info">
											<i class="fa fa-pencil"></i>
										</a>
										<button type="button" title="Delete" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal" data-whatever="{!!$girlModel->id!!}">
											<i class="fa fa-trash-o"></i>
										</button>
									</div>
								</td>
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
                <h4 class="modal-title">Eliminar</h4>
              </div>
              <div class="modal-body">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">No</button>
                <a href="" id="confirmDeleteLink" class="btn btn-danger"> Si</a>
              </div>
            </div>
		</div>
	</div>
</section>
@stop 
@section('custom_script')
<script type="text/javascript">

	$(function () {

		var pageSizes = [];
		var pageLabels = [];

		@foreach($pageSizes as $pageSize)
			pageSizes.push(parseInt({!! $pageSize !!}));
			pageLabels.push({!! $pageSize !!});
		@endforeach
		
	  	$("#girl-model-table").DataTable({
			"lengthMenu": [pageSizes, pageLabels]
		});
	});

	// Styles to checkbox
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
		checkboxClass: 'icheckbox_minimal-red',
		radioClass: 'iradio_minimal-red'
    });
	
    $(document).ready(function() {
        
		$('#deleteModal').on('show.bs.modal', function (event) {
			// Button that triggered the modal
			var button = $(event.relatedTarget) 
			
			// Get the carousel item id
			var girlModelId = button.data('whatever')
			
			// Open modal
			var modal = $(this)
			
			// Create URL
			var url = "{!! route('management/models/delete','') !!}/" + girlModelId;
	
			// Set message to modal body
			modal.find('.modal-body').text('¿Estás seguro que deseas eliminar a la modelo #' + girlModelId + '?')
			
			// Set URL to modal href
			$("#confirmDeleteLink").attr('href', url);
		})

    });	
</script>
@stop
