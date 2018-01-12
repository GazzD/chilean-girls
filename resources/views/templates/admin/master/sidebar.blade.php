<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
    <ul class="sidebar-menu">
        <li class="header">MEN&Uacute; PRINCIPAL</li>
        <li>
            <a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
        </li>
        <li class="treeview">
            <a href="#"> <i class="fa fa-wrench"></i>
                <span>Administraci&oacute;n</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a href="{{ route('management/admin-users') }}">
                        <i class="fa fa-circle-o"></i>Administradores
                    </a>
                </li>
                <li>
                    <a href="{{ route('management/carousel-items') }}">
                        <i class="fa fa-circle-o"></i>Carrusel
                    </a>
                </li>
                <li>
                    <a href="{{ route('management/galleries') }}">
                        <i class="fa fa-circle-o"></i>Galer&iacute;as
                    </a>
                </li>
                <li>
                    <a href="{{ route('management/models') }}">
                        <i class="fa fa-circle-o"></i>Modelos
                    </a>
                </li>
                <li>
                    <a href="{{ route('management/videos') }}">
                        <i class="fa fa-circle-o"></i>Videos
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</section>
<!-- /.sidebar -->