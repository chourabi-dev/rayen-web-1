<?php


echo '
<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Picine</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>


    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="contact.php">Contact</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link text-danger" href="logout.php">Logout</a>
        </li> 
      </ul>
    </div>



    <div>
      <div class="d-flex">
      <div><img src="'.$_SESSION['avatar'].'" style="width:60px;border-radius:50%;">
      </div>

      <div><p class="text-white">salut!, '.$_SESSION['fullname'].'</p></div>
      
      </div>
    </div>

  </div>
</nav>
';

?>