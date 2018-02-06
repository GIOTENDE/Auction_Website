<?php include 'connection.php'; ?>
<?php
if(isset($_POST["submit"])){
    $check = getimagesize($_FILES["prod_picture"]["tmp_name"]);
    if($check !== false){
        $prod_picture = $_FILES['prod_picture']['tmp_name'];
        $imgContent = addslashes(file_get_contents($prod_picture));
// create a variable
$prod_name=$_POST['prod_name'];
$prod_category=$_POST['prod_category'];
$prod_condition=$_POST['prod_condition'];
//$prod_picture=$_FILES['prod_picture'];
$prod_description=$_POST['prod_description'];
$prod_start_price=$_POST['prod_start_price'];
$prod_reserve_price=$_POST['prod_reserve_price'];
$prod_end_date=$_POST['prod_end_date'];


 
//Execute the query
 
 
mysqli_query($connection,"INSERT INTO product (prod_name,prod_category,prod_condition,prod_picture,prod_description,prod_start_price,prod_reserve_price,prod_end_date)
		        VALUES ('$prod_name','$prod_category','$prod_condition','$imgContent','$prod_description','$prod_start_price','$prod_reserve_price','$prod_end_date')");
				
	if(mysqli_affected_rows($connection) > 0){
    echo "<p>Employee Added</p>";
    
	//echo "<a href="index.html">Go Back</a>";
} else {
	echo "Employee NOT Added<br />";
	echo mysqli_error ($connection);
}
    }else {
        echo "Please select an image.";
    }
}
?>

<a href="/AuctionWebsite/Seller/SellerCreateNewAuction/displayImage.php">Display Images</a> <br>

