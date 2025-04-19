<?php

include_once __DIR__."/../../db/db_connect.php";
include __DIR__."/../../API/classement.php";
include __DIR__."/../../API/games.php";
$lst_games = lst_games_api($conn);

$to_echo = [
];

foreach ($lst_games as $key => $value) {
    $cl_games = get_classment__by_games_name_api($conn, $value["nomJeux"]);
    if($cl_games)
    {
        $to_echo[] = [
            "nomJeux" => $value["nomJeux"],
            "classement" => $cl_games
        ];
    }
}
header('Content-Type: application/json; charset=utf-8');

echo json_encode($to_echo);