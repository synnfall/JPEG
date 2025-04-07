<?php



// Créer un  avec isAdmin = 0
function create_historique($conn, $jeux_id, $id_j1, $id_j2, $gagnant) {
    

    // Prépare la requet SQL
    $sql = "INSERT INTO historique (ID_Jeux, ID_J1, ID_J2, gagnant) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        echo "Erreur de préparation : " . mysqli_error($conn);
        return false;
    }

    // Rajoute les param a la requete préparé 
    mysqli_stmt_bind_param($stmt, "iiis", $jeux_id, $id_j1, $id_j2, $gagnant);
    
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return $result;
}


// Met à jour les données du classment 
function update_historique($conn, $historique_id, $jeux_id, $id_j1, $id_j2, $gagnant) {



    $sql = "UPDATE historique SET ID_Jeux=?, ID_J1=?, ID_J2=?, gagnant=? WHERE ID=$?;";
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

// Supprime une place du historique 
function delete_historique($conn, $historique_id) { 


    $sql = "DELETE FROM historique WHERE id=$?;";

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

// Récupère un utilisateur
function get_historique($conn, $historique_id) {
    $sql = "SELECT * FROM historique WHERE Id=$?;";
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
