<?php
 include_once __DIR__ . '/../CRUD/crud_jeux.php'; 
 include_once __DIR__ . '/../CRUD/crud_jeuxlike.php'; 


function verif_id_jeux_valide($conn, $JeuxID){
    $jeux = select_all_games($conn);

    foreach ($jeux as $game) {
        if ($game['ID'] == $JeuxID) {
            return true; 

        }
    }
    return false;
}
 function verif_pas_encore_like($conn, $UserID, $JeuxID) {

    $likes = get_LikeJeux_user($conn, $UserID);
    foreach ($likes as $like) {
        if ($like["ID"] == $JeuxID) {
            return false;
            
        }
    }   
    return true;
}


function add_likes($conn, $UserID, $JeuxID){

    if (verif_id_jeux_valide($conn, $JeuxID)) {
        return json_encode(["result" => false, "message" => "l'id de jeux n'est pas valide"]);
    }


    if (verif_pas_encore_like($conn, $UserID, $JeuxID)) {
        $info_jeux = get_jeux($conn, $JeuxID);
        $nb_likes = $info_jeux["nbLikes"] + 1; 
        create_LikeJeux($conn, $JeuxID, $UserID);

        update_jeux($conn, $JeuxID, $info_jeux["nomJeux"], $nb_likes );
        return json_encode(["result" => true, "message" => "Votre like a bien été rajouté au jeu"]); 
    }
    else {

        return json_encode(["result" => false, "message" => "Vous avez deja like ce jeu"]);
    }
    
}