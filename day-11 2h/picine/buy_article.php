<?php
    session_start();

    require_once('check_auth.php');


    require_once('connection_db.php');


 
 
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
    

  

        
      <?php
        if ($_SESSION['status'] == 0) {
          echo '
          <div class="container mt-5">
            <div class="alert alert-danger">
              Thank you for your registration, wait for the system admin approval. <br/>

              <a href="logout.php">Logout</a>
            </div>
          </div>
          
          ';
        }

      ?>



        <?php $article = null;  if ($_GET['id']) {
          $article = $_GET['id'];
        } ?>


      <?php include_once ('./components/navbar.php');?>



      <!-- Button trigger modal -->
        <button type="button" id="btn-review" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" style="display: none;">
        Launch demo modal
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Review</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>do you enjoy using our website ?</p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">no</button>
                <button type="button" class="btn btn-primary">yes</button>
            </div>
            </div>
        </div>
        </div>




      <div class="container mt-5">
          <div class="row">
            <div class="col-sm-3">
            
            <?php include_once ('./components/side_menu.php');?>

            </div>


            <div class="col-sm-9"> 

              <div class="row">
                <?php
                    $req = 'SELECT * FROM `articles`,categories WHERE articles.category_id = categories.id_category AND articles.id_article = '.$article;
                
                    $reqArtciles = $con->prepare($req);

                    $reqArtciles->execute(array());


                    while ($data = $reqArtciles->fetch()) {
                    echo '
                    <div class="card mb-5">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                <h1>'.$data['label_article'].'</h1>
                                <h3>'.$data['price'].'$</h3>
                                    


                                    
                                    <p class="text-muted">'.$data['createdAt'].'</p>
                                </div>



                                <div>
                                    <p>'.$data['likes'].' Likes</p>
                                </div>
                            
                            </div>
                             
                        </div>
                    </div>


                     

                    <div class="card mb-5">
                        <div class="alert alert-success">Merci de votre achat '.$_SESSION['fullname'].'</div>

                    </div>


                    
                    ';


                    
                    }


                
                ?>
              </div>


              

            </div>
          </div>
      </div>







    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>



    <script>
        setTimeout(() => {
                document.getElementById("btn-review").click();
            }, 3000);
    </script>
  </body>
</html>