<?php

include_once __DIR__."/../API/queue.php";

function handle_queue($conn){
    $partie = est_en_partie($conn, $_SESSION["UserID"]);
    if($partie)
    {
        header("Location: games/".name_games($conn, $partie).".php"."?idPartie=".select_partie_by_name($conn, $_SESSION["UserID"])["idPartie"]);
        exit;
    }
    delete_queue($conn, $_SESSION["UserID"]);
    return create_queue($conn, $_SESSION["UserID"], $_GET["ID_Jeux"]);
}