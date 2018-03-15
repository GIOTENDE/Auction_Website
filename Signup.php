<?php
include "configsignin.php";

$usernameErr = $passwordErr = "";
$headerModal = "Sign up complete!";

function validate_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST["submit"])) {
        // two passwords are matching
        if ($_POST['password'] == $_POST['confirmpassword']) {
            //cant have an already existing username
            $username = validate_input(($_POST['username']));
            $getUserDetails = mysqli_query($db, "SELECT username FROM users WHERE username=(('$username'))");
            if (!(mysqli_num_rows($getUserDetails) > 0)) {
                $username = validate_input(($_POST['username']));
                $email_address = validate_input(($_POST['email_address']));
                $password = md5($_POST['password']);    // md5 hash passord security
                $fullname = validate_input(($_POST['fullname']));
                $mobilenumber = validate_input(($_POST['mobilenumber']));
                $address = validate_input(($_POST['address']));
                $Seller_or_Buyer = validate_input(($_POST['Seller_or_Buyer']));
                $sql = "INSERT INTO users (username, email_address, password, fullname, mobilenumber, address, Seller_or_Buyer)" . "VALUES ('$username','$email_address','$password','$fullname','$mobilenumber','$address','$Seller_or_Buyer')";
                //if query is successful, redirect to signup.php page, done!

                mysqli_query($db, $sql);
                include 'SignupEmail.php';
                $headerModal = 'Sign up suceessful!';
                $modalSucess = 'Thank you for signing up Auction Website. <br>We will send you a confirmation email shortly! <br>Happy bidding!';
                include 'modal.php';
                //echo 'COMPLETED';
                /*if ($mysqli->query($sql)=== true){
                    $_SESSION['message'] = 'Registration successful! Added $username to the database';
                }
                else{
                    $_SESSION['message'] = "User could not be added to the database!";
                }*/
            } else {
                //echo "Username Already Exists!";
                $usernameErr = "Username already exists! <br>";
                $headerModal = "Woops! You haven't filled in your details correctly!";
                include 'modal.php';
            }
        } else {
            //	$_SESSION['message'] = "Two Passwords to not match";
            $passwordErr = "Passwords do not match! <br>";
            $headerModal = "Whoops! You haven't filled in your details correctly!";
            include 'modal.php';
        }
    } else {
        echo "submit not working";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="style.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans:400,300'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!--[if lt IE 9]>
    <script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

</head>

<body>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand">Auction Website</a>
        </div>
        <ul class="nav navbar-nav">
        </ul>
    </div>
</nav>

<div id="login">

    <h2><strong><br>Create a new account:</strong></h2>

    <form class="form" action="Signup.php" method="post" enctype="miltipart/form-data" autocomplete="off">
        <!-- <div class="alert alert-error"><?= $_SESSION['message'] ?></div> -->

        <fieldset>
            <h3>Insert Full Name: </h3>
            <p><input type="text" placeholder="John Doe" name="fullname" required></p>
            <h3>Insert Username: </h3>
            <p><input type="text" placeholder="Username" name="username"></p>
            <!-- JS because of IE support; better: placeholder="Username" -->
            <h3><strong>Create Password:</h3>
            <p><input type="password" required value="Password" name="password"
                      onBlur="if(this.value=='')this.value='Password'"
                      onFocus="if(this.value=='Password')this.value='' " required></p>

            <h3><strong>Repeat Password:</h3>
            <p><input type="password" required value="Password" name="confirmpassword"
                      onBlur="if(this.value=='')this.value='Password'"
                      onFocus="if(this.value=='Password')this.value='' " required></p>

            <!-- JS because of IE support; better: placeholder="Password" -->

            <h3>Insert Email Adress: </h3>
            <p><input type="text" placeholder="Email" name="email_address" required></p>
            <h3>Phone Number:</h3>
            <p><input type="text" placeholder="Phone Number" name="mobilenumber" required></p>
            <h3>Postal Adress:</h3>
            <p><input type="text" placeholder="Postal Adress" name="address" required></p>
        </fieldset>
        <div>
            <label for="fruit">Select Account Type</label>
            <br>
            <i class="fa fa-sort"></i>
            <select class="floatLabel" name="Seller_or_Buyer" id="Seller_or_Buyer">
                <option value="blank"></option>
                <option value="Buyer">Buyer</option>
                <option value="Seller">Seller</option>
            </select>
        </div>
        <br>

    </form>
    <input type="submit" name="submit" id="submit" class="button" value="Sign Up">
    <p><br>
        <br>
    </p>
</div> <!-- end login -->

</body>
</html>