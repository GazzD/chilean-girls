@extends('templates.admin.master.index') 
@section('title', 'Currencies') 
@section('content')
<div class="row">
	<div class="col-md-12">
		<!-- Body -->
		<div class="nav-tabs-custom margin">
			<ul class="nav nav-tabs language-tabs">
				<li id="parent_tab1" class="active"><a href="#tab1" data-toggle="tab">General</a></li>
				@foreach($languages as $i => $language)
					<li id="parent_tab{{ $i+2 }}"><a href="#tab{{ $i+2 }}" data-toggle="tab"><img src="{{ asset('admin/images/flags/'.$language->isoCode.'.jpg') }}" class="responsive-img tab-flags">{{ $language->name }}</a></li>
				@endforeach
			</ul>
			{!! Form::model($currency, array('id' => 'editCurrencyForm', 'class' => 'panel-body form-horizontal')) !!}
				<div class="tab-content">
					<div class="tab-pane active" id="tab1">
						<div class="box-body">
							<div class="form-group">
								{{ Form::label('isoCode', 'ISO code', array('class'=>'col-lg-2 col-sm-2 control-label')) }} 
								<div class="col-lg-8">
									{{ Form::text('isoCode', null, array('class'=>'form-control', 'id' => 'isoCode', 'maxlength' => '3')) }}
								</div>
							</div>
							<div class="form-group">
								{!! Form::label('symbol', 'Symbol' , array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
								<div class="col-lg-8">
									{!! Form::text('symbol', null, array('class'=>'form-control', 'id' => 'symbol')) !!}
								</div>
							</div>
							<div class="form-group">
								{!! Form::label('enabled', 'Enabled' , array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
								<div class="col-lg-8">
									<div class="checkbox">
										{!! Form::checkbox('enabled', null, $currency->enabled ,array('class' => 'minimal-red')) !!}
									</div>
								</div>
							</div>
						</div>
					</div>
					@foreach($languages as $i => $language)
						<div class="tab-pane" id="tab{{ $i+2 }}">
							<div class="box-body">
								<div class="form-group">
									{!! Form::label('data['.$language->isoCode.'][name]', 'Name', array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
									<div class="col-lg-8">
										{!! Form::text('data['.$language->isoCode.'][name]', $currency->{'name:'.$language->isoCode}, array('id' => 'data['.$language->isoCode.'][name]', 'class' => 'form-control')) !!}
										<span class="help-block help-block-error right-light">{{ $errors->first('data.'.$language->isoCode.'.name') }}</span>									
									</div>
								</div>
							</div>
						</div>
					@endforeach
					<div class="box-body">
						<div class="form-group">
							<div class="col-lg-8 col-lg-offset-2">
								{!! Form::submit('Save', array('class' => 'btn btn-primary')) !!}
								<a href="{{ route('management/currencies') }}" class="btn btn-default">Cancel</a>
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
		// Styles to checkbox
	    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
			checkboxClass: 'icheckbox_minimal-red',
			radioClass: 'iradio_minimal-red'
	    });
        
    });
    
</script>
	{!! $validator !!}
@stop	