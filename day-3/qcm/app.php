<?php
$servername = "localhost";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=rayenqcm", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     
  } catch(PDOException $e) {
    
  }


  $difficulty = null;


  if (isset( $_POST['difficulty'] )) {
      $difficulty = $_POST['difficulty'];
  }

 

  $reqQuestions = $conn->prepare('SELECT * FROM `questions` WHERE `niveau` = ? LIMIT 10');
  $reqQuestions->execute([$difficulty]);

    $blocHTML = '';


    while ( $data = $reqQuestions->fetch() ) {
        
        $blocHTML.='
            <h3>'.$data['libelleQ'].'</h3>
        ';

        // we must get the unsw
        $reqUns = $conn->prepare('SELECT * FROM `reponses` WHERE `idq` = ?');
        $reqUns->execute([$data['idq']]);

        $blocHTML.='<ul>';
        while ( $rep = $reqUns->fetch() ) {
            $blocHTML.='<li>  <input type="radio" name="response_question_'.$data['idq'].'" value="'.$rep['idr'].'" > <lablel>'.$rep['libeller'].'</label> </li>';
        }
        $blocHTML.='</ul>';

    }







?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">


</head>
<body>

<div class="container mt-5">
       <section class="text-center">
            <h1 class="text-center">Bienvenue dans mon QCM</h1>
       </section>


       <?php echo $blocHTML; ?>




</div>


    
</body>
</html>