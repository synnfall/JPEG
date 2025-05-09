<?php
include_once __DIR__."/../libs/session.php";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>JPEG</title>

  <link rel="stylesheet" href="./style/global.css">
  <link rel="stylesheet" href="./style/home.css">

  <script src="./scripts/index.js"></script>
</head>
<body onload="html_onload()">
  <!-- NAVBAR -->
  <nav>
    <ul id="navbar">
      <li class="active"><a href="">JPEG</a></li>
      <li><a href="jeux.php">Jeux</a></li>
      <li><a href="classements.php">Classement</a></li>
    </ul>
    <ul id="userbar">
      <?php if($connected && $_SESSION["admin"]) echo '<li class="admin"><a href="./admin/admin_utilisateur.php">Admin</a></li>'; ?> <!-- a faire apparaitre si admin -->
      <?php if($connected) echo '<li class="profil"><a href="">Profil</a></li>'; ?> <!-- à faire disparaitre si non connecté -->
      <?php if( ! $connected) echo '<li class="login"><a href="login.php">log in</a></li>'; ?> <!-- à faire disparaitre si connecté -->
      <?php if($connected) echo '<li class="username">'.$_SESSION["user"].'</li><li class="pfp"><a style="padding:0;" href="private-profile.php"><img src="'.$_SESSION['lienPdp'].'" alt="pfp"></a></li>'; ?> <!--importer pp avec fonction php (si connecté) -->
    </ul>
  </nav>

  <!-- MAIN -->
  <main>
    <div class="titre">
      <!-- H1 titre dynamique c.f. index.js -->
       <p>Découvrez les joies de la victoire, ne perdez plus !</p>
    </div>
    <form action="waiting_room.php" method="get">
      <div class="caroussel_jeux">
        
        <div class="bouton neutre"><a href="">Voir Plus</a></div>
        
        <!-- TAB JEUX -->
        

      </div>
    </form>
    <div class="classement">
      <!-- TAB CLASSEMENT -->
    </div>

    
    <img src="./img/gear.svg" alt="gear" class="gear gear3">
    <img src="./img/gear.svg" alt="gear" class="gear gear4">
  </main>

  <!-- FOOTER -->
  <footer>
    
  </footer>
</body>
</html>
