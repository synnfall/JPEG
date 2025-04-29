<?php
include_once __DIR__."/../../CRUD/crud_utilisateurs.php";

function change_name_and_passwd($conn, $name, $passwd)
{
    return update_user($conn, $_SESSION["UserID"], $name, $passwd, $_SESSION["lienPdp"]);
}