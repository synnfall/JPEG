<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once(__DIR__."/../../db/db_connect.php");
include_once(__DIR__."/../../libs/session.php");
include_once(__DIR__."/../../CRUD/crud_jeux.php");
include(__DIR__."/../../vue/vue_admin_jeux.php");

if (!$_SESSION["admin"]) {
    header("Location: ../login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    if ($action == 'create') {
        create_jeux($conn, $_POST['nom'], $_POST['likes'], $_POST['description']);
    } elseif ($action == 'update') {
        update_jeux($conn, $_POST['JeuID'], $_POST['nom'], $_POST['likes'], $_POST['description']);
    }
}

if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['JeuID'])) {
    delete_jeux($conn, $_GET['JeuID']);
}

$jeux = select_all_games($conn);
?>

<html>
<head>
    <link rel="stylesheet" href="../style/global.css">
    <link rel="stylesheet" href="../style/admin.css">
</head>
<body>
<nav>
        <ul id="navbar">
            <li><a href="../">JPEG</a></li>
            <li><a href="../jeux.php">Jeux</a></li>
            <li><a href="../classements.php">Classement</a></li>
        </ul>
        <ul id="userbar">
            <?php if($_SESSION["admin"]) echo '<li class="admin"><a href="./admin_utilisateur.php">Admin Utilisateurs</a></li>'; ?> <!-- a faire apparaitre si admin -->            
            <?php if($_SESSION["admin"]) echo '<li class="admin active"><a href="./admin_jeux.php">Admin Jeux</a></li>'; ?>        
            <?php if($connected) echo '<li class="profil"><a href="">Profil</a></li>'; ?> <!-- à faire disparaitre si non connecté -->
            <?php if($connected) echo '<li class="username">'.$_SESSION["user"].'</li><li class="pfp"><a style="padding:0;" href="../private-profile.php"><img src="../'.$_SESSION['lienPdp'].'" alt="pfp"></a></li>'; ?>  <!--importer pp avec fonction php (si connecté) -->
        </ul>
    </nav>

    <main>
    <div class="adminTitre">
        <h1>Administration des jeux</h1>
        <p>
        <a href="admin_jeux.php?action=create">Ajouter un jeu</a>
        </p>
    </div>
    <div class="adminTable">
        <?= html_table_jeux($jeux) ?>
    </div>
    <div class="adminForms">

    
        <?php
        if (isset($_GET['action'])) {
            if ($_GET['action'] === 'create') {
                echo html_form_create_jeu();
            } elseif ($_GET['action'] === 'update' && isset($_GET['JeuID'])) {
                $jeu = get_jeux($conn, $_GET['JeuID']);
                echo html_form_update_jeu($jeu);
            }
        }
        ?>
        </div>
    </main>
</body>
</html>
