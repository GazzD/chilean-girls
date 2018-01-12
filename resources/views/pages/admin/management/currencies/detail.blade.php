@extends('templates.admin.master.index') 
@section('title', 'Currency')
@section('content')
<div class="row">
	<div class="col-md-12">
		<!-- Body -->
		<div class="nav-tabs-custom margin">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tab1" data-toggle="tab">General</a></li>
				@foreach($languages as $i => $language)
					<li><a href="#tab{{ $i+2 }}" data-toggle="tab"><img src="{{asset('admin/images/flags/'.$language->isoCode.'.jpg')}}" class="responsive-img tab-flags">{{ $language->name }}</a></li>
				@endforeach
			</ul>
			{{ Form::model($currency, array('class'=>'form-horizontal panel-body','id' => 'detailCurrencyForm')) }}
				<div class="tab-content">
					<div class="tab-pane active" id="tab1">
						<div class="box-body">
							<div class="form-group">
								{{ Form::label(null, 'ISO code', array('class'=>'col-lg-2 col-sm-2 control-label')) }}
								<div class="col-lg-8">
									{{ Form::text('isoCode', null, array('class'=>'form-control', 'id'=> 'code', 'disabled')) }}
								</div>
							</div>
							<div class="form-group">
								{{ Form::label(null, 'Symbol', array('class'=>'col-lg-2 col-sm-2 control-label')) }} 
								<div class="col-lg-8">
								 	{{ Form::text('symbol', null, array('class'=>'form-control', 'id' => 'symbol', 'disabled')) }}
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
										{{ Form::text('name', $currency->{'name:'.$language->isoCode}, array('class'=>'form-control', 'disabled')) }}
									</div>									
								</div>
							</div>
						</div>
					@endforeach
				
					<div class="box-body">
						<div class="form-group">
							<div class="col-lg-8 col-lg-offset-2">
								@if(App\Auth::hasPermission('management/currencies/edit'))									
									<a href="{{route('management/currencies/edit', $currency->id)}}" class="btn btn-primary">Edit</a>
								@endif
								<a class="btn btn-default" href="{{route('management/currencies')}}">Back</a>					
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
