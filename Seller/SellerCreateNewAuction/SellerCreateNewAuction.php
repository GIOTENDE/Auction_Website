<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "auctionwebsitetest";

$connection = mysqli_connect($servername,$username,$password,$dbname)
                or die('Error connecting to MySQL server.'. mysql_error());

                $query = "INSERT INTO products (firstname, lastname, email) VALUES ()";

                $connection->close();
?>
<?php require '../Auction_Website/includes/pagetop.php'; ?>
<link rel="stylesheet" href="/AuctionWebsite/Seller/SellerCreateNewAuction/SellerCreateNewAuction.css" type="text/css">

<form action="javascript:void(0);" method="get">

			<fieldset>
<div id="login">
<html>
<head>
  <title>Auction an Item</title>
</head>


<form method="post" action="process.php" enctype="multipart/form-data">
 
  <div class="form-group">
    <h2 class="heading">Auction Item</h2>
<div id="login">
  <!-- Add title -->
    <div class="controls">
      <label for="name">Descriptive title of item:</label>
      <br>
      <input type="text" id="prod_name" class="floatLabel" name="prod_name" placeholder="Reserve Price" >
      
    </div>

  <!-- Add category -->
    <div class="controls">
      <label for="fruit">Select Category</label>
      <br>
      <i class="fa fa-sort"></i>
      <select class="floatLabel" name = "prod_category" id ="prod_category" >
        <option value="blank"></option>
        <option value="Collectables">Collectables and antiques</option>
        <option value="Home">Home and Garden</option>
        <option value="Sport">Sporting Goods</option>
        <option value="Electronics">Electronics</option>
        <option value="Jewellery">Jewellery and Watches</option>
        <option value="Toys">Toys and Games</option>
        <option value="Fashion">Fashion</option>
        <option value="Motors">Motors</option>
        <option value="Other">Other</option>
      </select>
    </div>
  </div>

  <!-- Add Condition -->
  <div class="controls">
    <label for="fruit">Select Condition</label>
      <br>
      <i class="fa fa-sort"></i>
      <select class="floatLabel" name = "prod_condition" id ="prod_condition" >
        <option value="blank"></option>
        <option value="New">New</option>
        <option value="Used">Used</option>
      </select>
    </div>
  </div>

  <!-- Upload Image -->

   <!--form action="upload.php" method="post" enctype="multipart/form-data"-->
       <p> Select image to upload:</p>
        <input type="file"
       onchange="readURL(this);" />
<img id="blah" src="http://placehold.it/180" alt="your image" />

    <!--/form--> 


  <div class="controls">
     <label for="comments">Detailed Description of Item:</label>
    <br>
      <textarea name="prod_description" class="floatLabel" id="prod_description"></textarea>
     
      <br>
    </div>

    <div class="controls">
      <label for="name">Auction Starting Price</label>
      <br>
      <input type="text" id="prod_start_price" class="floatLabel" name="prod_start_price" placeholder="Starting Price">
    </div>

    <div class="controls">
      <label for="name">Auction Reserve Price:</label>
      <br>
      <input type="text" id="prod_reserve_price" class="floatLabel" name="prod_reserve_price" placeholder="Reserve Price">
    </div>

    <div class="controls">
      <label for="name">End date of auction:</label>
      <br>
      <input type="date" id="prod_end_date" class="floatLabel" name="prod_end_date" >
    </div>
  <br>
     <input type="submit" name = "submit" id="submit">
  </div>

</form>
<pre>
<?php
if (isset($_POST['submit'])){
  print_r($_POST);
}
?>
</pre>
<?php require '../Auction_Website/includes/footer.php'; ?>
</body>
</html>



<!-- 
Title
Category
Condition
Description
Picture
Starting price
Reserve price
End date -->