<?php

include_once __DIR__."/../../CRUD/crud_queue.php";
include_once __DIR__."/../../CRUD/crud_parties.php";
include_once __DIR__."/../../CRUD/crud_jeux.php";

clean_queue($conn);


function est_dans_queue($conn, $token){
    return check_joueur_in_queue($conn, $token);;
}

function est_en_partie($conn, $userID)
{
    $partie = select_partie_by_name($conn, $userID);
    if($partie ) return $partie ["gameID"];
    return false;
}

function name_games($conn, $gameID)
{
    $jeux = get_jeux($conn, $gameID);
    if($jeux ) return $jeux["nomJeux"];
    return false;
}