<?php include 'connection.php'; ?>
 
<?php
$name=$_GET['4'];

$select_image="select prod_id,prod_picture from product where prod_id='$name'";

$var=mysql_query($select_image);

if($row=mysql_fetch_array($var))
{
 $image_name=$row["imagename"];
 $image_content=$row["imagecontent"];
}
echo $image;
?>