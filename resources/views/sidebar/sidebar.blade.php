<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
      <img src="{{ asset('dist/img/AdminLTELogo v1.png') }}" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Parkland Indonesia 2</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">General Apps</li>
                <li class="nav-item has-treeview">
                    <li class="nav-item">
                        <a href="{{url('/')}}" class="nav-link">
                            <i class="fa-solid fa-folder-tree"></i>
                                <p>
                                    Order Management
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{url('/dashboard')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{url('/formInput')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Input Material</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{url('/event/list_event')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Comming Soon!</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </li>
                <li class="nav-item has-treeview">
                    <li class="nav-item">
                        <a href="{{url('/')}}" class="nav-link">
                            <i class="fa-solid fa-arrows-to-circle"></i>
                                <p>
                                    Distribution Center
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{url('/dc/database')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Input Database</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{url('/dc/incoming')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Input Incoming</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{url('/dc/spk')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Input SPK</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{url('/dc/dashboard')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </li>
            </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
