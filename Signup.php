<html lang="en-Us">

<?php 
require '../Auction_Website/includes/pagetop.php'; 
session_start();
$_SESSION['message'] = '';
if($_SERVER['REQUEST METHOD'] == 'POST'){
	// two passwords are matching
	if($_POST['password'] == $_POST['confirmpassword']){
		$username = $mysql ->
	}
}

?>

<head>

	<meta charset="utf-8">

	<link rel="stylesheet" href="../Auction_Website/style.css">
	<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans:400,300'>

	<!--[if lt IE 9]>
		<script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

</head>

<body>

	<div id="login">

    <h1><strong><br>Create a new account:</strong></h1>

		<form class="form" action="Signup.php" method="post" enctype="miltipart/form-data" autocomplete="off">
		<div class="alert alert-error"><?= $_SESSION['message'] ?></div>

			<fieldset>

				<p><input type="text" placeholder="Username" name="username"></p> <!-- JS because of IE support; better: placeholder="Username" -->
<h1><strong>Create Password:</h1>
				<p><input type="password" required value="Password" name="password" onBlur="if(this.value=='')this.value='Password'" onFocus="if(this.value=='Password')this.value='' " required></p>

  <h1><strong>Repeat Password:</h1>
				<p><input type="password" required value="Password"  name = "confirmpassword" onBlur="if(this.value=='')this.value='Password'" onFocus="if(this.value=='Password')this.value='' " required></p>
      
<!-- JS because of IE support; better: placeholder="Password" -->
  
<h1>Insert Email Adress: </h1>
<p><input type="text" placeholder="Email" required></p>
<h1>Phone Number:</h1>			
<p><input type="text" placeholder="Email" required></p>
 <h1>Postal Adress:</h1>
<p><input type="text" placeholder="Postal Adress" required></p>
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
          
          
          
          
          
          
          
  <button class="facebook">Sign Up</button>
          </p>
	</div> <!-- end login -->

</body>

<?php require '../Auction_Website/includes/footer.php'; ?>

</html>