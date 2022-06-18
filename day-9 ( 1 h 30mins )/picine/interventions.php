<?php
    session_start();

    require_once('check_auth.php');


    require_once('connection_db.php');




    $BocInterventions = '';

    $reqS = $con->prepare('SELECT *  FROM `interventions`');
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



        <td>';

            if ($data['status'] == 0 ) {
                $BocInterventions.='<a href="change_status.php?intervention='.$data['idinterventions'].'&status=1" ><span class="badge bg-success">commencer</span></a>';
            }

            if ($data['status'] == 1 ) {
                $BocInterventions.='<a href="change_status.php?intervention='.$data['idinterventions'].'&status=2" ><span class="badge bg-warning">terminer</span></a>';
            }
 


            if ($_SESSION['role'] == 'ROLE_ADMIN') {
                $BocInterventions.='<a href="delete_intervention.php?id='.$data['idinterventions'].'" ><span class="badge bg-danger">supprimer</span></a>';
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



         <div class="card mt-5">
           <div class="card-body">
              <h3>Tout les interventions</h3>


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