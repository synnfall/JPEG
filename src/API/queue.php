<?php

include_once __DIR__."/../CRUD/crud_queue.php";
include_once __DIR__."/../CRUD/crud_parties.php";
include_once __DIR__."/../CRUD/crud_jeux.php";
include_once __DIR__."/../libs/create_games.php";

clean_queue($conn);


function est_dans_queue($conn, $token){
    return check_joueur_in_queue($conn, $token);;
}

function est_en_partie($conn, $userID)
{
    $partie = select_partie_by_name($conn, $userID);
    if($partie ) return $partie["gameID"];
    return false;
}

function name_games($conn, $gameID)
{
    $jeux = get_jeux($conn, $gameID);
    if($jeux ) return $jeux["nomJeux"];
    return false;
}

function create_party($conn, $userID1, $userID2, $gameID)
{
    create_partie($conn, $gameID, $userID1, $userID2);
    delete_queue($conn, $userID1);
    delete_queue($conn, $userID2);
    create_games($conn, $userID1, $userID2, $gameID);
}