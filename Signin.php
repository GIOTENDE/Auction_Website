<?php
include("configsignin.php");

$postCheck = true;
$username = $password = "";

function validate_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["submit"])) {

        if (empty($_POST["username"])) {
            $usernameErr = "Please Enter Your Username" . "<br>";
            $postCheck = false;
        } else {
            $username = validate_input($_POST["username"]);
        }

        if (empty($_POST["password"])) {
            $passwordErr = "Please Enter Your Password" . "<br>";
            $postCheck = false;
        } else {
            $password1 = validate_input($_POST["password"]);
            $password = md5($password1);
        }

        if ($postCheck) {

            $getUserDetails = mysqli_query($db, "SELECT userID, Seller_or_Buyer, username FROM users WHERE username = '$username' and password = '$password'");
            //session_start();
            if (mysqli_num_rows($getUserDetails) > 0) {

                while ($row = mysqli_fetch_assoc($getUserDetails)) {
                    ob_start();
                    session_start();
                    $_SESSION['username'] = $username;
                    $_SESSION['userID'] = $row['userID'];
                    $_SESSION['Seller_or_Buyer'] = $row['Seller_or_Buyer'];
                    header('Location: roleSeperator.php');
                }
            } else {
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
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sign in</title>
    <link rel="stylesheet" href="style.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans:400,300'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!--[if lt IE 9]>
    <script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <script>
        window.onload = function () {
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
            span.onclick = function () {
                modal.style.display = 'none';
            }

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function (event) {
                if (event.target == modal) {
                    modal.style.display = 'none';
                }
            }
        }
    </script>
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

    <h2><strong>Welcome.</strong> Please login.</h2>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

        <fieldset>

            <p><input type="text" required value="Username" onBlur="if(this.value=='')this.value='Username'"
                      onFocus="if(this.value=='Username')this.value='' " name="username" id="username"></p>
            <!-- JS because of IE support; better: placeholder="Username" -->

            <p><input type="password" required value="Password" onBlur="if(this.value=='')this.value='Password'"
                      onFocus="if(this.value=='Password')this.value='' " name="password" id="password"></p>
            <!-- JS because of IE support; better: placeholder="Password" -->


            <p><input type="submit" name="submit" id="submit" class="button" value="Login"></p>

        </fieldset>

    </form>

    <p><span class="btn-round">or</span></p>

    <p>


        <a href="Signup.php">
            <button class="facebook">Sign Up</button>
        </a>

    </p>

</div> <!-- end login -->
</nav>
</body>
</html>
