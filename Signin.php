<?php
   include("configsignin.php");
   //session_start(); 
   

   $postCheck=true;
   $username=$password="";

   function validate_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
  }

   if($_SERVER["REQUEST_METHOD"] == "POST") {

   if(isset($_POST["submit"])){

	if (empty($_POST["username"])) {
		$usernameErr = "Please Enter Your Username"."<br>";
		$postCheck = false;
	  } else {
		$username = validate_input($_POST["username"]);
	  }

	  if (empty($_POST["password"])) {
		$passwordErr = "Please Enter Your Password"."<br>";
		$postCheck = false;
	  } else {
		$password1 = validate_input($_POST["password"]);
		$password = md5($password1);
	  }

	  if ($postCheck){
		 
		$getUserDetails=mysqli_query($db, "SELECT userID, Seller_or_Buyer, username FROM users WHERE username = '$username' and password = '$password'");
		//session_start();
		if (mysqli_num_rows($getUserDetails) > 0) {
			
			while($row = mysqli_fetch_assoc($getUserDetails)) {
    ob_start();
    session_start();
		$_SESSION['username']=$username;
		$_SESSION['userID']=$row['userID'];
		$_SESSION['Seller_or_Buyer']=$row['Seller_or_Buyer'];
    header('Location: roleSeperator.php');
   }
}else{
	echo "hello";
	echo "
	<div id='myModal' class='modal'>

    <!-- Modal content -->
    <div class='modal-content'>
      <div class='modal-header'>
        <span class='close'>&times;</span>
        <h2>Incorrect Login details</h2>
      </div>
      <div class='modal-body'>
        <p>
        Please Re-enter your login details!
        </p>
      </div>
      
    </div>
  
  </div>";
}
}
}     
}
   /*
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
   }*/
include 'includes/pagetopsignin.php';
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

		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

			<fieldset>

				<p><input type="text" required value="Username" onBlur="if(this.value=='')this.value='Username'" onFocus="if(this.value=='Username')this.value='' " name="username" id="username"></p> <!-- JS because of IE support; better: placeholder="Username" -->

				<p><input type="password" required value="Password" onBlur="if(this.value=='')this.value='Password'" onFocus="if(this.value=='Password')this.value='' " name="password" id="password"></p> <!-- JS because of IE support; better: placeholder="Password" -->

		

				<p><input type="submit" name="submit" id="submit" class="button" value="Login" ></p>

			</fieldset>

		</form>

		<p><span class="btn-round">or</span></p>

		<p>


			<a href="Signup.php" ><button class="facebook">Sign Up</button></a>

		</p>

	</div> <!-- end login -->

</body>
<?php include '../Auction_Website/includes/footer.php'; ?>
</html>
<script>
  window.onload = function(){
  // Get the modal
  var modal = document.getElementById('myModal');

  // Get the button that opens the modal
  var btn = document.getElementById('submit');

  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName('close')[0];
  modal.style.display = 'block';
  // When the user clicks the button, open the modal
  // btn.onclick = function() {
  //     modal.style.display = 'block';
  // }

  // When the user clicks on <span> (x), close the modal
  span.onclick = function() {
      modal.style.display = 'none';
  }

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
      if (event.target == modal) {
          modal.style.display = 'none';
      }
  }
}
  </script>