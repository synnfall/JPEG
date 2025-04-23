<?php
include_once __DIR__ . '/../../CRUD/crud_utilisateurs.php'; 

function modifierPseudo($conn, $userId, $nouveauPseudo) {

    $user = get_user($conn, $userId);
   

    update_user($conn, $userId, $nouveauPseudo, $user["mdp"], $user['lienPdp']); 

    echo json_encode(["success" => true, "message" => "Pseudo Modifie"]);


}
