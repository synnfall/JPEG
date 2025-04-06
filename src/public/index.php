<?php
include "../db/db_connect.php";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>JPEG</title>

  <link rel="stylesheet" href="./style/global.css">

</head>
<body>
  <nav>
    <ul id="navbar">
      <li class="active"><a href="#">JPEG</a></li>
      <li><a href="">Jeux</a></li>
      <li><a href="">Classement</a></li>
    </ul>
    <ul id="userbar">
      <li class="admin"><a href="">Admin</a></li>
      <li class="profil"><a href="">Profil</a></li> <!-- à faire disparaitre si non connecté -->
      <li class="login"><a href="">log in</a></li> <!-- à faire disparaitre si connecté -->
      <li class="pfp"><img src="./img/pfp/default_pfp.jpg" alt="pfp"></li> <!--importer pp avec fonction php (si connecté) -->
    </ul>
  </nav>
</body>
</html>
