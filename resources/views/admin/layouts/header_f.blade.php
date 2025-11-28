<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light" style="background: linear-gradient(135deg, #1a7bb9 0%, #25a1c9 100%);">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="/admin/dashboard" role="button">
        <i class="fas fa-bars" style="color: white;"></i>
      </a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="/admin/dashboard" class="nav-link" style="color: white; font-weight: 500;">{{ isset($title) ? $title : '' }}</a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Notifications Dropdown Menu -->

    
    <!-- User Menu -->
<li class="nav-item">
  <a class="nav-link text-white" href="/logout" role="button" style="font-weight:500;">
    <i class="fas fa-sign-out-alt"></i>
    <span class="ml-1">Logout</span>
  </a>
</li>
  </ul>
</nav>
<!-- /.navbar -->