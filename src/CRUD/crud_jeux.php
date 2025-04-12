<?php

// Récupère un utilisateur
function select_all_games($conn) {
    $sql = "SELECT * FROM Jeux";
    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        echo "". mysqli_error($conn);
        return false;   
    }

    // execute la requete 
    mysqli_stmt_execute($stmt);
    // recupere les resultats de la requete
    $result = mysqli_stmt_get_result($stmt);

    mysqli_stmt_close($stmt);   

    if ($result) {
        $jeux = [];
        while ($row = mysqli_fetch_assoc($result))
        {
            $jeux[] = $row;
        }
        return $jeux;
    }
    return null;
}

function create_jeux($conn, $nomJeux, $nbLikes = 0) {
    

    // Prépare la requet SQL
    $sql = "INSERT INTO Jeux (nomJeux, nbLikes) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        echo "Erreur de préparation : " . mysqli_error($conn);
        return false;
    }

    // Rajoute les param a la requete préparé 
    mysqli_stmt_bind_param($stmt, "si", $nomJeux, $nbLikes);
    
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return $result;
}


// Met à jour les données du classment 
function update_jeux($conn, $jeux_id, $nomJeux, $nbLikes) {



    $sql = "UPDATE Jeux SET nomJeux=?, nbLikes=? WHERE ID=?;";
    $stmt = mysqli_prepare($conn, $sql);    

    if (!$stmt) {
        echo "Erreur de préparation : " . mysqli_error($conn);
        return false;
    }

    mysqli_stmt_bind_param($stmt, "sii",  $nomJeux, $nbLikes, $jeux_id);

    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $result;

    
}

// Supprime une place du jeux 
function delete_jeux($conn, $jeux_id) { 


    $sql = "DELETE FROM Jeux WHERE ID=?;";

    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        echo "". mysqli_error($conn);
        return false;
    }

    mysqli_stmt_bind_param($stmt, "i", $jeux_id);
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return $result;
}

// Récupère un utilisateur
function get_jeux($conn, $jeux_id) {
    $sql = "SELECT * FROM Jeux WHERE ID=$?;";
    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        echo "". mysqli_error($conn);
        return false;   
    }
    mysqli_stmt_bind_param($stmt, "i",$jeux_id);


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