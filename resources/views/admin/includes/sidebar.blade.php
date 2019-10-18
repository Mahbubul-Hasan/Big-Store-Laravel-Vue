<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <router-link to="/admin/home" class="brand-link">
        <img src="/admin/img/AdminLTELogo.png"
             alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config("app.name") }}</span>
    </router-link>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="/admin/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview">
                    <router-link to="/admin/home" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Dashboard
                        </p>
                    </router-link>
                </li>

                <li class="nav-item has-treeview">
                    <router-link to="/admin/category" class="nav-link">
                        <i class="nav-icon fas fa-campground"></i>
                        <p>
                            Manage Category
                        </p>
                    </router-link>
                </li>

                <li class="nav-item has-treeview">
                    <router-link to="/admin/product" class="nav-link">
                        <i class="nav-icon fas fa-project-diagram"></i>
                        <p>
                            Manage Product
                        </p>
                    </router-link>
                </li>

                <li class="nav-item has-treeview">
                    <router-link to="/admin/order" class="nav-link">
                        <i class="nav-icon fas fa-border-style"></i>
                        <p>
                            Manage Order
                        </p>
                    </router-link>
                </li>

                <li class="nav-item has-treeview">
                    <a href="{{ route("logout") }}" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
