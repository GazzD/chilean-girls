@extends('templates.admin.master.index') 
@section('title', 'Countries') 
@section('content')
<div class="row">
	<div class="col-md-12">
		<!-- Body -->
		<div class="nav-tabs-custom margin">
			<ul class="nav nav-tabs language-tabs">
				<li id="parent_tab1" class="active"><a href="#tab1" data-toggle="tab">General</a></li>
				@foreach($languages as $i => $language)
					<li id="parent_tab{{ $i+2 }}"><a href="#tab{{ $i+2 }}" data-toggle="tab"><img src="{{ asset('admin/images/flags/'.$language->isoCode.'.jpg') }}" class="responsive-img tab-flags">&nbsp;{{ $language->name }}</a></li>
				@endforeach
			</ul>
			{!! Form::model($country, array('files' => true, 'id' => 'addCountryForm', 'class' => 'panel-body form-horizontal')) !!}
				<div class="tab-content">
					<div class="tab-pane active" id="tab1">
						<div class="box-body">
							<div class="form-group">
								{!! Form::label('isoCode', 'ISO code', array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
								<div class="col-lg-8">
									{!! Form::text('isoCode', null, array('class' => 'form-control', 'id' => 'isoCode', 'maxlength' => '2')) !!}
									<span class="help-block help-block-error right-light">{{ $errors->first('isoCode') }}</span>
								</div>
							</div>
							<div class="form-group">
								{!! Form::label('priority', 'Priority', array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
								<div class="col-lg-8">
									{!! Form::number('priority', null, array('class' => 'form-control', 'id' => 'priority', 'min'=>'1')) !!}
									<span class="help-block help-block-error right-light">{{ $errors->first('priority') }}</span>
								</div>
							</div>
							<div class="form-group">
								{!! Form::label('currencyId', 'Currency', array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
								<div class="col-lg-8">
									<div>
										{!! Form::select('currencyId', $currencies, null, array('class' => 'form-control select2', 'placeholder' => 'Select one option', 'style' => 'width:100% !important;')) !!}
									</div>	
									<span class="right-light">{{ $errors->first('currencyId') }}</span>
								</div>
							</div>
							<div class="form-group">
								{!! Form::label('enabled', 'Enabled' , array('class' => 'col-lg-2 col-sm-2 control-label')) !!}
								<div class="col-lg-8">
									<div class="checkbox">
										{!! Form::checkbox('enabled', null, '' ,array('class' => 'minimal-red')) !!}
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
										{!! Form::text('data['.$language->isoCode.'][name]', '', array('id' => 'data['.$language->isoCode.'][name]', 'class' => 'form-control')) !!}
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
								<a href="{{ route('management/countries') }}" class="btn btn-default">Cancel</a>
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
			
		});
		
		// Styles to checkbox
	    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
			checkboxClass: 'icheckbox_minimal-red',
			radioClass: 'iradio_minimal-red'
	    });

	    $("#priority").keypress(function() {
	    	if(parseInt($(this).val())==0)
	    		$(this).val('');
	    });

	    $("#priority").keydown(function (e) {
		    if (e.keyCode == 8 || e.keyCode ==9 ||(e.keyCode == 65 && e.ctrlKey === true) || (e.keyCode == 67 && e.ctrlKey === true) || (e.keyCode == 88 && e.ctrlKey === true) || (e.keyCode >= 35 && e.keyCode <= 40)) {
				return;
			}
	        if ( (e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105) || ($(this).val().length == 0 && e.keyCode == 96) ) {
	            e.preventDefault();
	        }
	    });

	    $("#priority").keyup(function() {
	    	if($(this).val().length == 1 && parseInt($(this).val())==0)
	    		$(this).val('');
	    });

	});

    
</script>
    {!! $validator !!}	
@stop