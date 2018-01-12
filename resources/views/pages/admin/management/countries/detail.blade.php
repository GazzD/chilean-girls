@extends('templates.admin.master.index') @section('title', 'Country')
@section('content')
<div class="row">
	<div class="col-md-12">
		<!-- Body -->
		<div class="nav-tabs-custom margin">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tab1" data-toggle="tab">General</a></li>
				@foreach($languages as $i => $language)
					<li id="parent_tab{{ $i+2 }}"><a href="#tab{{ $i+2 }}" data-toggle="tab"><img src="{{ asset('admin/images/flags/'.$language->isoCode.'.jpg') }}" class="responsive-img tab-flags">&nbsp;{{ $language->name }}</a></li>
				@endforeach
			</ul>
			{{ Form::model($country, array('class'=>'form-horizontal panel-body','id' => 'detail-countries-form')) }}
				<div class="tab-content">
					<div class="tab-pane active" id="tab1">
						<div class="box-body">
							<div class="form-group">
								{{ Form::label(null, 'ISO code', array('class'=>'col-lg-2 col-sm-2 control-label')) }} 
								<div class="col-lg-8">
									{{ Form::text('isoCode', null, array('class'=>'form-control', 'id' => 'isoCode', 'disabled')) }}
								</div> 
							</div>
							<div class="form-group">
								{{ Form::label(null, 'Priority', array('class'=>'col-lg-2 col-sm-2 control-label')) }} 
								<div class="col-lg-8">
									{{ Form::text('priority', null, array('class'=>'form-control', 'id' => 'priority', 'disabled')) }}
								</div>
							</div>
							<div class="form-group">
								{{ Form::label(null, 'Currency', array('class'=>'col-lg-2 col-sm-2 control-label')) }} 
								<div class="col-lg-8">
									{{ Form::text('currency', $country->currency->name, array('class'=>'form-control', 'id' => 'currency', 'disabled')) }}
								</div>
							</div>
							<div class="form-group">
								{{ Form::label(null, 'Enabled', array('class'=>'col-lg-2 col-sm-2 control-label')) }} 
								<div class="col-lg-8">		
									<div class="checkbox">						
										{{ Form::checkbox('enabled', '', null, array('class' => 'minimal-red', 'disabled' => true)) }}
									</div>
								</div>
							</div>
						</div>
					</div>
					@foreach($languages as $i => $language)
					<div class="tab-pane" id="tab{{ $i+2 }}">
							<div class="box-body">
								<div class="form-group">
									{{ Form::label(null, 'Name', array('class'=>'col-lg-2 col-sm-2 control-label')) }}
									<div class="col-lg-8">
										{{ Form::text('name', $country->{'name:'.$language->isoCode}, array('class'=>'form-control', 'id'=> 'name', 'disabled')) }}
									</div>
								</div>
							</div>
						</div>
					@endforeach
					
					<div class="box-body">
						<div class="form-group">
							<div class="col-lg-2 col-sm-2"></div>
							<div class="col-lg-8">
								@if(App\Auth::hasPermission('management/countries/edit'))
									<a  href="{{route('management/countries/edit', $country->id)}}" class="btn btn-primary">Edit</a>
								@endif
								<a class="btn btn-default" href="{{route('management/countries')}}">Back</a>					
							</div>
						</div>
					</div>
				</div>
			{{Form::close()}}
		</div>
	</div>
</div>
@stop 

@section('custom_script')
<script type="text/javascript">

    $(document).ready(function() {

		// Styles to checkbox
	    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
			checkboxClass: 'icheckbox_minimal-red',
			radioClass: 'iradio_minimal-red'
	    });	

    });

</script>
@stop

