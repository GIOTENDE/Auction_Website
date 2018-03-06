<?php
include("config.php");
session_start();

$role=$_SESSION['Seller_or_Buyer'];

if($role=="Seller"){
    header('Location: Seller/SellerProfile/SellerProfile.php'); 
}else if ($role=="Buyer"){
    header('Location: Buyer/Browse/categoryGallery.php'); 
}else{
    echo "Error reading user role";
}