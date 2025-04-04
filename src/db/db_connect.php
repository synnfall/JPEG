<?php
include "db_param.php";

$conn = mysqli_connect($hosts, $user,$passwd, $db_name, $port);

if(!$conn)
{
    echo "Même ici tu ne gagne pas ! ( La connexion à la BDD a échoué )";
    exit();
}

mysqli_set_charset($conn, "utf8");