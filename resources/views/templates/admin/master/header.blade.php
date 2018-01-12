<a href="{{ route('admin') }}" class="logo"> <!-- mini logo for sidebar mini 50x50 pixels -->
	<span class="logo-mini"><img alt="Chilean Girls" src="{{ asset('frontend/images/logo-alt.png') }}"></span> <!-- logo for regular state and mobile devices -->
	<span class="logo-lg"><img alt="Chilean Girls" src="{{ asset('frontend/images/logo.png') }}"></span>
</a>
<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top">
	<!-- Sidebar toggle button-->
	<a href="#" class="sidebar-toggle" data-toggle="offcanvas"
		role="button"> <span class="sr-only">Toggle navigation</span>
	</a>

	<div class="navbar-custom-menu">
		<ul class="nav navbar-nav">
			<!-- User Account: style can be found in dropdown.less -->
			<li class="dropdown user user-menu">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"> 
					<img src="{!! asset('backend/images/avatar.jpg') !!}" class="user-image" alt="User Image">
					<span class="hidden-xs">{{ Session::get('admin.auth.admin-user.firstName') }} {{ Session::get('admin.auth.admin-user.lastName') }}</span>
				</a>
				<ul class="dropdown-menu">
					<!-- User image -->
					<li class="user-header">
						<img src="{!! asset('backend/images/avatar.jpg') !!}" class="img-circle" alt="User Image">
						<p>
							{{ Session::get('admin.auth.admin-user.firstName') }} {{ Session::get('admin.auth.admin-user.lastName') }}<small>{{ Session::get('admin.auth.admin-user.email') }}</small>
						</p>
					</li>
					<!-- Menu Footer-->
					<li class="user-footer">
						<div class="pull-left">
							<a href="{{route('account')}}" class="btn btn-default btn-flat">Cuenta</a>
						</div>
						<div class="pull-right">
							<a href="{{ route('logout') }}" class="btn btn-default btn-flat">Cerrar sesi&oacute;n</a>
						</div>
					</li>
				</ul>
			</li>
		</ul>
	</div>
</nav>