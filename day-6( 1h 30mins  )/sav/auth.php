<?php

    session_start();


    require_once('connection_db.php');



    if (isset( $_POST['email'] ) and isset( $_POST['password'] )  ) {


        $email = $_POST['email'];
        $password = sha1($_POST['password']);



        // mysqli_query
        $req = $con->prepare('SELECT * FROM `users` WHERE `email` = ? AND `password` = ?');
        $req->execute(array($email,$password));



        $res = $req->rowCount();

   
        
        if ( $res == 0 ) {
            header('Location:login.php?message=wrong username or password&error=ok');
            
        }else{
            $data = $req->fetch(); 
            $_SESSION['id'] = $data['idusers'];
            header('Location:index.php');
        }
  


        
    }

?>