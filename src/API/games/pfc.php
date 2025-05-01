<?php
include_once __DIR__."/../../CRUD/crud_parties.php";
include_once __DIR__."/../../CRUD/crud_Pierre-feuille-ciseaux.php";

function update_partie_pfc($conn, $idPartie){
    update_partie($conn, $idPartie);
    if(est_empty_games_pfc($conn, $idPartie)){
        create_empty_coup_pfc($conn, $idPartie);
    }
    else{
        $temps = new DateTime(select_last_coup_pfc($conn, $idPartie)["date"]);
        $now = new DateTime();
        $diff_seconds = $now->getTimestamp() - $temps->getTimestamp();
        if($diff_seconds > 25){
            create_empty_coup_pfc($conn, $idPartie);
        }
    }
}

function est_partie_fini_pfc($conn,$idPartie){
    $score = get_score_pfc($conn, $idPartie);
    if($score[0] >= 3 || $score[1] >= 3){
        return true;
    }
    return false;
}

function get_time_pfc($conn, $idPartie){
    $temps = new DateTime(select_last_coup_pfc($conn, $idPartie)["date"]);
    $now = new DateTime();
    $diff_seconds = $now->getTimestamp() - $temps->getTimestamp();
    return $diff_seconds;
}

function get_score_pfc($conn, $idPartie){
    return get_score_pfc($conn, $idPartie);
}

function choix_pfc($conn, $idPartie, $token, $choix){
    if(est_joueur1($conn, $token, $idPartie)){
        return update_coupj1($conn, $idPartie, $choix);
    }
    elseif(est_joueur2($conn, $token, $idPartie)){
        return update_coupj2($conn, $idPartie, $choix);
    }
    return false;
}

function choix_pfc_cheat($conn, $idPartie, $token, $choix){
    if(est_joueur1($conn, $token, $idPartie)){
        return update_coupj1_cheat($conn, $idPartie, $choix);
    }
    elseif(est_joueur2($conn, $token, $idPartie)){
        return update_coupj2_cheat($conn, $idPartie, $choix);
    }
    return false;
}

function info_pfc_cheat($conn, $idPartie, $token){

}

function est_periode_choix($conn, $idPartie){
    $temps = new DateTime(select_last_coup_pfc($conn, $idPartie)["date"]);
    $now = new DateTime();
    $diff_seconds = $now->getTimestamp() - $temps->getTimestamp();
    return $diff_seconds <= 13;
}

function est_periode_tricher($conn, $idPartie){
    $temps = new DateTime(select_last_coup_pfc($conn, $idPartie)["date"]);
    $now = new DateTime();
    $diff_seconds = $now->getTimestamp() - $temps->getTimestamp();
    return $diff_seconds > 13 && $diff_seconds <= 20;
}

function est_periode_res($conn, $idPartie){
    $temps = new DateTime(select_last_coup_pfc($conn, $idPartie)["date"]);
    $now = new DateTime();
    $diff_seconds = $now->getTimestamp() - $temps->getTimestamp();
    return $diff_seconds > 20 && $diff_seconds < 25;
}

function cheat_sus_pfc($conn, $idPartie, $token){

}