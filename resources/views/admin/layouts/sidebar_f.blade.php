<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background: linear-gradient(180deg, #1a3c6e 0%, #2a5298 100%);">
  <!-- Brand Logo -->
<a href="/admin/dashboard" class="brand-link text-center d-flex flex-column align-items-center justify-content-center py-3" 
   style="background: rgba(255,255,255,0.1); border-bottom: 1px solid rgba(255,255,255,0.1);">
    <div class="brand-image mb-2" style="width: 50px; height: 50px; background: white; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
        <i class="fas fa-heartbeat text-primary" style="font-size: 24px;"></i>
    </div>
    <div class="brand-text-content">
        <span class="brand-text font-weight-bold d-block" style="color: white; font-size: 18px; line-height: 1.2;">MediCare Pro</span>
        <small class="brand-subtext" style="color: #b3d9ff; font-size: 12px;">Healthcare System</small>
    </div>
</a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <div class="img-circle elevation-2 d-flex align-items-center justify-content-center" 
             style="width: 40px; height: 40px; background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%); color: white;">
          <i class="fas fa-user-md"></i>
        </div>
      </div>
      <div class="info">
        <small style="color: #b3d9ff;">{{ ucfirst(auth()->user()->role ?? 'User') }}</small>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Dashboard -->
        <li class="nav-item">
          <a href="/admin/dashboard" class="nav-link {{ Request::is('admin/dashboard*') ? 'active' : '' }}" 
             style="{{ Request::is('admin/dashboard*') ? 'background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>

        <!-- Diagnosa -->
        <li class="nav-item">
          <a href="/admin/diagnosa" class="nav-link {{ Request::is('admin/diagnosa*') ? 'active' : '' }}"
             style="{{ Request::is('admin/diagnosa*') ? 'background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);' : '' }}">
            <i class="nav-icon fas fa-stethoscope"></i>
            <p>Diagnosa</p>
          </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('chatbot.index') }}" class="nav-link {{ Request::is('konsultasi-diabetes*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-robot"></i>
                <p>Konsultasi AI</p>
            </a>
        </li>
        
        @if (auth()->user()->role == 'admin')
        <!-- Pasien -->
        <li class="nav-item">
          <a href="/admin/pasien" class="nav-link {{ Request::is('admin/pasien*') ? 'active' : '' }}"
             style="{{ Request::is('admin/pasien*') ? 'background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);' : '' }}">
            <i class="nav-icon fas fa-user-injured"></i>
            <p>Pasien</p>
          </a>
        </li>          

        <!-- Penyakit -->
        <li class="nav-item">
          <a href="/admin/penyakit" class="nav-link {{ Request::is('admin/penyakit*') ? 'active' : '' }}"
             style="{{ Request::is('admin/penyakit*') ? 'background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);' : '' }}">
            <i class="nav-icon fas fa-disease"></i>
            <p>Penyakit</p>
          </a>
        </li>

        <!-- Gejala -->
        <li class="nav-item">
          <a href="/admin/gejala" class="nav-link {{ Request::is('admin/gejala*') ? 'active' : '' }}"
             style="{{ Request::is('admin/gejala*') ? 'background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);' : '' }}">
            <i class="nav-icon fas fa-clipboard-list"></i>
            <p>Gejala</p>
          </a>
        </li>
        
        <!-- User -->
        <li class="nav-item">
          <a href="/admin/user" class="nav-link {{ Request::is('admin/user*') ? 'active' : '' }}"
             style="{{ Request::is('admin/user*') ? 'background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);' : '' }}">
            <i class="nav-icon fas fa-user-md"></i>
            <p>User</p>
          </a>
        </li>

        @endif

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>