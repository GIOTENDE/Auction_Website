<?php
include("config.php");

$role="";

if($role=="Seller"){
    header('Location: Seller/SellerProfile/SellerProfile.php'); 
}else if ($role=="Buyer"){
    header('Location: Buyer/Browse/categoryGallery.php'); 
}else{
    echo "Error reading user role";
}