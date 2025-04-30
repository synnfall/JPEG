<?php



include_once(__DIR__."/../../db/db_connect.php");
include_once(__DIR__."/../../libs/session.php");
include_once(__DIR__."/../../CRUD/crud_utilisateurs.php");
include_once(__DIR__."/../../vue/vue_admin_utilisateur.php");
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// verification ADMIN
if (!$_SESSION["admin"]) {
    header("Location: ../login.php");
}


// Pagination & recherche
$page = isset($_GET["page"]) ? intval($_GET["page"]) : 1;
$per_page = 10;
$offset = ($page - 1) * $per_page;
$search = isset($_GET["search"]) ? trim($_GET["search"]) : "";

// Gestion actions POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die("Erreur CSRF : requête non autorisée.");
    }
    
    $action = $_POST["action"];
    $id = $_POST["UserID"];
    $identifiant = $_POST["identifiant"];
    $mdp = $_POST["mdp"];
    $lienPdp = $_POST["lienPdp"];

    if ($action == "update") {
        update_user($conn, $id, $identifiant, $mdp, $lienPdp);
    } elseif ($action == "create") {
        create_user($conn, $identifiant, $mdp, $lienPdp);
    }
}

// Récupération utilisateurs (recherche ou pagination)
if (!empty($search)) {
    $utilisateurs = search_users($conn, $search);
} else {
    $utilisateurs = get_users_paginated($conn, $offset, $per_page);
    $total_users = get_users_count($conn);
    $total_pages = ceil($total_users / $per_page);
}
?>

<html>
<head>
    <link rel="stylesheet" href="../style/global.css">
    <link rel="stylesheet" href="../style/admin.css">
</head>
<body>
    <!-- NAVBAR -->
     <!-- marche sur le serv hein -->
    <nav>
        <ul id="navbar">
            <li><a href="../">JPEG</a></li>
            <li><a href="../jeux.php">Jeux</a></li>
            <li><a href="../classements.php">Classement</a></li>
        </ul>
        <ul id="userbar">
            <?php if($_SESSION["admin"]) echo '<li class="admin active"><a href="./admin_utilisateur.php">Admin Utilisateurs</a></li>'; ?> <!-- a faire apparaitre si admin -->            
            <?php if($_SESSION["admin"]) echo '<li class="admin"><a href="./admin_jeux.php">Admin Jeux</a></li>'; ?>
            <?php if($connected) echo '<li class="profil"><a href="">Profil</a></li>'; ?> <!-- à faire disparaitre si non connecté -->
            <?php if($connected) echo '<li class="username">'.$_SESSION["user"].'</li><li class="pfp"><a style="padding:0;" href="../private-profile.php"><img src="../'.$_SESSION['lienPdp'].'" alt="pfp"></a></li>'; ?>  <!--importer pp avec fonction php (si connecté) -->
        </ul>
    </nav>
    <main>
        <div class="adminTitre">
            <h1>Administration des utilisateurs</h1>
            
            <!-- Formulaire de recherche -->
            <form method="GET" action="admin_utilisateur.php">
                <input type="text" name="search" placeholder="Recherche par identifiant" value="<?= htmlspecialchars($search) ?>">
                <button type="submit">Rechercher</button>
            </form>
            
            <!-- Lien ajout utilisateur -->
            <p>
                <a href="admin_utilisateur.php?action=create&UserID=0">
                    Ajouter un utilisateur
                </a>
            </p>
        </div>
        <div class="adminTable">
            <!-- Tableau utilisateurs -->
            <?php
            echo html_table_utilisateur($utilisateurs);

            // Pagination si pas en recherche
            if (empty($search)) {
                echo "<div class='pagination'>";
                for ($i = 1; $i <= $total_pages; $i++) {
                    if ($page == $i) {
                        echo "<a href='admin_utilisateur.php?page=$i' class='active'>$i</a>";
                    } else {
                        echo "<a href='admin_utilisateur.php?page=$i'>$i</a>";
                    }
                }
                echo "</div>";
            }
            ?>
        </div>
        <div class="adminForms">
            <?php
            // Gestion actions GET
            if (isset($_GET["action"]) && isset($_GET["UserID"])) {
                $action = $_GET["action"];
                $id = $_GET["UserID"];

                if ($action == "update") {
                    $utilisateur = get_user($conn, $id)[0];
                    echo html_form_maj($utilisateur);
                } elseif ($action == "create") {
                    echo html_form_create();
                } elseif ($action == "delete") {
                    delete_user($conn, $id);
                }
            }
            ?>
        </div>
    </main>
</body>
</html>
