<html lang="en-Us">
<?php require '../Auction_Website/includes/pagetop.php'; ?>
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

				<p><input type="text" required value="Username" onBlur="if(this.value=='')this.value='Username'" onFocus="if(this.value=='Username')this.value='' "></p> <!-- JS because of IE support; better: placeholder="Username" -->

				<p><input type="password" required value="Password" onBlur="if(this.value=='')this.value='Password'" onFocus="if(this.value=='Password')this.value='' "></p> <!-- JS because of IE support; better: placeholder="Password" -->

		

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