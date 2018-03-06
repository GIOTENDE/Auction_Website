<!--?php include '../../connection.php'; ?-->
<?php
include '../../config.php';
session_start();
echo $_SESSION['userID'];

$prod_name=$prod_category=$prod_condition=$prod_picture=$prod_description=$prod_reserve_price=$prod_start_price=$prod_end_date="";
$prod_name_temp=$prod_category_temp=$prod_condition_temp=$prod_picture_temp=$prod_description_temp=$prod_reserve_price_temp=$prod_start_price_temp=$prod_end_date_temp="";
$prod_nameErr=$prod_categoryErr=$prod_conditionErr=$prod_pictureErr=$prod_descriptionErr=$prod_reserve_priceErr=$prod_start_priceErr=$prod_end_dateErr="";
$imgContent="";
$postCheck = true;
$echoBreak = "<br>";
$prod_sellerID=$_SESSION['userID'];
$prod_start_date = date("d-m-Y H-i-s");
echo $prod_start_date;


function validate_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if($_SERVER["REQUEST_METHOD"] == "POST") {

if(isset($_POST["submit"])){

$prod_name_temp=$_POST['prod_name'];
$prod_category_temp=$_POST['prod_category'];
$prod_condition_temp=$_POST['prod_condition'];
$prod_description_temp=$_POST['prod_description'];
$prod_start_price_temp=$_POST['prod_start_price'];
$prod_reserve_price_temp=$_POST['prod_reserve_price'];
$prod_end_date_temp=$_POST['prod_end_date'];
    
//Validate TITLE
if (empty($_POST["prod_name"])) {
  $prod_nameErr = "Product title is required"."<br>";
  $postCheck = false;
} else if (strlen($_POST["prod_name"]) < 10) {
  $prod_nameErr = "Product title is too short! The title should be greater than 10 characters!"."<br>"; 
  $postCheck = false;
} else if (strlen($_POST["prod_name"]) > 80) {
  $prod_nameErr = "Product title is too long! The title should be less than 80 characters!"."<br>"; 
  $postCheck = false;
} else {
  $prod_name = validate_input($_POST["prod_name"]);
  
}



//Validate for PICTURE
if(file_exists($_FILES['prod_picture']['tmp_name']) || is_uploaded_file($_FILES['prod_picture']['tmp_name'])){

  if ($_FILES["prod_picture"]["size"] > 5000000) {
    $prod_pictureErr = "The image cannot be larger than 5MB!"."<br>";
    $postCheck = false;
  }
$target_dir = "Images/";
$target_file = $target_dir.basename($_FILES["prod_picture"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
    $prod_pictureErr = "Only JPG, JPEG, PNG & GIF files are allowed!"."<br>";
    $postCheck = false;
  } else{
    //$prod_picture = $_FILES['prod_picture']['tmp_name'];
    $prod_picture = $prod_sellerID."_".$prod_start_date.".".$imageFileType; //SAVE FILE NAME TO DATABASE
    move_uploaded_file($_FILES["prod_picture"]["tmp_name"], "../../Images/" . $prod_picture);
    echo $prod_picture;
    //move_uploaded_file($_FILES["prod_picture"]["tmp_name"], "Images/" . $prod_picture);
    //$imgContent = addslashes(file_get_contents($prod_picture));
  }

      } else {
        $prod_pictureErr = "Please upload a photograph"."<br>";
        $postCheck = false;
    }

//Validate for description
if (empty($_POST["prod_description"])) {
  $prod_descriptionErr = "Product description is required"."<br>";
  $postCheck = false;
} else if (strlen($_POST["prod_description"]) <40) {
  $prod_descriptionErr = "Product description is too short! The description should be greater than 40 characters!"."<br>"; 
  $postCheck = false;
} else if (strlen($_POST["prod_description"]) >=500) {
  $prod_descriptionErr = "Product description is too long! The title should be less than 500 characters!"."<br>"; 
  $postCheck = false;
} else {
  $prod_description = validate_input($_POST["prod_description"]);
}

//Validate for condition
if (empty($_POST["prod_condition"]) || $_POST["prod_condition"] == 'blank') {
  $prod_conditionErr = "Product condition is required"."<br>";
  $postCheck = false;
} else {
  $prod_condition = validate_input($_POST["prod_condition"]);
}

//Validate for category
if (empty($_POST["prod_category"]) || $_POST["prod_category"] == 'blank') {
  $prod_categoryErr = "Product category is required"."<br>";
  $postCheck = false;
} else {
  $prod_category = validate_input($_POST["prod_category"]);
}

$priceCheck = preg_match("/^[0-9]+\.[0-9]{2}$/",$prod_start_price);

//Validate for product start price
if (empty($_POST["prod_start_price"])) {
  $prod_start_priceErr = "Product start price is required"."<br>";
  $postCheck = false;
} else if (!preg_match("/^[0-9]+\.[0-9]{2}$/",$_POST["prod_start_price"])) {
  $prod_start_priceErr = "The price must be in the correct format! (e.g. £ 10.50)"."<br>";
  $postCheck = false;
}  else {
  $prod_start_price = validate_input($_POST["prod_start_price"]);
  }


//Validate for product reserve price
if (empty($_POST["prod_reserve_price"])) {
  $prod_reserve_priceErr = "Product reserve price is required"."<br>";
  $postCheck = false;
} else if (!preg_match("/^[0-9]+\.[0-9]{2}$/",$_POST["prod_reserve_price"])) {
  $prod_reserve_priceErr = "The price must be in the correct format! (e.g. £ 10.00)"."<br>"; 
  $postCheck = false;
}  else if ($_POST["prod_reserve_price"] < $_POST["prod_start_price"]){
  $prod_reserve_priceErr = "The reserve price must be greater or equal to the starting price"."<br>"; 
  $postCheck = false;
}  else {
  $prod_reserve_price = validate_input($_POST["prod_reserve_price"]);
}

//Validate for product end date
if (empty($_POST["prod_end_date"])) {
  $prod_end_dateErr = "Product end date is required!"."<br>";
  $postCheck = false;
} else {
  $unformattedDate=validate_input($_POST["prod_end_date"]);

          //   $splitDate = explode("T", $unformattedDate);
          //   $dateWOtime=$splitDate[0];
          //   $timeWOdate=$splitDate[1];
          //   $splitDateMore = explode("-", $dateWOtime);
          //   $date = $splitDateMore[2]."-".$splitDateMore[1]."-".$splitDateMore[0];
          //   $correctDate=$date." ".$timeWOdate;
          //  // echo $correctDate;
          //   $convertdate=date_create_from_format("d-m-Y H:i", $correctDate);
          //   //end date 
          //   $converteddate=$convertdate->format("d-m-Y H:i");
          //   $dateEnd= new DateTime($converteddate);
          //  $prod_end_date = $dateEnd;

           $prod_end_date=validate_input($_POST["prod_end_date"]);
}

//Execute the query
if ($postCheck){
mysqli_query($db,"INSERT INTO product (prod_name,prod_category,prod_condition,prod_picture,prod_description,prod_start_price,prod_reserve_price,prod_end_date,prod_sellerID,prod_start_date)
		        VALUES ('$prod_name','$prod_category','$prod_condition','$prod_picture','$prod_description','$prod_start_price','$prod_reserve_price','$prod_end_date','$prod_sellerID','$prod_start_date')");
				
	if(mysqli_affected_rows($db) > 0){
   // header('Location: ../SellerProfile/SellerProfile.php'); 
    echo "<div id='myModal' class='modal'>

    <!-- Modal content -->
    <div class='modal-content'>
      <div class='modal-header'>
        <span class='close'>&times;</span>
        <h2>Congratulations! You have listed an item successfully!</h2>
      </div>
      <div class='modal-body'>
        <p>
        Item Listed!
        </p>
        <div class= 'modal-footer'>

        <div id='button'> 
          <a href='../SellerProfile/SellerProfile.php'>Back to Seller Profile</a>
        </div>
        <div id='button'> 
          <a href='../SellerCreateNewAuction/SellerCreateNewAuction.php'>Auction another item</a>
        </div>

       </div>
      </div>
      
    </div>
  
  </div>";
    echo "<p>Employee Added</p>";
    
	//echo "<a href="index.html">Go Back</a>";
} else {
	echo "Employee NOT Added<br />";
	echo mysqli_error ($db);
}
} else{
  echo "Error! Forms must be correctly filled out!";
  echo "<script>
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
  </script>;
  <div id='myModal' class='modal'>

  <!-- Modal content -->
  <div class='modal-content'>
    <div class='modal-header'>
      <span class='close'>&times;</span>
      <h2>Woops! It seems some of the form data was filled in incorrectly!</h2>
    </div>
    <div class='modal-body'>
      <p>
      $prod_nameErr 
      $prod_categoryErr 
      $prod_conditionErr 
      $prod_pictureErr 
      $prod_descriptionErr 
      $prod_start_priceErr 
      $prod_reserve_priceErr
      $prod_end_dateErr
      </p>
     
    </div>
    
  </div>

</div>";
}
}else{
    echo "NO SUBMISSION";
}
}
?>

<!-- //////////////////////       TEMPLATE    //////////////////////-->

<?php require '../../includes/pagetop.php'; ?>
<link rel="stylesheet" href="CreateNewAuctionItem.css" type="text/css">


			<fieldset>
<div id="login">
<html>
<head>
  <title class="title">Auction an Item</title>
</head>

<a href="../SellerProfile/SellerProfile.php">Back to seller profile</a>

<div class="form">

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
 
  <div class="form-group">
    <h2 class="heading">Auction Item</h2>
<div id="login">

  <!-- Add title -->
    <div class="controls">
      <label class="label" for="name">Descriptive title of item:</label>
      <br>
      <input type="text" id="prod_name" class="floatLabel" name="prod_name" placeholder="Descriptive title" maxlength="50" value="<?php echo $prod_name_temp; ?>">
      <span class="error">* <?php echo $prod_nameErr;?></span>
      
    </div>

  <!-- Add category -->
    <div class="controls">
      <label class="label" for="fruit">Select Category</label>
      <br>
      <i class="fa fa-sort"></i>
      <select class="floatLabel" name = "prod_category" id ="prod_category" selected="<?php echo $prod_category_temp; ?>">
        <option value="blank"></option>
        <option value="Collectables and antiques">Collectables and antiques</option>
        <option value="Home and Garden">Home and Garden</option>
        <option value="Sporting Goods">Sporting Goods</option>
        <option value="Electronics">Electronics</option>
        <option value="Jewellery and Watches">Jewellery and Watches</option>
        <option value="Toys and Games">Toys and Games</option>
        <option value="Fashion">Fashion</option>
        <option value="Motors">Motors</option>
        <option value="Other">Other</option>
      </select>
    </div>
    <span class="error">* <?php echo $prod_categoryErr;?></span>
  </div>

  <!-- Add Condition -->
  <div class="controls">
    <label class="label" for="fruit">Select Condition</label>
      <br>
      <i class="fa fa-sort"></i>
      <select class="floatLabel" name = "prod_condition" id ="prod_condition" selected="<?php echo $prod_condition_temp; ?>">
        <option value="blank"></option>
        <option value="New">New</option>
        <option value="Used">Used</option>
      </select>
    </div>
    <span class="error">* <?php echo $prod_conditionErr;?></span>
  </div>

  <!-- Upload Image -->

      <p class="label"> Select image to upload:</p>
        <input type="file" name="prod_picture" onclick="add_image()"/>
        <span class="error">* <?php echo $prod_pictureErr;?></span>
  <script>
  var reader = new FileReader();
reader.onload = function(r_event) {
  document.getElementById('preview').setAttribute('src', r_event.target.result);
}

document.getElementsByName('prod_picture')[0].addEventListener('change', function(event) {
    reader.readAsDataURL(this.files[0]);
});
  </script>
  <!--  IMAGE PREVIEW   -->
  <img src="" id="preview" />


  <div class="controls">
     <label class="label" for="comments">Detailed Description of Item:</label>
    <br>
      <textarea name="prod_description" class="floatLabel" id="prod_description" rows="5" cols="40" ><?php echo $prod_description_temp; ?></textarea>
     
      <br>
      <span class="error">* <?php echo $prod_descriptionErr;?></span>
    </div>

    <div class="form-helper__symbol" data-symbol="£">
    
      <label class="label" for="name">Auction Starting Price</label>
      <br>
      <input type="number" id="prod_start_price" class="floatLabel" name="prod_start_price" placeholder="Starting Price" step="any" value="<?php echo $prod_start_price_temp; ?>">
      <span class="error">* <?php echo $prod_start_priceErr;?></span>
    </div>

    <div class="controls">
      <label class="label" for="name">Auction Reserve Price:</label>
      <br>
      <input type="number" id="prod_reserve_price" class="floatLabel" name="prod_reserve_price" placeholder="Reserve Price" step="any" value="<?php echo $prod_reserve_price_temp; ?>">
      <span class="error">* <?php echo $prod_reserve_priceErr;?></span>
    </div>

    <div class="controls">
      <label class="label" for="name">End date of auction:</label>
      <br>
      <input type="datetime-local" id="prod_end_date" class="floatLabel" name="prod_end_date" min="<?php echo date("Y-m-d")."T".date("H:i"); ?>" value="<?php echo $prod_end_date_temp; ?>">
      <span class="error">* <?php echo $prod_end_dateErr;?></span>
    </div>
  <br>
     <input type="submit" name="submit" id="submit" class="button" value="submit">
  </div>

</form>
</div>
<pre>
<?php
if (isset($_POST['submit'])){
  print_r($_POST);
}
?>
</pre>
<?php require '../../includes/footer.php'; ?>
</body>
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
