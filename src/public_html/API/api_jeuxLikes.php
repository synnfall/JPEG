<?php

include_once __DIR__ . '/../../API/jeuxLike.php';
include_once __DIR__ . '/../../db/db_connect.php';
include_once __DIR__ . '/../../libs/session.php';


$JeuxID = intval($_POST['id_jeux']);
$UserID = $_SESSION["UserID"];

$result = add_likes($conn, $UserID, $JeuxID);
header('Content-Type: application/json');
echo $result; 