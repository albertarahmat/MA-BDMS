<?php
require_once ('config.php'); // For storing username and password.

session_start();

	/* Check if login form has been submitted */
	if(isset($_POST['Submit'])){
		
		//get post
		$user = $_POST['username'];         
		$pass = $_POST['password'];

		// Rudimentary hash check
		//$result = password_verify($_POST['Password'], $Password);
		$qr= $conn->query("select * from user");
		while($sql = $qr->fetch_array()){
		
			$user_login = $sql['username'];
			$user_nip = $sql['nip'];
			$password = $sql['password'];
			$nama_lengkap = $sql['nama_lengkap'];
			$jabatan = $sql['jabatan'];
			$departement = $sql['departemen'];
			$email = $sql['email'];
		
			/* Check if form's username and password matches */
			if( ($user == $user_login &&  $pass == $password) ) {

				/* Success: Set session variables and redirect to protected page */
				$_SESSION['nip'] = $user_nip;
				$_SESSION['username'] = $user_login;
				$_SESSION['nama'] = $nama_lengkap;
				$_SESSION['jabatan'] = $jabatan;
				$_SESSION['departemen'] = $departement;
				$_SESSION['email'] = $email;

				$_SESSION['Active'] = true;
				if(!empty($_POST["remember"])) {
					setcookie ("user_login",$_POST["username"],time()+ (10 * 365 * 24 * 60 * 60));
					setcookie ("userpassword",$_POST["password"],time()+ (10 * 365 * 24 * 60 * 60));
				} 
				
				header("location:index.php");
				exit; 

			} else {
				?>
				<!-- Show an error alert -->
				<script type="text/javascript">
					alert("Wrong Username or Password");
					location="login.php";
				</script>
				<?php
			}
		}
	}

?>

<!-- HTML code for Bootstrap framework and form design -->

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>IT Mitrabara</title>
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
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
	<div class="login-logo">
    <a href=""><img src="dist/img/ma.png" height="80px" width="150px"></a>
  </div>
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>
		<form action="" method="post">
        <div class="input-group mb-3">
          <input name="username" type="username" id="inputUsername" class="form-control" value="<?php if(isset($_COOKIE["user_login"])) { echo $_COOKIE["user_login"]; } ?>" placeholder="Username" required autofocus>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input name="password" type="password" id="inputPassword" class="form-control" value="<?php if(isset($_COOKIE["userpassword"])) { echo $_COOKIE["userpassword"]; } ?>" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember" value="true" name="remember" <?php if(isset($_COOKIE["user_login"])) { ?> checked <?php } ?>>
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button name="Submit" type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
			

		</form>
	</div>
	</div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="plugins/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
