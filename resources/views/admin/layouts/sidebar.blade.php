  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/index3.html" class="brand-link">
      <img src="/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">SP</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          {{-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/index.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v1</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/index2.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v2</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/index3.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v3</p>
                </a>
              </li>
            </ul>
          </li> --}}

          <li class="nav-item">
            <a href="/admin/diagnosa" class="nav-link {{ Request::is('admin/diagnosa*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-spinner"></i>
              <p>
                Diagnosa
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>
          
          @if (auth()->user()->role == 'admin')
            
          <li class="nav-item">
            <a href="/admin/pasien" class="nav-link {{ Request::is('admin/pasien*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Pasien
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>          

          <li class="nav-item">
            <a href="/admin/penyakit" class="nav-link {{ Request::is('admin/penyakit*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-calendar"></i>
              <p>
                Penyakit
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="/admin/gejala" class="nav-link {{ Request::is('admin/gejala*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Gejala
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="/admin/user" class="nav-link {{ Request::is('admin/user*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-user"></i>
              <p>
                User
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>

          @endif


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>