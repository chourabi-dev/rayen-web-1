<?php
    session_start();

    require_once('check_auth.php');


    require_once('connection_db.php');





    if (isset($_POST['description'])) {
      $req = $con->prepare('INSERT INTO `interventions`( `description`, `status`, `users_idusers`) VALUES (?,?,?)');
      $req->execute(array( $_POST['description'],0,$_SESSION['id'] ));

    }



    $BocInterventions = '';

    $reqS = $con->prepare('SELECT *  FROM `interventions` WHERE users_idusers = ?');
    $reqS->execute(array( $_SESSION['id'] ));

    while( $data = $reqS->fetch() ){
      $BocInterventions.='
        <tr>
        <td>'.$data['idinterventions'].'</td>
        <td>'.$data['description'].'</td>
        <td>'.$data['date'].'</td>
        <td>';

        if ($data['status'] == 0 ) {
          $BocInterventions.='<span class="badge bg-info">en attente</span>';
        }

        if ($data['status'] == 1 ) {
          $BocInterventions.='<span class="badge bg-warning">en cours</span>';
        }

        if ($data['status'] == 2 ) {
          $BocInterventions.='<span class="badge bg-success">terminé</span>';
        }
        if ($data['status'] == 3 ) {
          $BocInterventions.='<span class="badge bg-danger">suprimé</span>';
        }

  
        
        $BocInterventions.='</td>
        
          
        </tr>
      ';
    }

?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  </head>
  <body>
    
  

        <div class="container mt-5">
          <div class="d-flex justify-content-between">
            <div>
            <h1>Home page</h1>

        
            </div>


            <div>
              <a href="logout.php" class="btn btn-danger">Log out</a>
            </div>
          </div>






         <div class="card">
           <div class="card-body">
              <h3>Creation d'une intervention</h3>


              <form action="" method="post">
                  <div class="form-group mb-3">
                      <label for="">What's the problem ?</label>
                      <textarea name="description"  rows="10" class="form-control"></textarea>
                  </div>

                  <div class="">
                    <button class="btn btn-primary" type="submit">Envoyer</button>
                  </div>
              </form>

           </div>
         </div>


         <div class="card mt-5">
           <div class="card-body">
              <h3>Mes interventions</h3>


              <table class="table">
                <tbody>
                  <?php echo $BocInterventions ;?>
                </tbody>
              </table>

           </div>
         </div>


         



        </div>












    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  </body>
</html>