<?php
include_once __DIR__."/../CRUD/crud_utilisateurs.php";
include_once __DIR__."/../CRUD/crud_historique.php";
if(!isset($_GET["idPartie"]))
{
    header("Location: ../");
    exit;
}
$idPartie = $_GET["idPartie"];
if(get_historique($conn, $idPartie)){
    header("Location: ../win-loose.php?id_p=".$idPartie);
    exit;
}
$token = select_token_by_userid($conn, $_SESSION['UserID']);
$other_id = get_id_other_users($conn,  $_SESSION['UserID']);
if ($other_id){
    $avd = get_user($conn, $other_id);
}