<?php
include_once __DIR__ . '/../../CRUD/crud_utilisateurs.php'; 

function get_utilisateur($conn, $userId) {
    
    $date = date("d/m/Y", strtotime($$_SESSION['dateCreation'] ?? "now"));

    return json_encode(["identifiant" => $_SESSION['identifiant'], "chemin_pfp" => $_SESSION['lienPdp'], "date_join" => $date, "parties_w" => 40, "parties_l" => 21 ]);


}