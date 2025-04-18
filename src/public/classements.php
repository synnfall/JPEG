<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>JPEG - Classements</title>

  <link rel="stylesheet" href="./style/global.css">
  <link rel="stylesheet" href="./style/classements.css">
</head>
<body>
  <!-- NAVBAR -->
  <nav>
    <ul id="navbar">
      <li ><a href="./">JPEG</a></li>
      <li><a href="">Jeux</a></li>
      <li class="active"><a href="">Classement</a></li>
    </ul>
    <ul id="userbar">
      <?php if($connected && $_SESSION["admin"]) echo '<li class="admin"><a href="./admin/admin_utilisateur.php">Admin</a></li>'; ?> a faire apparaitre si admin
      <?php if($connected) echo '<li class="profil"><a href="">Profil</a></li>'; ?> à faire disparaitre si non connecté
      <?php if( ! $connected) echo '<li class="login"><a href="login.php">log in</a></li>'; ?> à faire disparaitre si connecté
      <?php if($connected) echo '<li class="username">'.$_SESSION["user"].'</li><li class="pfp"><img src="'.$_SESSION['lienPdp'].'" alt="pfp"></li>'; ?> importer pp avec fonction php (si connecté)
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
        <div class="jeux" id="1">
            <h3>Nom jeux</h3>
            <a href="#lien_page_jeux">voir le jeux</a>
            <table>
                <thead>
                    <th>Joueur</th>
                    <th>Rang</th>
                    <th>Points</th>
                </thead>
                <tbody>
                    <tr>
                        <td>Aline</td>
                        <td>1</td>
                        <td>1234</td>
                    </tr>
                    <tr>
                        <td>Bounci</td>
                        <td>2</td>
                        <td>1233</td>
                    </tr>
                    <tr>
                        <td>Teva</td>
                        <td>3</td>
                        <td>1130</td>
                    </tr>
                    <tr>
                        <td>Teva</td>
                        <td>3</td>
                        <td>1130</td>
                    </tr>
                    <tr>
                        <td>Teva</td>
                        <td>3</td>
                        <td>1130</td>
                    </tr>
                    <tr>
                        <td>Teva</td>
                        <td>3</td>
                        <td>1130</td>
                    </tr>
                    <tr>
                        <td>Teva</td>
                        <td>3</td>
                        <td>1130</td>
                    </tr>
                    <tr>
                        <td>Teva</td>
                        <td>3</td>
                        <td>1130</td>
                    </tr>
                    <tr>
                        <td>Teva</td>
                        <td>3</td>
                        <td>1130</td>
                    </tr>
                    <tr>
                        <td>Teva</td>
                        <td>3</td>
                        <td>1130</td>
                    </tr>
                    <tr>
                        <td>Teva</td>
                        <td>3</td>
                        <td>1130</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="jeux" id="2">
            <h3>Nom jeux</h3>
            <a href="#lien_page_jeux">voir le jeux</a>
            <table>
                <thead>
                    <th>Joueur</th>
                    <th>Rang</th>
                    <th>Points</th>
                </thead>
                <tbody>
                    <tr>
                        <td>Aline</td>
                        <td>1</td>
                        <td>1234</td>
                    </tr>
                    <tr>
                        <td>Bounci</td>
                        <td>2</td>
                        <td>1233</td>
                    </tr>
                    <tr>
                        <td>Teva</td>
                        <td>3</td>
                        <td>1130</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <img src="./img/gear.svg" alt="gear" class="gear gear3 gear2"> <!-- gear2 change le sens ici -->
    <img src="./img/gear.svg" alt="gear" class="gear gear4">
  </main>

  <!-- FOOTER -->
  <footer>
    
  </footer>
</body>
</html>
