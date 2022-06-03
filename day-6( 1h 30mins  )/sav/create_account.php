<?php

    session_start();


    require_once('connection_db.php');



    if (isset( $_POST['email'] ) and isset( $_POST['password'] )  ) {


        $email = $_POST['email'];
        $fullname = $_POST['fullname'];
        $password = sha1($_POST['password']);



        // mysqli_query
        $req = $con->prepare('SELECT `idusers`, `fullname`, `email`, `role` FROM `users` WHERE `email` = ? ');
        $req->execute(array($email));



        $res = $req->rowCount();

        if ( $res != 0 ) {
            header('Location:login.php?message=this email is already in use&error=ok');
            
            
        }else{
            $reqInsert = $con->prepare('INSERT INTO `users`( `fullname`, `email`, `password`, `role`) VALUES (?,?,?,?) ');
            $reqInsert->execute(array( $fullname, $email, $password ,'ROLE_USER' ));


            header('Location:login.php');
            

    
        }



        
    }

?>