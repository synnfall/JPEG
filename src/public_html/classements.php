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
  <link rel="stylesheet" href="./style/classements.css">
  <script src="./scripts/classements.js"></script>
</head>
<body onload="html_onload()">
  <!-- NAVBAR -->
  <nav>
    <ul id="navbar">
      <li ><a href=".">JPEG</a></li>
      <li><a href="jeux.php">Jeux</a></li>
      <li class="active"><a href="">Classement</a></li>
    </ul>
    <ul id="userbar">
      <?php if($connected && $_SESSION["admin"]) echo '<li class="admin"><a href="./admin/admin_utilisateur.php">Admin</a></li>'; ?>
      <?php if($connected) echo '<li class="profil"><a href="">Profil</a></li>'; ?>
      <?php if( ! $connected) echo '<li class="login"><a href="login.php">log in</a></li>'; ?>
      <?php if($connected) echo '<li class="username">'.$_SESSION["user"].'</li><li class="pfp"><a style="padding:0;" href="private-profile.php"><img src="'.$_SESSION['lienPdp'].'" alt="pfp"></a></li>'; ?>
    </ul>
  </nav>

  <!-- MAIN -->
  <main>
    <div class="top">
        <h1>Classements par jeux</h1>
        <p>Vous trouverez ici le classement par jeux pour tout les jeux</p>

        <!-- BARRE DE RECHERCHE -->

    </div>
    <div class="classements">
        
    </div>
    <img src="./img/gear.svg" alt="gear" class="gear gear3 gear2"> <!-- gear2 change le sens ici -->
    <img src="./img/gear.svg" alt="gear" class="gear gear4">
  </main>

  <!-- FOOTER -->
  <footer>
    
  </footer>
</body>
</html>
