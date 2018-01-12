@extends('templates.admin.master.index') 
@section('title', 'Carousel items') 
@section('content')
<div class="row">
	<div class="col-md-12">
		<!-- Body -->
		<div class="nav-tabs-custom margin">
			<ul class="nav nav-tabs language-tabs">
				<li id="parent_tab1" class="active"><a href="#tab1" data-toggle="tab">General</a></li>
				<li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
			</ul>
			{!! Form::model($carouselItem, array('files' => true, 'id' => 'editCarouselItemForm', 'class' => 'panel-body form-horizontal')) !!}
				<div class="tab-content">
					<div class="tab-pane active" id="tab1">
						<div class="box-body">
							<div class="form-group">
								{!! Form::label('name', 'Nombre', array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
								<div class="col-lg-8">
									{!! Form::text('name', $carouselItem->name, array('id' => 'name', 'class' => 'form-control')) !!}
									<span class="help-block help-block-error right-light">{!! $errors->first('name') !!}</span>									
								</div>
							</div>
							<div class="form-group">
								{!! Form::label('link', 'Enlace', array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
								<div class="col-lg-8">
									{!! Form::text('link', $carouselItem->link, array('id' => 'link', 'class' => 'form-control')) !!}
									<span class="help-block help-block-error right-light">{!! $errors->first('link') !!}</span>									
								</div>
							</div>
							<div class="form-group">
								{!! Form::label('target', 'Target', array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
								<div class="col-lg-8">
									<div>
										{!! Form::select('target', $targetTypes, $carouselItem->target,array('class' => 'form-control select2', 'placeholder' => 'Selecciona una opci&oacute;n', 'style' => 'width:100% !important;')) !!}
									</div>
									<span class="right-light">{!! $errors->first('target') !!}</span>
								</div>
							</div>
							<div class="form-group">
							{!! Form::label('image', 'Imagen', array('class' => 'col-lg-2 control-label')) !!}
								<div class="col-lg-8">								
									<img class="col-xs-6 col-md-4 col-sm-4 col-lg-4 responsive-img" src="{!!asset($carouselItem->image)!!}" style="border: 1px solid #ddd;"/>
								</div>
							</div>
							<div class="form-group" class="file-height">
								<span class="has-error">{!! $errors->first('image]') !!}</span>
								<div class="fileinput fileinput-new" data-provides="fileinput">
								    {!! Form::label('image', 'Cambiar imagen', array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
								    <div class="col-lg-8">
							    		{!! Form::file('image', array('id' => 'image', 'class' => 'file-upload', 'title' => 'Browse')) !!}
										<span class="right-light">{!! $errors->first('image') !!}</span>		
							    	</div>
								</div>
							</div>
							<div class="form-group">
                                {!! Form::label('order', 'Orden', array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
                                <div class="col-lg-8">
                                    <div>
                                        {!! Form::select('order', $orderOptions, null ,array('class' => 'form-control select2', 'placeholder' => 'Selecciona una opci&oacute;n', 'style' => 'width:100% !important;')) !!}
                                    </div>
                                    <span class="right-light">{!! $errors->first('order') !!}</span>
                                </div>
                            </div>
							<div class="form-group">
								{!! Form::label('enabled', 'Habilitado' , array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
								<div class="col-lg-8">
									<div class="checkbox">
										{!! Form::checkbox('enabled', null, $carouselItem->enabled ,array('class' => 'minimal-red')) !!}
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="box-body">
						<div class="form-group">
							<div class="col-lg-8 col-lg-offset-2">
								{!! Form::submit('Guardar', array('class' => 'btn btn-primary')) !!}
								<a href="{!! route('management/carousel-items') !!}" class="btn btn-default">Cancelar</a>
							</div>
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
		$(".select2").select2({
			minimumResultsForSearch: Infinity
		});
    	
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