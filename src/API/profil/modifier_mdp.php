<?php
include_once __DIR__ . '/../../CRUD/crud_utilisateurs.php'; 

function modifierMotDePasse($conn, $userId, $ancienMdp, $nouveauMdp) {

    
    $user = get_user($conn, $userId);
    if (!$user || !password_verify($ancienMdp, $user['mdp'])) {
        http_response_code(401);
        echo json_encode(["success" => false, "message" => "Mot de passe actuel incorrect"]);
        exit;
    }

    update_user($conn, $userId, $user['identifiant'], $nouveauMdp, $user['lienPdp']); 

    echo json_encode(["success" => true, "message" => "Mot de passe modifié"]);

}
