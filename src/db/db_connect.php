<?php
include "db_param.php";

$conn = mysqli_connect($hosts, $user,$passwd, $db_name);

if(!$conn)
{
    echo "pas de bol la connexion a échoué";
    exit();
}

mysqli_set_charset($conn, "utf8");