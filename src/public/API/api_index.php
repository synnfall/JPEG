<?php

include_once __DIR__."/../db/db_connect.php";
include __DIR__."/../../API/classement.php";
include __DIR__."/../../API/games.php";

$lst_cl = get_classment_api($conn);
$lst_games = lst_games_api($conn);

$to_echo = [
    "classements" => $lst_cl,
    "games" => $lst_games,
];

header('Content-Type: application/json; charset=utf-8');

echo json_encode($to_echo);