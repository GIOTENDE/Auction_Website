<?php include 'connection.php'; ?>
<?php
//if(!empty($_GET['prod_id'])){

    //Get image data from database
    $result = $connection->query("SELECT prod_picture FROM product WHERE prod_id = '2' ");
    
    if($result->num_rows > 0){
        $imgData = $result->fetch_assoc();
        
        //Render image
        header("Content-type: image/jpg"); 
        echo $imgData['prod_picture']; 
        echo "Image";
    }else{
        echo 'Image not found...';
    }

?>