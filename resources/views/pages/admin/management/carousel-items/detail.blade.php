@extends('templates.admin.master.index') 
@section('title', 'Carousel item')
@section('content')
<div class="row">
	<div class="col-md-12">
		<!-- Body -->
		<div class="nav-tabs-custom margin">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tab1" data-toggle="tab">General</a></li>
			</ul>
			{!! Form::model($carouselItem, array('class'=>'form-horizontal panel-body','id' => 'detail-carousel-item-form')) !!}
				<div class="tab-content">
					<div class="tab-pane active" id="tab1">
						<div class="box-body">
							<div class="form-group">
								{!! Form::label(null, 'ID', array('class'=>'col-lg-2 col-sm-2 control-label')) !!} 
								<div class="col-lg-8">
									{!! Form::text('id', null, array('class'=>'form-control', 'id' => 'id', 'disabled')) !!}
								</div>
							</div>
							<div class="form-group">
								{!! Form::label(null, 'Nombre', array('class'=>'col-lg-2 col-sm-2 control-label')) !!} 
								<div class="col-lg-8">
									{!! Form::text('name', $carouselItem->name, array('class'=>'form-control', 'id' => 'name', 'disabled')) !!}
								</div>
							</div>
							<div class="form-group">
								{!! Form::label(null, 'Enlace', array('class'=>'col-lg-2 col-sm-2 control-label')) !!} 
								<div class="col-lg-8">
									{!! Form::text('link', $carouselItem->link, array('class'=>'form-control', 'id' => 'link', 'disabled')) !!}
								</div>
							</div>
							<div class="form-group">
								{!! Form::label(null, 'Target', array('class'=>'col-lg-2 col-sm-2 control-label')) !!}
								<div class="col-lg-8">
									{!! Form::text('target', $targetTypes[$carouselItem->target], array('class'=>'form-control', 'disabled'))!!}
								</div>
							</div>
							<div class="form-group">
								{!! Form::label(null, 'Imagen', array('class'=>'col-lg-2 col-sm-2 control-label')) !!} 
								<div class="col-lg-8">								
									<a id="single_image" href="{!!asset($carouselItem->image)!!}" title=""> <img class="col-xs-6 col-md-4 col-sm-4 col-lg-4 responsive-img product-img" src="{!!asset($carouselItem->image)!!}" alt="" style="border: 1px solid #ddd;"/> </a>
								</div>
							</div>
							<div class="form-group">
								{!! Form::label(null, 'Orden', array('class'=>'col-lg-2 col-sm-2 control-label')) !!} 
								<div class="col-lg-8">
									{!! Form::text('order', $carouselItem->order, array('class'=>'form-control', 'id' => 'link', 'disabled')) !!}
								</div>
							</div>
							<div class="form-group">
								{!! Form::label(null, 'Habilitado', array('class'=>'col-lg-2 col-sm-2 control-label')) !!} 
								<div class="col-lg-8">	
									<div class="checkbox">
									{!! Form::checkbox('enabled', '', null, array('class' => 'minimal-red','disabled' => true)) !!}
									</div>
								</div>
							</div>
						</div>
					</div>
				
					<div class="box-body">
						<div class="form-group">
							<div class="col-lg-2 col-sm-2"></div>
							<div class="col-lg-8">
								<a href="{!!route('management/carousel-items/edit', $carouselItem->id)!!}" class="btn btn-primary">Editar</a>
								<a class="btn btn-default" href="{!!route('management/carousel-items')!!}">Volver</a>					
							</div>
						</div>
					</div>
				</div>
			{!!Form::close()!!}
		</div>
	</div>
</div>
@stop
@section('custom_script')

	{!! Html::script('frontend/js/collapse/simple-expand.min.js') !!}


	{!! Html::script('frontend/js/jquery.magnific-popup.js') !!}
	
	
	
	<script type="text/javascript">
	
	    $(document).ready(function() {
	
			// Styles to checkbox
		    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
				checkboxClass: 'icheckbox_minimal-red',
				radioClass: 'iradio_minimal-red'
		    });

		    $('#single_image').on('click',function() {
			   $(this).attr('title','<a href="'+ '{!!asset($carouselItem->image)!!}" download> <i class="fa fa-download"></i> Descarga</a>' );
				$('#single_image').fancybox({
					helpers : {
				        title: {
				            type: 'inside'
				        }
				    },
				});
		    });
				
	    });
	
	    
	</script>
@stop