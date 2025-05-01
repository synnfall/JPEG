<?php



// Créer un  historique
function create_historique($conn,$ID_p, $jeux_id, $id_j1, $id_j2, $gagnant) {
    

    // Prépare la requet SQL
    $sql = "INSERT INTO `Historique` (ID,ID_Jeux, ID_J1, ID_J2, gagnant) VALUES (?,?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        echo "Erreur de préparation : " . mysqli_error($conn);
        return false;
    }

    // Rajoute les param a la requete préparé 
    mysqli_stmt_bind_param($stmt, "iiiis", $ID_p, $jeux_id, $id_j1, $id_j2, $gagnant);
    
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return $result;
}


// Met à jour les données de l'historique 
function update_historique($conn, $historique_id, $jeux_id, $id_j1, $id_j2, $gagnant) {



    $sql = "UPDATE `Historique` SET ID_Jeux=?, ID_J1=?, ID_J2=?, gagnant=? WHERE ID=?;";
    $stmt = mysqli_prepare($conn, $sql);    

    if (!$stmt) {
        echo "Erreur de préparation : " . mysqli_error($conn);
        return false;
    }

    mysqli_stmt_bind_param($stmt, "iiisi", $jeux_id, $id_j1, $id_j2, $gagnant, $historique_id);

    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $result;

    
}

// Supprime un histoorique par id
function delete_historique($conn, $historique_id) { 


    $sql = "DELETE FROM `Historique` WHERE ID=?;";

    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        echo "". mysqli_error($conn);
        return false;
    }

    mysqli_stmt_bind_param($stmt, "i", $historique_id);
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return $result;
}

// Récupère un historique 
function get_historique($conn, $historique_id) {
    $sql = "SELECT * FROM `Historique` WHERE ID=?;";
    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        echo "". mysqli_error($conn);
        return false;   
    }
    mysqli_stmt_bind_param($stmt, "i",$historique_id);


    // execute la requete 
    mysqli_stmt_execute($stmt);
    // recupere les resultats de la requete
    $result = mysqli_stmt_get_result($stmt);

    mysqli_stmt_close($stmt);   

    if ($result) {
        return mysqli_fetch_assoc($result);
    }
    return null;
}




?>
