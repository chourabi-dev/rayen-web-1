<?php

    session_start();


    require_once('connection_db.php');
 


    $id = $_POST['id'];
    $label = $_POST['label']; 
    $price = $_POST['price']; 
    $descreption = $_POST['descreption'];  
    $categoryID = $_POST['category_id'];  





    $photo = $_FILES['photo'];
    
    $ext = pathinfo($photo['name'], PATHINFO_EXTENSION);
    $tmp_name = $_FILES["photo"]["tmp_name"];
    
    $photoID = uniqid();

    move_uploaded_file($tmp_name, './articles/'.$photoID.'.'.$ext);
     

    


    $reqInsert = $con->prepare('UPDATE `articles` SET `label_article`=?,`photo_article`=?,`decription_article`=?,`price`=?,`category_id`=? WHERE `id_article` = ?');
    $reqInsert->execute(array( $label, '/picine/articles/'.$photoID.'.'.$ext, $descreption,$price, $categoryID , $id));


    header('Location:dashboard.php');
        
          
 

?>