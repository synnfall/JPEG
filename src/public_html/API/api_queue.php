<?php
include_once __DIR__."/../../db/db_connect.php";
include_once __DIR__."/../../API/queue.php";

header('Content-Type: application/json; charset=utf-8');

if(! (isset($_GET["token"]) && isset($_GET["userID"])) )
{
    $to_echo = [
        "error" => true,
        "post" => $_GET
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
        "red" => "games/".name_games($conn, $partie)
    ];
    echo json_encode($to_echo);
    exit;
}

$queue = est_dans_queue($conn, $_GET["token"]);

if($queue["userID"]=$_GET["userID"])
{
    update_queue($conn, $_GET["token"]);
    
    $to_echo = [
        "error" => false,
        "action" => select_user_by_games($conn, $_GET["ID_Jeux"], $_GET["userID"])
    ];
    echo json_encode($to_echo);
    exit;
}

$to_echo = [
    "error" => true,
    "1" => $queue 
];
echo json_encode($to_echo);
exit;