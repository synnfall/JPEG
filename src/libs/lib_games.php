<?php
include_once __DIR__."/../CRUD/crud_utilisateurs.php";
$token = select_token_by_userid($conn, $_SESSION['UserID']);
$other_id = get_id_other_users($conn,  $_SESSION['UserID']);
if ($other_id){
    $avd = get_user($conn, $other_id);
}