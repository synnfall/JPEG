<?php
include_once __DIR__."/../libs/session.php";
if(! $connected)
{
  header("Location: login.php");
  exit;
}
if(! isset($_GET["ID_Jeux"]))
{
  header("Location: .");
  exit;
}
$token = handle_queue($conn);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile</title>

  <link rel="stylesheet" href="./style/global.css">
  <link rel="stylesheet" href="./style/waiting_room.css">
  <script>var token="<?php echo $token ?>"</script>
  <script defer async src="./scripts/waiting_room.js"></script>
</head>
<body>
  <!-- NAVBAR -->
  <nav>
    <ul id="navbar">
      <li class="active"><a href="">JPEG</a></li>
      <li><a href="jeux">Jeux</a></li>
      <li><a href="classements">Classement</a></li>
    </ul>
    <ul id="userbar">
      <?php if($connected && $_SESSION["admin"]) echo '<li class="admin"><a href="./admin/admin_utilisateur">Admin</a></li>'; ?> <!-- a faire apparaitre si admin -->
      <?php if($connected) echo '<li class="profil"><a href="">Profil</a></li>'; ?> <!-- à faire disparaitre si non connecté -->
      <?php if( ! $connected) echo '<li class="login"><a href="login">log in</a></li>'; ?> <!-- à faire disparaitre si connecté -->
      <?php if($connected) echo '<li class="username">'.$_SESSION["user"].'</li><li class="pfp"><a style="padding:0;" href="private-profile.php"><img src="'.$_SESSION['lienPdp'].'" alt="pfp"></a></li>'; ?> <!--importer pp avec fonction php (si connecté) -->
    </ul>
  </nav>

  <!-- MAIN -->
  <main>

    <div id="left" class="big_container">
      <div id="player1">
        <div class="profile">
          <img src="./img/pfp/default_pfp.jpg" alt="pfp" class="pfp" id="pfp_player1"> <!-- importer pp du compte ici -->
          <h2 class="identifiant" id="id_player1">John Doe</h2>  <!-- importer le nom du compte ici -->
        </div>
      </div>
    </div>

    <div id="center" class="big_container">
      <img src="./img/icons/versus.png" alt="versus">
      <h1>Recherche d'un joueur</h1>
    </div>
    <div id="right" class="big_container">
      <div id="player2">
        <div class="profile">
          <img src="./img/pfp/default_pfp.jpg" alt="pfp" class="pfp" id="pfp_player2"> <!-- importer pp du compte ici -->
          <h2 class="identifiant" id="id_player2">John Doe</h2>  <!-- importer le nom du compte ici -->
        </div>
      </div>
    </div>

  </main>

</body>
</html>
