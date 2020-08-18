<?php
  session_start(); /* Starts the session */
  session_unset();
  session_destroy(); /* Destroy started session */

	/* if(isset($_COOKIE['cookielogin']))      
	{
		$time = time();
		setcookie("cookielogin[user]", $time - 3600);
		setcookie("cookielogin[pass]", $time - 3600);
	} */

  header("location:login.php");  /* Redirect to login page */
  exit;
