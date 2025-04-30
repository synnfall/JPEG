<?php 
include_once __DIR__."/../../../db/db_connect.php";
include_once __DIR__."/../../../API/games/pfc.php";

$fin = est_partie_fini_pfc($conn,$token);
if($fin)
{
    $to_echo = [
        "error" => false,
        "action" => "red",
        "red" => "../win-loose.php"
    ];
    echo json_encode($to_echo);
    exit;
}

$est_periode_choix = null;
$est_periode_tricher = null;
$est_periode_res = null;

if(! (isset($_GET["token"]) && isset($_GET["action"]) && $_GET["idPartie"])){
    $to_echo = [
        "error" => true
    ];
    echo json_encode($to_echo);
    exit;
}

$idPartie = $_GET["idPartie"];

if($_GET["action"]=="load"){
    $to_echo = [
        "error" => false,
        "action" => "info",
        "time" => get_time_pfc($conn, $idPartie),
        "score" => get_score_pfc($conn, $idPartie)
    ];
    echo json_encode($to_echo);
    exit;
}

if($est_periode_choix)
{
    if($_GET["action"]=="choix"){
        $to_echo = [
            "error" => ! choix_pfc($conn, $idPartie, $token, $_GET["choix"]),
            "time" => get_time_pfc($conn, $idPartie)
        ];
        echo json_encode($to_echo);
        exit;
    }
}

if($est_periode_tricher)
{
    if($_GET["action"]=="cheatchoix"){
        $to_echo = [
            "error" => ! choix_pfc_cheat($conn, $idPartie, $token, $_GET["choix"]),
            "time" => get_time_pfc($conn, $idPartie)
        ];
        echo json_encode($to_echo);
        exit;
    }
    if($_GET["action"]=="cheatinfo"){
        $to_echo = [
            "error" => false,
            "action" => "cheatinfo",
            "cheatinfo" => info_pfc_cheat($conn, $idPartie, $token),
            "time" => get_time_pfc($conn, $idPartie)

        ];
        echo json_encode($to_echo);
        exit;
    }
}

if($est_periode_res)
{
    $to_echo = [
        "error" => false,
        "action" => "res",
        "time" => get_time_pfc($conn, $idPartie),
        "score" => get_score_pfc($conn, $idPartie)

    ];
    echo json_encode($to_echo);
    exit;
}