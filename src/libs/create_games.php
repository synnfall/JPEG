<?php
include_once __DIR__."/../CRUD/crud_Pierre-feuille-ciseaux.php";
include_once __DIR__."/../CRUD/crud_parties.php";

function create_games($conn, $userID1, $userID2, $gameID, $db_name)
{
    $p_id = select_partie_by_name($conn, $userID1)["idPartie"];
    switch ($gameID) {
        case 3:
            create_pfc_games($conn, $p_id, $db_name);
            break;
    }
}