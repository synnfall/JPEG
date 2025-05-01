<?php
include_once __DIR__."/../../libs/session.php";
if(!$connected){
  header("Location: ../");
  exit;
}
include_once __DIR__."/../../libs/lib_games.php";
if (! $token){
  header("Location: ../");
  exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shifumi</title>

  <link rel="stylesheet" href="../style/global.css">
  <link rel="stylesheet" href="../style/pfc.css">

  <script>var token = "<?php echo $token ?>"</script>
  <script defer async src="../scripts/pfc.js"></script>
</head>
<body>
  <!-- NAVBAR -->
  <nav>
    <ul id="navbar">
      <li class="active"><a href="../">JPEG</a></li>
      <li><a href="../jeux.php">Jeux</a></li>
      <li><a href="../classements.php">Classement</a></li>
    </ul>
    <ul id="userbar">
      <?php if($connected && $_SESSION["admin"]) echo '<li class="admin"><a href="../admin/admin_utilisateur.php">Admin</a></li>'; ?> <!-- a faire apparaitre si admin -->
      <?php if($connected) echo '<li class="profil"><a href="">Profil</a></li>'; ?> <!-- à faire disparaitre si non connecté -->
      <?php if( ! $connected) echo '<li class="login"><a href="../login.php">log in</a></li>'; ?> <!-- à faire disparaitre si connecté -->
      <?php if($connected) echo '<li class="username">'.$_SESSION["user"].'</li><li class="pfp"><a style="padding:0;" href="../private-profile.php"><img src="../'.$_SESSION['lienPdp'].'" alt="pfp"></a></li>'; ?> <!--importer pp avec fonction php (si connecté) -->
    </ul>
  </nav>

  <!-- MAIN -->
  <main>

    <div id="left" class="big_container">
      <div id="player1">
        <div class="profile">
          <img src="../<?php echo $_SESSION['lienPdp'] ?>" alt="pfp" class="pfp" id="pfp_player1"> <!-- importer pp du compte ici -->
          <h2 class="identifiant" id="id_player1"><?php echo $_SESSION["user"] ?></h2>  <!-- importer le nom du compte ici -->
        </div>
        <span id="score_player1"><span id="pts_player1">0</span> / 3</span> <!-- Point player 2 -->
      </div>
    </div>

    <div id="center" class="big_container">
      <div id="center-up" class="center_child">
        <div id="container_timer"><span><span id="timer">...</span>s</span></div>  <!-- Timer -->
      </div>

      <div id="center-middle">
        <div class="container_coup">
          <img src="../img/icons/interrogation.png" alt="rock" id="choix_player1_preview">
        </div>
        <img src="../img/icons/versus.png" alt="versus">
        <div class="container_coup">
          <img src="../img/icons/interrogation.png" alt="versus">
        </div>
      </div>

      
      <div id="center-down" class="center_child">
        <ul>
          <li class="bouton_pfc pointer" id="rock_choice"><img src="../img/icons/rock.png" alt="rock"></li>
          <li class="bouton_pfc pointer" id="paper_choice"><img src="../img/icons/paper.png" alt="paper"></li>
          <li class="bouton_pfc pointer" id="scissors_choice"><img src="../img/icons/scissors.png" alt="scissors"></li>
        </ul>
        <button id="bouton_tricher"><img src="../img/icons/skull.png">Tricher</button>
      </div>
    </div>
    <div id="right" class="big_container">
      <div id="player2">
        <div class="profile">
          <img src="../<?php echo $avd[0]["lienPdp"]?>" alt="pfp" class="pfp" id="pfp_player2"> <!-- importer pp du compte ici -->
          <h2 class="identifiant" id="id_player2"><?php echo $avd[0]["identifiant"] ?></h2>  <!-- importer le nom du compte ici -->
        </div>
        <span id="score_player2"><span id="pts_player2">0</span> / 3</span> <!-- Point player 2 -->
      </div>
    </div>

  </main>

</body>
</html>
