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
      <li class="active" href="https://www.youtube.com/watch?v=jfKfPfyJRdk">Jpeg</li>
      <li>Jeux</li>
      <li>Classement</li>
    </ul>
    <ul id="userbar">
      <li class="admin">Admin</li>
      <li class="profil">Profil</li> <!-- à faire disparaitre si non connecté -->
      <li class="login">log in</li> <!-- à faire disparaitre si connecté -->
      <li class="pfp"><img src="./img/pfp/default_pfp.jpg" alt="pfp"></li> <!--importer pp avec fonction php (si connecté) -->
    </ul>
  </nav>
</body>
</html>
