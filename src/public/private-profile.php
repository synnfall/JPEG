<?php
include_once __DIR__."/../libs/session.php";
if(!$connected)
{
  header("Location: ./");
  exit;
}
include_once __DIR__."/../libs/forms/update_profile.php";
include_once __DIR__."/../libs/forms/pfp_upload.php";

if(isset($_POST["update"]) && isset($_POST["username_login"]) && $_POST["password_login"]) $update = change_name_and_passwd($conn, $_POST["username_login"], $_POST["password_login"]);
else $update = false;

if(isset($_FILES['pfp'])) upload_pfp($conn);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile</title>

  <link rel="stylesheet" href="./style/global.css">
  <link rel="stylesheet" href="./style/private_profile.css">

  <script defer async src="./scripts/private-profile.js"></script>
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
      <?php if($connected && $_SESSION["admin"]) echo '<li class="admin.php"><a href="./admin/admin_utilisateur">Admin</a></li>'; ?>
      <?php if($connected) echo '<li class="profil"><a href="">Profil</a></li>'; ?>
      <?php if( ! $connected) echo '<li class="login"><a href="login.php">log in</a></li>'; ?>
      <?php if($connected) echo '<li class="username">'.$_SESSION["user"].'</li><li class="pfp"><a style="padding:0;" href="private-profile.php"><img src="'.$_SESSION['lienPdp'].'" alt="pfp"></a></li>'; ?>
    </ul>
  </nav>

  <!-- MAIN -->
  <main>
    <div id="container_profile">

      <!-- MENU PROFILE -->
      <div id="container_pages_profile_buttons">
        <ul>
          <li class="pointer warn bouton_courant" id="settings_button"><img src="./img/icons/settings.png"></li>
          <li class="pointer warn" id="friends_button"><img src="./img/icons/users.png"></li>
          <li class="pointer warn" id="stats_button"><img src="./img/icons/stats.png"></li>
          <div id="cursor_triangle"></div>
        </ul>
      </div>

      <!-- PAGES -->
      <div id="update_page" class="">
        
        <!-- UPDATE PROFILE -->
        <div id="update_profile" class="profile-page">
          <div id="update_menu">
            <div id="edit_img_container">
              <img src="<?php echo $_SESSION['lienPdp']; ?>" alt="pfp" id="pp_preview_edit" class="pointer"> <!-- importer pp du compte ici -->
              <div id="edit_icon_container" class="pointer"><img src="./img/icons/edit.png" alt="edit"></div> 
              <form method="post" action="" enctype="multipart/form-data">
              <input type="file" id="imgInput" accept="image/*" name="pfp" onchange="this.form.submit();"> 
              </form>
            </div>

            <form action="" method="post">
    
              <div class="inputbox">
                <img src="./img/icons/user_01.png" class="icone" alt="user">
                <input type="identifiant" placeholder="Identifiant" name="username_login" id="identifiant" value="<?php echo $_SESSION["user"]; ?>">
              </div>
    
              <div class="inputbox">
                <img src="./img/icons/lock.png" class="icone" alt="lock">
                <input type="password" placeholder="Mot de passe" name="password_login" class="password" id="password">
                <img src="./img/icons/hide.png" class="toggle-eye" alt="hide">
              </div>
              <?php
               if(isset($_POST["update"])){
                  if($update){
                    echo '<label name="problem_input" class="danger-color">Update successful</label>';
                  }
                  else
                  {
                    echo '<label name="problem_input" class="danger-color">Update failed</label>';
                  }
               }
              ?>
              <button type="submit" name="update" class="submit_button warn pointer">Update</button>
    
            </form>
          </div>
        
          <div id="boutons_bas">
          <form method="get" action="." ><button class="bouton_danger danger pointer" name="delete" value="true">Suppression</button></form> <!-- TODO -->
            <form method="get" action="." ><button class="bouton_danger danger pointer" name="disconnect" value="true">Déconnexion</button></form>
          </div>

        </div>

        <!-- FRIENDS -->

         <div id="friends" class="profile-page hidden">
          <img src="./img/pfp/duh.png" alt="duh" id="pp_preview_edit">
          <h1>coming soon</h1>
         </div>

         <!-- STATS -->

         <div id="stats" class="profile-page hidden">
          <div id="account">
            <img src="./img/pfp/default_pfp.jpg" alt="pfp" id="pp_stats"> <!-- importer pp du compte ici -->
            <h2 class="identifiant" id="id_stats">John Doe</h2>  <!-- importer le nom du compte ici -->
          </div>
          <div id="stats_container">
            <div id="stats_box">
              <ul>
                <li class="stat">
                  <div class="icon_stat_containner">
                    <img src="./img/icons/cake.png" alt="cake">
                  </div>
                  <span class="txt_stat">À rejoint le : <span id="date_join" class="blanc">failed to load</span></span>
                </li>
                <li class="stat">
                  <div class="icon_stat_containner">
                    <img src="./img/icons/play.png" alt="play">
                  </div>
                  <span class="txt_stat">Parties Jouées : <span id="nb_parties" class="blanc">failed to load</span></span>
                </li>
                <li class="stat">
                  <div class="icon_stat_containner">
                    <img src="./img/icons/stonks.png" alt="win">
                  </div>
                  <span class="txt_stat">Victoires : <span id="nb_victoires" class="vert">failed to load</span></span>
                </li>
                <li class="stat">
                  <div class="icon_stat_containner">
                    <img src="./img/icons/not_stonks.png" alt="loose">
                  </div>
                  <span class="txt_stat">Défaites : <span id="nb_défaites" class="rouge">failed to load</span></span>
                </li>
                <li id="ratio">
                  <div id="txt_ratio">
                    <span class="vert txt_percent"><img src="./img/icons/ratio_plus.svg"><span id="percent_w">failed to load</span> %</span>
                    <span class="rouge txt_percent"><img src="./img/icons/ratio_moins.svg"><span id="percent_l">failed to load</span> %</span>
                  </div>
                  <div id="ratio_bar">
                    <div id="victory_bar"></div>
                    <div id="defeat_bar"></div>
                  </div>
                </li>

              </ul>
            </div>
          </div>
         </div>
      </div>

    </div>

  </main>

  <img src="./img/gear.svg" alt="gear" class="gear gear_profile">

</body>
</html>
