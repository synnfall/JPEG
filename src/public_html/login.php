<?php
include_once __DIR__."/../db/db_connect.php";
include_once __DIR__."/../libs/session.php";
include_once __DIR__."/../libs/forms/login.php";
include_once __DIR__."/../vue/vue_login.php";
if( $_SESSION['user'])
{
  header("Location: .");
  exit;
}
$login_check = login($conn);
$register_check = register($conn);
if( $login_check || $register_check )
{
  header("Location: .");
  exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>

  <link rel="stylesheet" href="./style/global.css">
  <link rel="stylesheet" href="./style/login.css">

  <link href="https://fonts.googleapis.com/css2?family=Itim&display=swap" rel="stylesheet">

  <script defer async src="./scripts/login.js"></script>
  <script async src="./scripts/view_password.js"></script>

</head>
<body>
  <!-- NAVBAR -->
  <nav>
    <ul id="navbar">
      <li><a href=".">JPEG</a></li>
      <li><a href="jeux.php">Jeux</a></li>
      <li><a href="classements.php">Classement</a></li>
    </ul>
    <ul id="userbar">
      <?php if( ! $connected) echo '<li class="login"><a href="login.php">log in</a></li>'; ?> <!-- à faire disparaitre si connecté -->
    </ul>
  </nav>
  <!-- MAIN -->
  <main>
    <!-- Login -->
    <div id="login_container" class="">

      <div id="login_box">

        <h1>Login</h1>
        
        
        <form action="" method="post">
          <?php echo error_login($register_check); ?><!-- enlever class hidden pour afficher -->

          <div class="inputbox" id="identifiant">
            <img src="./img/icons/user_01.png" class="icone" alt="user">
            <input type="identifiant" placeholder="Identifiant" name="login">
          </div>

          <div class="inputbox">
            <img src="./img/icons/lock.png" class="icone" alt="lock">
            <input type="password" placeholder="Mot de passe" name="mdp" class="password">
            <img src="./img/icons/hide.png" class="toggle-eye" alt="hide">
          </div>


          <div class="remember">
            <input type="checkbox">
            <img src="./img/icons/checked.png">
            <label>Remember me</label>
          </div>

          <input type="submit" value="Connexion" class="submit_button">

          
        </form>
        <div class="toggle_login_signup">
          <span>Pas de compte ?</span>
          <button class="switch_login_into_signup">S'enregistrer</button>
        </div>
      </div>
    </div>





    <div id="signup_container" class="hidden">
      <!-- Signup -->

      <div id="login_box">

        <h1>Sign up</h1>

        <form action="" method="post">

          <label name="problem_input" class="danger hidden">insert indication sur mauvais format </label>

          <div class="inputbox" id="identifiant">
            <img src="./img/icons/user_01.png" class="icone">
            <input type="identifiant" placeholder="Identifiant" name="register">
          </div>

          <div class="inputbox">
            <img src="./img/icons/lock.png" class="icone">
            <input type="password" placeholder="Mot de passe" name="mdp" class="password">
            <img src="./img/icons/hide.png" class="toggle-eye">
          </div>

          <label name="problem_input" class="danger hidden">insert declaration de format incorrecte</label> <!-- enlever class hidden pour afficher -->

          <input type="submit" value="S'enregistrer" class="submit_button">

        </form>
        <div class="toggle_login_signup">
          <span>Déjà un compte ?</span>
          <button class="switch_signup_into_login">Se connecter</button>
        </div>
      </div>
    </div>


</main>
<img src="./img/gear.svg" alt="gear" class="gear gear2">
</body>
</html>
