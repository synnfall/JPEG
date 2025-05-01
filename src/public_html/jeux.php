<?php
include_once __DIR__."/../libs/session.php";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>JPEG - Classements</title>

  <link rel="stylesheet" href="./style/global.css">
  <link rel="stylesheet" href="./style/jeux.css">
  <script src="./scripts/jeux.js"></script>
</head>
<body onload="html_onload()">
  <!-- NAVBAR -->
  <nav>
    <ul id="navbar">
      <li ><a href=".">JPEG</a></li>
      <li class="active"><a href="">Jeux</a></li>
      <li><a href="classements.php">Classement</a></li>
    </ul>
    <ul id="userbar">
      <?php if($connected && $_SESSION["admin"]) echo '<li class="admin"><a href="./admin/admin_utilisateur.php">Admin</a></li>'; ?>
      <?php if($connected) echo '<li class="profil"><a href="">Profil</a></li>'; ?>
      <?php if( ! $connected) echo '<li class="login"><a href="login.php">log in</a></li>'; ?>
      <?php if($connected) echo '<li class="username">'.$_SESSION["user"].'</li><li class="pfp"><a style="padding:0;" href="private-profile.php"><img src="'.$_SESSION['lienPdp'].'" alt="pfp"></a></li>'; ?> <!--importer pp avec fonction php (si connecté) -->
    </ul>
  </nav>

  <!-- MAIN -->
  <main>
    <div class="top">
        <h1>Jeux disponibles</h1>
        <p>Vous trouverez ici les jeux pour voir leur description et y jouer.</p>

        <!-- maybe BARRE DE RECHERCHE -->

    </div>
    <div class="jeux">
        <table class="caroussel">
          
        </table>
        <div class="description">
          <h2>Aucun Jeux selectionné !</h2>
          <div class="contenu">
            <p>
              Selectionnez un jeux dans la liste a gauche pour pouvoir le visualiser !  
            </p>
            <img src="img/gear.svg" alt="">
          </div>
          <div class="boutons">
            <span class="bouton"><a id="bouton_jouer">Jouer au jeux</a></span>
            <span class="bouton jaime" id="bouton_like">J'aime le jeu</span>
          </div>
        </div>
    </div>
    <img src="./img/gear.svg" alt="gear" class="gear gear3 gear2"> <!-- gear2 change le sens ici -->
    <img src="./img/gear.svg" alt="gear" class="gear gear4">
  </main>

  <!-- FOOTER -->
  <footer>
    
  </footer>
</body>
</html>
