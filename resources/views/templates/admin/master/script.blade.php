<!-- jQuery 2.2.0 -->
{!! Html::script('backend/plugins/jQuery/jQuery-2.2.0.min.js') !!}
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
	$.widget.bridge('uibutton', $.ui.button);
</script>

<!-- Bootstrap 3.3.6 -->
{!! Html::script('backend/bootstrap/js/bootstrap.min.js') !!}
{!! Html::script('backend/js/bootstrap.file-input.js') !!}

<!-- AdminLTE App -->
{!! Html::script('backend/dist/js/app.min.js') !!}

<!-- DataTables -->
{!! Html::script('backend/plugins/datatables/jquery.dataTables.min.js') !!}
{!! Html::script('backend/plugins/datatables/dataTables.bootstrap.min.js') !!}

<!-- Fancybox -->
{!! Html::script('backend/js/jquery.fancybox.js') !!}

<!-- Select2 -->
{!! Html::script('backend/plugins/select2/select2.full.min.js') !!}

<!-- iCheck 1.0.1 -->
{!! Html::script('backend/plugins/iCheck/icheck.min.js') !!}

<!-- Validator -->
{!! Html::script('vendor/jsvalidation/js/jsvalidation.js') !!}

<!-- Override -->
{!! Html::script('backend/js/override.js') !!}
