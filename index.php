<?php

  session_start(); /* Starts the session */

  if($_SESSION['Active'] == false){ /* Redirects user to Login.php if not logged in */
    header("location:login.php");
	  exit;
  }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Risk Application</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
  <!-- validator -->
  <link rel="stylesheet" href="plugins/bootstrapvalidator/src/css/bootstrapValidator.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
	  <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class='fas fa-user'></i> <?php echo $_SESSION['nama']; ?>
        </a>
      </li>
		
      <!-- Messages Dropdown Menu -->
      
      <!-- Notifications Dropdown Menu -->
	  <li class="nav-item">
        <a class="nav-link" href="logout.php" title='Logout'>
          <i class="fas fa-sign-out-alt"></i>
        </a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" title='Costumize' data-slide="true" href="#">
          <i class="fas fa-cogs"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img img src="dist/img/ma.png" height="30px" width="50px"
           style="opacity:8">
      <span class="brand-text">Risk Application</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
			  <li class="nav-header">Menu</li>
			  <li class="nav-item">
				<a href="index.php" class="nav-link">
				  <i class="fa fa-home nav-icon"></i>
				  <p>Home</p>
				</a>
			  </li>
			  <?php
				$jbt = $_SESSION['jabatan'];
				if($jbt == "J06"){
					$menu = "
							<li class='nav-item'>
								<a href='index.php?page=user&hal=1' class='nav-link'>
								  <i class='fa fa-users nav-icon'></i>
								  <p>User</p>
								</a>
						    </li>
							<li class='nav-item'>
								<a href='index.php?page=departement' class='nav-link'>
								  <i class='fas fa-building nav-icon'></i>
								  <p>Departement</p>
								</a>
						    </li>
							<li class='nav-item'>
								<a href='index.php?page=probability' class='nav-link'>
								  <i class='fas fa-clipboard nav-icon'></i>
								  <p>Probability</p>
								</a>
						    </li>
							<li class='nav-item'>
								<a href='index.php?page=dampak' class='nav-link'>
								  <i class='fas fa-book-dead nav-icon'></i>
								  <p>Dampak</p>
								</a>
						    </li>
							<li class='nav-item'>
								<a href='index.php?page=btr' class='nav-link'>
								  <i class='fas fa-hand-holding-usd nav-icon'></i>
								  <p>BTR</p>
								</a>
						    </li>
							<li class='nav-item'>
								<a href='index.php?page=kategori' class='nav-link'>
								  <i class='fas fa-list nav-icon'></i>
								  <p>Kategori Resiko</p>
								</a>
						    </li>
							<li class='nav-item'>
								<a href='index.php?page=strategi' class='nav-link'>
								  <i class='fas fa-binoculars nav-icon'></i>
								  <p>Strategi</p>
								</a>
						    </li>
							";
				}else{
					$menu = "
							<li class='nav-item'>
								<a href='index.php?page=registrasi' class='nav-link'>
								  <i class='fa fa-book nav-icon'></i>
								  <p>Risk Register</p>
								</a>
						    </li>
							<li class='nav-item'>
								<a href='#' class='nav-link'>
								  <i class='fas fa-fingerprint nav-icon'></i>
								  <p>Identifikasi</p>
								</a>
						    </li>
							<li class='nav-item'>
								<a href='#' class='nav-link'>
								  <i class='fas fa-search nav-icon'></i>
								  <p>Analysis</p>
								</a>
						    </li>
							<li class='nav-item'>
								<a href='#' class='nav-link'>
								  <i class='fas fa-praying-hands nav-icon'></i>
								  <p>Mitigasi</p>
								</a>
						    </li>
							<li class='nav-item'>
								<a href='#' class='nav-link'>
								  <i class='fas fa-search-dollar nav-icon'></i>
								  <p>Cost Treatment</p>
								</a>
						    </li>
							";
				}
				
				echo $menu;
			  ?>
			  <!--<li class="nav-item">
				<a href="index.php?page=user" class="nav-link">
				  <i class="fa fa-users nav-icon"></i>
				  <p>User</p>
				</a>
			  </li>
			  <li class="nav-item">
				<a href="index.php?page=activity" class="nav-link">
				  <i class="fa fa-book nav-icon"></i>
				  <p>Risk Input</p>
				</a>
			  </li>
			  <li class="nav-item has-treeview menu-close">
				<a href="#" class="nav-link">
				  <i class="nav-icon fas fa-file"></i>
				  <p>
					Form IT
					<i class="right fas fa-angle-left"></i>
				  </p>
				</a>
				<ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?page=pengecekan" class="nav-link">
                  <i class="fas fa-microchip nav-icon"></i>
                  <p>Maintenance</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?page=permintaan" class="nav-link">
                  <i class="fa fa-handshake nav-icon"></i>
                  <p>Permintaan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?page=activity" class="nav-link">
                  <i class="fas fa-unlink nav-icon"></i>
                  <p>Pergantian</p>
                </a>
              </li>
            </ul>
			  </li>-->
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  
	<!-- Content -->
		<?php include "conf/page.php"; ?>
	<!-- /Content -->
  
  <footer class="main-footer">
    <strong>Copyright &copy; 2019 <a href="#">IT MA</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- Validator -->
<script src="plugins/bootstrapvalidator/src/js/bootstrapValidator.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!--<script src="dist/js/pages/dashboard.js"></script>-->
<!-- AdminLTE for demo purposes-->
<script src="dist/js/demo.js"></script> 
</body>
</html>
