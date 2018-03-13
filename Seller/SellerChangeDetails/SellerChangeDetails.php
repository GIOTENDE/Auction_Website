
<?php 
include("../../config.php");
session_start();
$userID = $_SESSION['userID'];

$username = $email_address = $password = $fullname = $mobilenumber = $address ="";

$usernameErr=$passwordErr="";
$headerModal = "User details changed!";

function validate_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
  }

//$_SESSION['message']="";
$getUserDetails=mysqli_query($db,"SELECT username, email_address, password, fullName, mobilenumber, address FROM users WHERE userID='$userID'");
if (mysqli_num_rows($getUserDetails) > 0) {
    while($row = mysqli_fetch_assoc($getUserDetails)) {

		$username = $row["username"];
		$email_address = $row["email_address"];
		$password = $row["password"];
		$fullname = $row["fullName"];
		$mobilenumber = $row["mobilenumber"];
		$address = $row["address"];
		
	}
}

$check = mysqli_query($db,"SELECT username FROM users WHERE username=(('$username'))");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	if(isset($_POST["submit"])){
	// two passwords are matching
	if($_POST['password'] == $_POST['confirmpassword']){
		//cant have an already existing username
		if (mysqli_num_rows($check) > 0) {
		$username = validate_input(($_POST['username']));
		$email_address = validate_input(($_POST['email_address']));
		$password = md5($_POST['password']);// md5 hash passord security
		$fullname = validate_input(($_POST['fullname']));
		$mobilenumber = validate_input(($_POST['mobilenumber']));
		$address = validate_input(($_POST['address']));

		//if query is successful, redirect to signup.php page, done!
		
		mysqli_query($db,"UPDATE users SET username='$username', email_address='$email_address', password='$password', fullname='$fullname', mobilenumber='$mobilenumber', address='$address' WHERE userID='$userID'");
		include 'SellerChangeDetailsEmail.php';
		echo "Changes Saved!";
		}else{
			$usernameErr= "Username already exists! <br>";
			$headerModal = "Woops! You haven't filled in your details correctly!";
			include 'modal.php';
		}
	
	}
	else{
		$passwordErr="Passwords do not match! <br>";
		$headerModal = "Woops! You haven't filled in your details correctly!";
		include 'modal.php';
	} 
	}else{echo "submit not working";}
}
 
?>
<html lang="en-Us">
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Auction Website</a>
        </div>
          <ul class="nav navbar-nav">
            <li class="active"><a href="../SellerProfile/SellerProfile.php">Home</a></li>
            <li  class="active"><a href="../../logout.php">Logout</a></li>
          </ul>
        </div>
      </div>
  </div>

<head>

	<meta charset="utf-8">

	<link rel="stylesheet" href="CreateNewAuctionItem1.css">
	<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans:400,300'>

	<!--[if lt IE 9]>
		<script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

</head>

<body>

	<div id="login">

    <h1><strong><br>Change Account Details:</strong></h1>

		<form class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="miltipart/form-data" autocomplete="off">
		<div class="alert alert-error"><?= $_SESSION['message'] ?></div>

			<fieldset>
			<h1>Change Full Name: </h1>
<p><input type="text" value="<?php echo $fullname; ?>" name= "fullname" required></p>
            <h1>Change Username: </h1>
				<p><input type="text" value="<?php echo $username; ?>" name="username"></p> <!-- JS because of IE support; better: placeholder="Username" -->
<h1><strong>Change Password:</h1>
				<p><input type="password" required placeholder="Please a new/old password" name="password" onBlur="if(this.value=='')this.value='Password'" onFocus="if(this.value=='Password')this.value='' " required></p>

  <h1><strong>Re-enter Password:</h1>
				<p><input type="password" required placeholder="Re-enter your new/old password"  name = "confirmpassword" onBlur="if(this.value=='')this.value='Password'" onFocus="if(this.value=='Password')this.value='' " required></p>
      
<!-- JS because of IE support; better: placeholder="Password" -->
  
<h1>Change Email Address: </h1>
<p><input type="text" value="<?php echo $email_address; ?>" name= "email_address" required></p>
<h1>Change Phone Number:</h1>			
<p><input type="text" value="<?php echo $mobilenumber; ?>" name="mobilenumber" required></p>
 <h1>Change Postal Address:</h1>
<p><input type="text" value="<?php echo $address; ?>" name="address" required></p>
			</fieldset>
 

		</form>

        <p><br>

          
  <input type="submit" name="submit" id="submit" class="button" value="Change Details">
  <br>
          </p>
	</div> <!-- end login -->

</body>



</html>