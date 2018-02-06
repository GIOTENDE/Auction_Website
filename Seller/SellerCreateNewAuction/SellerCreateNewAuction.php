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

<link rel="stylesheet" href="/AuctionWebsite/Seller/SellerCreateNewAuction/SellerCreateNewAuction.css" type="text/css">

<html>
<head>
  <title>Auction an Item</title>
</head>
<body>

<form method="post" action="process.php" enctype="multipart/form-data">
 
  <div class="form-group">
    <h2 class="heading">Auction Item</h2>

  <!-- Add title -->
    <div class="controls">
      <input type="text" id="prod_name" class="floatLabel" name="prod_name">
      <label for="name">Descriptive title of item</label>
    </div>

  <!-- Add category -->
    <div class="controls">
      <i class="fa fa-sort"></i>
      <select class="floatLabel" name = "prod_category" id ="prod_category">
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
      <label for="fruit">Category</label>
    </div>
  </div>

  <!-- Add Condition -->
  <div class="controls">
      <i class="fa fa-sort"></i>
      <select class="floatLabel" name = "prod_condition" id ="prod_condition" >
        <option value="blank"></option>
        <option value="New">New</option>
        <option value="Used">Used</option>
      </select>
      <label for="fruit">Condition</label>
    </div>
  </div>

  <!-- Upload Image -->

   <!--form action="upload.php" method="post" enctype="multipart/form-data"-->
       <p> Select image to upload:</p>
        <input type="file" name="prod_picture" onclick="add_image()"/>
        <input type="submit" name="submit" value="UPLOAD"/>
    <!--/form--> 


  <div class="controls">
      <textarea name="prod_description" class="floatLabel" id="prod_description"></textarea>
      <label for="comments">Detailed Description of Item</label>
      <br>
    </div>

    <div class="controls">
      <input type="text" id="prod_start_price" class="floatLabel" name="prod_start_price">
      <label for="name">Starting Price</label>
    </div>

    <div class="controls">
      <input type="text" id="prod_reserve_price" class="floatLabel" name="prod_reserve_price">
      <label for="name">Reserve Price</label>
    </div>

    <div class="controls">
      <input type="text" id="prod_end_date" class="floatLabel" name="prod_end_date">
      <label for="name">End Date</label>
    </div>

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