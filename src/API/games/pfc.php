<?php
include_once __DIR__."/../../CRUD/crud_parties.php";
include_once __DIR__."/../../CRUD/crud_Pierre-feuille-ciseaux.php";
include_once __DIR__."/../../CRUD/crud_historique.php";
include_once __DIR__."/../../CRUD/crud_classement.php";

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
    if(get_historique($conn, $idPartie)) return  true;
    $score = get_score_pfc($conn, $idPartie);
    if($score[0] >= 3 || $score[1] >= 3){
        delete_partie($conn, $idPartie);
        $partie = select_partie_by_id($conn, $idPartie);
        $id_j1 = $partie["IDUser1"];
        $id_j2 = $partie["IDUser2"];
        if($score[0] >= 3){
            create_historique($conn,$idPartie, 3, $id_j1, $id_j2, $id_j1);
            create_classement($conn, 3, $id_j1, 50);
            return true;
        }
        else{
            create_historique($conn,$idPartie, 3, $id_j1, $id_j2, $id_j2);
            return create_classement($conn, 3, $id_j2, 50);
            return true;
        }
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
    if(est_joueur1($conn, $token, $idPartie)){
        return select_coupj1_cheat($conn, $idPartie);
    }
    elseif(est_joueur2($conn, $token, $idPartie)){
        return select_coupj2_cheat($conn, $idPartie);
    }
    return false;
}

function est_periode_choix($conn, $idPartie){
    $temps = new DateTime(select_last_coup_pfc($conn, $idPartie)["date"]);
    $now = new DateTime();
    $diff_seconds = $now->getTimestamp() - $temps->getTimestamp();
    return $diff_seconds < 13;
}

function est_periode_tricher($conn, $idPartie){
    $temps = new DateTime(select_last_coup_pfc($conn, $idPartie)["date"]);
    $now = new DateTime();
    $diff_seconds = $now->getTimestamp() - $temps->getTimestamp();
    return $diff_seconds >= 13 && $diff_seconds < 20;
}

function est_periode_res($conn, $idPartie){
    $temps = new DateTime(select_last_coup_pfc($conn, $idPartie)["date"]);
    $now = new DateTime();
    $diff_seconds = $now->getTimestamp() - $temps->getTimestamp();
    return $diff_seconds >= 20 && $diff_seconds < 25;
}

function cheat_sus_pfc($conn, $idPartie, $token){
    $gagnant = null;
    $partie = select_partie_by_id($conn, $idPartie);
    $id_j1 = $partie["IDUser1"];
    $id_j2 = $partie["IDUser2"];

    if(est_joueur1($conn, $token, $idPartie)){
        if(joueur_2_a_cheat_pfc($conn, $idPartie)){
            $gagnant = $id_j1;
        }
    }
    elseif(est_joueur2($conn, $token, $idPartie)){
        if(joueur_1_a_cheat_pfc($conn, $idPartie)){
            $gagnant = $id_j2;
        }
    }
    if($gagnant){
        delete_partie($conn, $idPartie);
        create_historique($conn,$idPartie, 3, $id_j1, $id_j2, $gagnant);
        create_classement($conn, 3, $gagnant, 50);
        return true;
    }
}

function get_choix_adv($conn, $idPartie, $token){
    if(est_joueur1($conn, $token, $idPartie)){
        return select_coupj2($conn, $idPartie);
    }
    elseif(est_joueur2($conn, $token, $idPartie)){
        return select_coupj1($conn, $idPartie);
    }
    return false;
}