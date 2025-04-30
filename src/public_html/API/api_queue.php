<?php
include_once __DIR__."/../../db/db_connect.php";
include_once __DIR__."/../../API/queue.php";

header('Content-Type: application/json; charset=utf-8');

if(! (isset($_POST["token"]) && isset($_POST["userID"])) )
{
    $to_echo = [
        "error" => true
    ];
    echo json_encode($to_echo);
    exit;
}


$partie = est_en_partie($conn, $_POST["userID"]);
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

$queue = est_dans_queue($conn, $_POST["token"]);

if($queue)
{
    update_queue($conn, $_POST["token"]);
    $to_echo = [
        "error" => false,
        "action" => "wait"
    ];
    echo json_encode($to_echo);
    exit;
}

$to_echo = [
    "error" => true
];
echo json_encode($to_echo);
exit;