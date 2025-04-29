<?php

include_once __DIR__ . '/../../../API/profil/get.php';
include_once __DIR__ . '/../../../db/db_connect.php';

header('Content-Type: application/json');


if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {
    $id = (int)$_GET['id'];
    echo get_utilisateur($conn, $id);
    
} else {
    http_response_code(400); 
    echo json_encode(["error" => "ID invalide"]);
}

