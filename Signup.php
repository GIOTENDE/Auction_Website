
<?php 
include("config.php");



$_SESSION['message'] = '';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	if(isset($_POST["submit"])){
	// two passwords are matching
	if($_POST['password'] == $_POST['confirmpassword']){
		$username = ($_POST['username']);
		$email_address = ($_POST['email_address']);
		$password = md5($_POST['password']);// md5 hash passord security
		$fullname = ($_POST['fullname']);
		$mobilenumber = ($_POST['mobilenumber']);
		$address = ($_POST['address']);
		$Seller_or_Buyer= ($_POST['Seller_or_Buyer']);
		$sql = "INSERT INTO users (username, email_address, password, fullname, mobilenumber, address, Seller_or_Buyer)"."VALUES ('$username','$email_address','$password','$fullname','$mobilenumber','$address','$Seller_or_Buyer')";
		//if query is successful, redirect to signup.php page, done!
		
		mysqli_query($db,$sql);
		include 'SignupEmail.php';
		echo 'COMPLETED';
		/*if ($mysqli->query($sql)=== true){
			$_SESSION['message'] = 'Registration successful! Added $username to the database';
		}
		else{
			$_SESSION['message'] = "User could not be added to the database!";
		}*/
	}
	else{
		$_SESSION['message'] = "Two Passwords to not match";
	} 
	}else{echo "submit not working";}
}

include '/includes/pagetop.php'; 
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

<body>

	<div id="login">

    <h1><strong><br>Create a new account:</strong></h1>

		<form class="form" action="Signup.php" method="post" enctype="miltipart/form-data" autocomplete="off">
		<!-- <div class="alert alert-error"><?= $_SESSION['message'] ?></div> -->

			<fieldset>
			<h1>Insert Full Name: </h1>
<p><input type="text" placeholder="John Doe" name= "fullname" required></p>
            <h1>Insert Username: </h1>
				<p><input type="text" placeholder="Username" name="username"></p> <!-- JS because of IE support; better: placeholder="Username" -->
<h1><strong>Create Password:</h1>
				<p><input type="password" required value="Password" name="password" onBlur="if(this.value=='')this.value='Password'" onFocus="if(this.value=='Password')this.value='' " required></p>

  <h1><strong>Repeat Password:</h1>
				<p><input type="password" required value="Password"  name = "confirmpassword" onBlur="if(this.value=='')this.value='Password'" onFocus="if(this.value=='Password')this.value='' " required></p>
      
<!-- JS because of IE support; better: placeholder="Password" -->
  
<h1>Insert Email Adress: </h1>
<p><input type="text" placeholder="Email" name= "email_address" required></p>
<h1>Phone Number:</h1>			
<p><input type="text" placeholder="Phone Number" name="mobilenumber" required></p>
 <h1>Postal Adress:</h1>
<p><input type="text" placeholder="Postal Adress" name="address" required></p>
			</fieldset>
  <div>
  <label for="fruit">Select Account Type</label>
      <br>
      <i class="fa fa-sort"></i>
      <select class="floatLabel" name = "Seller_or_Buyer" id ="Seller_or_Buyer" >
        <option value="blank"></option>
        <option value="Buyer">Buyer</option>
        <option value="Seller">Seller</option>
    </select>
         </div>

		</form>

        <p><br>

          
  <input type="submit" name="submit" id="submit" class="button" value="Sign Up">
  <br>
          </p>
	</div> <!-- end login -->

</body>

<?php include '/includes/footer.php'; ?>

</html>