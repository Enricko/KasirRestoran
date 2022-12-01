<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('sb-admin')}}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Restaurant WEI</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('sb-admin')}}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">     
          <li class="nav-item">
            <a href="/admin" class="nav-link {{ ($sidebar == 'dashboard' ? 'active' : '') }}">
              <i class="nav-icon far fa-image"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          @if (Auth::user()->level == 'admin' || Auth::user()->level == 'owner')
            <li class="nav-item">
              <a href="/admin/user" class="nav-link {{ ($sidebar == 'user' ? 'active' : '') }}">
                  <i class="nav-icon fas fa-user"></i>
                  <p>
                      User
                  </p>
              </a>
            </li>
          @endif
          <li class="nav-item">
            <a href="/admin/masakan" class="nav-link {{ ($sidebar == 'masakan' ? 'active' : '') }}">
                <i class="nav-icon fas fa-utensils"></i>
                <p>
                    Masakan
                </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/admin/meja" class="nav-link {{ ($sidebar == 'meja' ? 'active' : '') }}">
                <i class="nav-icon fas fa-table"></i>
                <p>
                    Meja
                </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>