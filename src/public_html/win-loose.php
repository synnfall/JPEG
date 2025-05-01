<?php
error_reporting(E_ALL) ;
ini_set( 'display_errors' , '1' ) ;
if(! isset($_GET["id_p"])) {
  header("Location: .");
  exit;
}
include_once __DIR__."/../libs/session.php";
include_once __DIR__."/../vue/vue_win-loose.php";


if($connected){
  if(($IDj1 == $_SESSION['UserID'] || $IDj2 == $_SESSION['UserID'])){
    if($IDj1==$_SESSION['UserID'] && $joueur_1_a_gagner){
      $win = true;
      $name = "You";
    }
    else if($IDj2==$_SESSION['UserID'] && !$joueur_1_a_gagner){
      $win = true;
      $name = "You";
    }
    else{
      $win = false;
    }
  }
  else{
    $win = true;
    if($joueur_1_a_gagner){
      $name = $name1;
    }
    else{
      $name = $name2;
    }
  }
}
else{
  $win = true;
  if($joueur_1_a_gagner){
    $name = $name1;
  }
  else{
    $name = $name2;
  }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Resultat</title>

  <link rel="stylesheet" href="./style/global.css">
  <link rel="stylesheet" href="./style/waiting_room.css">
  <script defer async src="./scripts/win-loose.js"></script>
</head>
<body>
  <!-- NAVBAR -->
  <nav>
    <ul id="navbar">
      <li class="active"><a href=".">JPEG</a></li>
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
          <img src="<?php echo $pfp1?>" alt="pfp" class="pfp" id="pfp_player1"> <!-- importer pp du compte ici -->
          <h2 class="identifiant" id="id_player1"><?php echo $name1 ?></h2>  <!-- importer le nom du compte ici -->
        </div>
      </div>
    </div>

    <div id="center" class="big_container">
      <?php
      if ($win==true){
        echo(vue_win($name));
      }elseif($win==false){
        echo(vue_loose());
      }
      ?>


    </div>


    <div id="right" class="big_container">
      <div id="player2">
        <div class="profile">
          <img src="<?php echo $pfp2?>" alt="pfp" class="pfp" id="pfp_player2"> <!-- importer pp du compte ici adversaire -->
          <h2 class="identifiant" id="id_player2"><?php echo $name2 ?></h2>  <!-- importer le nom du compte ici adversaire-->
        </div>
      </div>
    </div>

  </main>

</body>
</html>
