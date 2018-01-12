<!DOCTYPE html>
<html lang="es">
<head>
	@include('templates.admin.master.head')
	<meta charset="UTF-8">
</head>
<body class="hold-transition login-page">
	
	@yield('content')
	
	<!-- SCRIPTS -->
	@include('templates.admin.master.script')
	@yield('custom_script')
</body>
</html>