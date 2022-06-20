<?php
    session_start(); 
    require_once('check_auth.php'); 
    require_once('connection_db.php');


    $articlesHTMLBLOC='';



    $req = 'SELECT * FROM `articles`,categories WHERE articles.category_id = categories.id_category' ;
    $reqArtciles = $con->prepare($req);

    $reqArtciles->execute(array());


    while ($data = $reqArtciles->fetch()) {
      $articlesHTMLBLOC.= '
      <tr >
        <td>'.$data['id_article'].'</td>
        
        <td style="width:100px"> <img src="'.$data['photo_article'].'" class="w-100" alt="..."></td>
        
        
        
        <td>'.$data['label_article'].'</td> 
        <td>'.$data['likes'].' likes</td>
        
        <td>
        <a href="update_article_page.php?id='.$data['id_article'].'" class="btn btn-secondary btn-sm">modifier</a>
        
        
        <a href="delete_article.php?id='.$data['id_article'].'" class="btn btn-danger btn-sm">supprimer</a>
        
        </td>
        
        
      </tr>
      ';
    }

    








    $categoriesHTMLBLOC='';



    $req = 'SELECT * FROM categories' ;
    $reqCAT = $con->prepare($req);

    $reqCAT->execute(array());


    while ($data = $reqCAT->fetch()) {
      $categoriesHTMLBLOC.= '
      <tr >
        <td>'.$data['id_category'].'</td>
         
        <td>'.$data['label_category'].'</td>  
        <td>
            <a href="delete_category.php?id='.$data['id_category'].'" class="btn btn-danger btn-sm">supprimer</a>
        </td>
        
        
      </tr>
      ';
    }

    

?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  </head>
  <body>
    
  

        <div class="container mt-5">
          <div class="d-flex justify-content-between">
            <div>
                <h1>Admin page</h1>

        
            </div>


            <div>
              <a href="logout.php" class="btn btn-danger">Log out</a>
            </div>
          </div>



         <div class="card mt-5">
           <div class="card-body">
              <h3>Tout les articles</h3>

              <p>
              <a href="article_add.php" class="btn btn-outline-primary">ajouter un article</a>

              </p>

              <table class="table">
                <tbody>
                  <?php echo $articlesHTMLBLOC ;?>
                </tbody>
              </table>

           </div> 
         </div>



         <div class="card mt-5">
            
           <div class="card-body">
              <h3>Tout les categories</h3>
              <p>
              <a href="add_category.php" class="btn btn-outline-primary">ajouter un category</a>

              </p>

              <table class="table">
                <tbody>
                  <?php echo $categoriesHTMLBLOC ;?>
                </tbody>
              </table>

           </div>
         </div>


         



        </div>












    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  </body>
</html>