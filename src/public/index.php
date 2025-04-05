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
      <li>Jpeg</li>
      <li>Jeux</li>
      <li>Classement</li>
    </ul>
    <ul id="userbar">
      <li>Admin</li>
      <li>Profil</li> <!-- à faire disparaitre si non connecté -->
      <li>log in</li> <!-- à faire disparaitre si connecté -->
      <li><img src="blabla.png" alt="profile picture"></li> <!--importer pp avec fonction php (si connecté) -->
    </ul>
  </nav>
</body>
</html>
