<?php
include_once __DIR__."/../../db/db_connect.php";
include_once __DIR__."/../../API/queue.php";

header('Content-Type: application/json; charset=utf-8');

if(! (isset($_GET["token"]) && isset($_GET["userID"])) )
{
    $to_echo = [
        "error" => true,
        "action" => null
    ];
    echo json_encode($to_echo);
    exit;
}


$partie = est_en_partie($conn, $_GET["userID"]);
if($partie)
{
    $to_echo = [
        "error" => false,
        "action" => "red",
        "red" => "games/".name_games($conn, $partie),
        "get" => select_partie_by_name($conn, $_GET["userID"])["idPartie"]
    ];
    echo json_encode($to_echo);
    exit;
}

$queue = est_dans_queue($conn, $_GET["token"]);

if($queue["userID"]=$_GET["userID"])
{
    update_queue($conn, $_GET["token"]);
    $other_player = select_user_by_games($conn, $_GET["ID_Jeux"], $_GET["userID"]);
    if($other_player)
    {
        create_party($conn, $other_player["userID"], $_GET["userID"], $_GET["ID_Jeux"], $db_name);
    }
    $to_echo = [
        "error" => false,
        "action" => null,
    ];
    echo json_encode($to_echo);
    exit;
}

$to_echo = [
    "error" => true,
    "action" => null
];
echo json_encode($to_echo);
exit;