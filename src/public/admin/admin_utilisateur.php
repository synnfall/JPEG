<?php
include_once(__DIR__."/../../db/db_connect.php");
include(__DIR__."/../../CRUD/crud_utilisateurs.php");
include(__DIR__."/vue_admin_utilisateur.php");

// Pagination & recherche
$page = isset($_GET["page"]) ? intval($_GET["page"]) : 1;
$per_page = 10;
$offset = ($page - 1) * $per_page;
$search = isset($_GET["search"]) ? trim($_GET["search"]) : "";

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

// Gestion actions POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
    <!-- <link rel="stylesheet" href="../style/global.css"> -->
    <link rel="stylesheet" href="../style/admin.css">
</head>
<body>
<h1>Administration des utilisateurs</h1>

<!-- Formulaire de recherche -->
<form method="GET" action="admin_utilisateur.php">
    <input type="text" name="search" placeholder="Recherche par identifiant" value="<?= htmlspecialchars($search) ?>">
    <button type="submit">Rechercher</button>
</form>

<!-- Lien ajout utilisateur -->
<p><a href="admin_utilisateur.php?action=create&UserID=0">Ajouter un utilisateur</a></p>

<!-- Tableau utilisateurs -->
<?php
echo html_table_utilisateur($utilisateurs);

// Pagination si pas en recherche
if (empty($search)) {
    echo "<div class='pagination'>";
    for ($i = 1; $i <= $total_pages; $i++) {
        echo "<a href='admin_utilisateur.php?page=$i'>$i</a>";
    }
    echo "</div>";
}
?>
</body>
</html>
