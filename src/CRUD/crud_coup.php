<?php



// Créer un coup 
function create_coup($conn, $jeux_id, $user_id, $points) {
    

    // Prépare la requet SQL
    $sql = "INSERT INTO coup (ID_Jeux, ID_User, pts) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        echo "Erreur de préparation : " . mysqli_error($conn);
        return false;
    }

    // Rajoute les param a la requete préparé 
    mysqli_stmt_bind_param($stmt, "ssi", $jeux_id, $userd_id, $points);
    
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return $result;
}


// Met à jour les données du coup 
function update_coup($conn, $coup_id, $jeux_id, $user_id, $points) {



    $sql = "UPDATE coup SET ID_Jeux=?, ID_User=?, pts=? WHERE ID=?;";
    $stmt = mysqli_prepare($conn, $sql);    

    if (!$stmt) {
        echo "Erreur de préparation : " . mysqli_error($conn);
        return false;
    }

    mysqli_stmt_bind_param($stmt, "ssii", $jeux_id, $user_id, $points, $coup_id);

    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $result;

    
}

// Supprime une place du coup 
function delete_coup($conn, $coup_id) { 


    $sql = "DELETE FROM coup WHERE ID=?;";

    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        echo "". mysqli_error($conn);
        return false;
    }

    mysqli_stmt_bind_param($stmt, "i", $coup_id);
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return $result;
}

// Récupère un coup 
function get_coup($conn, $coup_id) {
    $sql = "SELECT * FROM coup WHERE ID=?;";
    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        echo "". mysqli_error($conn);
        return false;   
    }
    mysqli_stmt_bind_param($stmt, "i",$coup_id);


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
