<?php 
include_once __DIR__."/../../../db/db_connect.php";
include_once __DIR__."/../../../API/games/pfc.php";

header('Content-Type: application/json; charset=utf-8');
if(! (isset($_GET["token"]) && isset($_GET["action"]) && $_GET["idPartie"])){
    $to_echo = [
        "error" => true
    ];
    echo json_encode($to_echo);
    exit;
}

$idPartie = $_GET["idPartie"];
update_partie_pfc($conn, $idPartie);

$fin = est_partie_fini_pfc($conn,$idPartie);
if($fin)
{
    $to_echo = [
        "error" => false,
        "action" => "red",
        "red" => "../win-loose.php?id_p=".$idPartie
    ];
    echo json_encode($to_echo);
    exit;
}

if($_GET["action"]=="load"){
    $to_echo = [
        "error" => false,
        "action" => "info",
        "time" => get_time_pfc($conn, $idPartie),
        "score" => get_score_pfc($conn, $idPartie),
        "est_player2" => est_joueur2($conn, $token, $ID_partie)
    ];
    echo json_encode($to_echo);
    exit;
}

if(est_periode_choix($conn, $idPartie))
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

if(est_periode_tricher($conn, $idPartie))
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

if(est_periode_res($conn, $idPartie))
{
    if($_GET["action"]=="choix_adv"){
        $to_echo = [
            "error" => false,
            "action" => "choix_adv",
            "choix_adv" => get_choix_adv($conn, $idPartie, $token)
        ];
        echo json_encode($to_echo);
        exit;
    }
    elseif($_GET["action"]=="cheatsus"){
        $to_echo = [
            "error" => false,
            "action" => "cheatsus",
            "cheatsus" => cheat_sus_pfc($conn, $idPartie, $token)
        ];
        echo json_encode($to_echo);
        exit;
    }
    else{
        $to_echo = [
            "error" => false,
            "action" => "res",
            "time" => get_time_pfc($conn, $idPartie),
            "score" => get_score_pfc($conn, $idPartie)

        ];
        echo json_encode($to_echo);
        exit;
    }
}