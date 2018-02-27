
<?php
  session_start();
   include("config.php");
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT userID FROM users WHERE username = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         header("location: welcome.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
require '../Auction_Website/includes/pagetop.php';
?>
<html lang="en-Us">
<head>

	<meta charset="utf-8">

	<link rel="stylesheet" href="style.css">
	<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans:400,300'>

	<!--[if lt IE 9]>
		<script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

</head>
<br>
<hr>
<body>

	<div id="login">

		<h1><strong>Welcome.</strong> Please login.</h1>

		<form action="javascript:void(0);" method="get">

			<fieldset>

				<p><input type="text" required value="Username" onBlur="if(this.value=='')this.value='Username'" onFocus="if(this.value=='Username')this.value='' " name="username"></p> <!-- JS because of IE support; better: placeholder="Username" -->

				<p><input type="password" required value="Password" onBlur="if(this.value=='')this.value='Password'" onFocus="if(this.value=='Password')this.value='' " name="password"></p> <!-- JS because of IE support; better: placeholder="Password" -->

		

				<p><input type="submit" value="Login"></p>

			</fieldset>

		</form>

		<p><span class="btn-round">or</span></p>

		<p>


			<button class="facebook">Sign Up</button>

		</p>

	</div> <!-- end login -->

</body>
<?php require '../Auction_Website/includes/footer.php'; ?>
</html>