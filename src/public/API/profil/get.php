<?php



include_once __DIR__ . '/../../../API/profil/get.php';
include_once __DIR__ . '/../../../db/db_connect.php';
include_once __DIR__ . '/../../../libs/session.php';

header('Content-Type: application/json');


echo get_utilisateur($conn, $_SESSION['UserID']);

echo 'Voir test sur le serv ';
