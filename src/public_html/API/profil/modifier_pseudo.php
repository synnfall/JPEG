<?php
include_once __DIR__ . '/../../../API/profil/modifier_mdp.php';
include_once __DIR__ . '/../../../db/db_connect.php';
include_once __DIR__ . '/../../../libs/session.php';

header('Content-Type: application/json');


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["error" => "Méthode non autorisée"]);
    exit;
}

if (!isset($_SESSION['UserID'])) {
    http_response_code(401);
    echo json_encode(["error" => "Non connecté"]);
    exit;
}


// Récupérer les données POST
$ancien = $_POST['ancien_mdp'] ?? null;
$nouveau = $_POST['nouveau_mdp'] ?? null;

if (!$ancien || !$nouveau) {
    http_response_code(400);
    echo json_encode(["error" => "Champs manquants"]);
    exit;
}


modifierMotDePasse($conn,$_SESSION['UserID'], $ancien, $nouveau);
