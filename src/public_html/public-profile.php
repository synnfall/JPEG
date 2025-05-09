<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile</title>

  <link rel="stylesheet" href="./style/global.css">
  <link rel="stylesheet" href="./style/public-profile.css">

  <script defer async src="./scripts/public-profile.js"></script>
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
          <?php if($connected && $_SESSION["admin"]) echo '<li class="admin"><a href="./admin/admin_utilisateur.php">Admin</a></li>'; ?>
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
          <li class="pointer warn bouton_courant" id="stats_button"><img src="./img/icons/stats.png"></li>
          <li class="pointer warn" id="friends_button"><img src="./img/icons/users.png"></li>
          <div id="cursor_triangle"></div>
        </ul>
      </div>

      <!-- PAGES -->
      <div id="update_page" class="">
      

        <!-- FRIENDS -->

         <div id="friends" class="profile-page hidden">
          <img src="./img/pfp/duh.png" alt="duh" id="pp_preview_edit">
          <h1>coming soon</h1>
         </div>

         <!-- STATS -->

         <div id="stats" class="profile-page">
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
