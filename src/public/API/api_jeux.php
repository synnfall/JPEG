<?php

include __DIR__."/../../API/games.php";
$lst_games = lst_games_api($conn);

header('Content-Type: application/json; charset=utf-8');

echo json_encode($lst_games);