<!-- /.content-wrapper -->
<footer class="main-footer" style="background: linear-gradient(135deg, #1a7bb9 0%, #25a1c9 100%); color: white;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <strong>MediCare Pro</strong> - Healthcare Management System v2.0
      </div>
      <div class="col-md-6 text-right">
        <div class="d-inline-block mr-3">
          <i class="fas fa-shield-alt mr-1"></i> Secure
        </div>
        <div class="d-inline-block">
          <i class="far fa-copyright mr-1"></i> 2023 All rights reserved.
        </div>
      </div>
    </div>
  </div>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark" style="background: #1a3c6e;">
  <!-- Control sidebar content goes here -->
  <div class="p-3">
    <h5>Quick Stats</h5>
    <div class="mb-3">
      <small>Today's Appointments</small>
      <div class="progress" style="height: 8px;">
        <div class="progress-bar bg-info" style="width: 65%"></div>
      </div>
      <small>12 of 18 completed</small>
    </div>
    <div class="mb-3">
      <small>Patient Satisfaction</small>
      <div class="progress" style="height: 8px;">
        <div class="progress-bar bg-success" style="width: 85%"></div>
      </div>
      <small>94% positive feedback</small>
    </div>
    <div class="mb-3">
      <small>System Performance</small>
      <div class="progress" style="height: 8px;">
        <div class="progress-bar bg-warning" style="width: 92%"></div>
      </div>
      <small>Optimal performance</small>
    </div>
  </div>
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jquery-validation -->
<script src="/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="/plugins/jquery-validation/additional-methods.min.js"></script>
<!-- AdminLTE App -->
<script src="/dist/js/adminlte.min.js?v=3.2.0"></script>

<!-- Custom Healthcare Scripts -->
<script>
  $(document).ready(function() {
    // Add animation to sidebar items
    $('.nav-link').hover(
      function() {
        $(this).css('transform', 'translateX(5px)');
      },
      function() {
        $(this).css('transform', 'translateX(0)');
      }
    );
    
    // Add pulse animation to notifications
    setInterval(function() {
      $('.fa-bell').toggleClass('pulse');
    }, 2000);
  });
</script>

<!-- Custom Styles -->
<style>
  .pulse {
    animation: pulse 1s infinite;
  }
  
  @keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
  }
  
  .nav-link {
    transition: all 0.3s ease;
    border-radius: 8px;
    margin-bottom: 5px;
  }
  
  .brand-link {
    border-bottom: 1px solid rgba(255,255,255,0.1);
  }
  
  .main-footer {
    border-top: 1px solid rgba(255,255,255,0.1);
  }
</style>

</body>
</html>