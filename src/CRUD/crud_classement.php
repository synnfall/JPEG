<?php


// Créer un classement
function create_classement($conn, $jeux_id, $user_id, $points) {
    

    // Prépare la requet SQL
    $sql = "INSERT INTO Classement (ID_Jeux, ID_User, pts) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        echo "Erreur de préparation : " . mysqli_error($conn);
        return false;
    }

    // Rajoute les param a la requete préparé 
    mysqli_stmt_bind_param($stmt, "ssi", $jeux_id, $user_id, $points);
    
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return $result;
}


// Met à jour les données du classment 
function update_classement($conn, $classement_id, $jeux_id, $user_id, $points) {



    $sql = "UPDATE Classement SET ID_Jeux=?, ID_User=?, pts=? WHERE ID=?;";
    $stmt = mysqli_prepare($conn, $sql);    

    if (!$stmt) {
        echo "Erreur de préparation : " . mysqli_error($conn);
        return false;
    }

    mysqli_stmt_bind_param($stmt, "ssii", $jeux_id, $user_id, $points, $classement_id);

    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $result;

    
}

// Supprime une place du classement 
function delete_classement($conn, $classement_id) { 


    $sql = "DELETE FROM Classement WHERE ID=?;";

    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        echo "". mysqli_error($conn);
        return false;
    }

    mysqli_stmt_bind_param($stmt, "i", $classement_id);
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return $result;
}

// RRécupere une seule partie du classement 
function get_classement($conn, $classement_id) {
    $sql = "SELECT * FROM Classement WHERE ID=?;";
    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        echo "". mysqli_error($conn);
        return false;   
    }
    mysqli_stmt_bind_param($stmt, "i",$classement_id);


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
function get_lst_classement($conn, $nb_joueurs) {
    $sql = "SELECT identifiant as pseudo, lienPdp as lien_pp, SUM(pts) AS points, ID_User as id FROM Classement JOIN Utilisateurs ON ID_User = UserID GROUP BY ID_User ORDER BY points DESC LIMIT ?;";
    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        echo "". mysqli_error($conn);
        return false;   
    }
    mysqli_stmt_bind_param($stmt, "i",$nb_joueurs);


    // execute la requete 
    mysqli_stmt_execute($stmt);
    // recupere les resultats de la requete
    $result = mysqli_stmt_get_result($stmt);

    mysqli_stmt_close($stmt);   

    if ($result) {
        $classements = [];
        while ($row = mysqli_fetch_assoc($result))
        {
            $classements[] = $row;
        }
        return $classements;
    }
    return null;
}

function get_lst_classement_par_jeux($conn, $nom_jeux) {
    $sql = "SELECT identifiant, SUM(pts) as pts FROM Classement JOIN Utilisateurs ON ID_User = UserID JOIN Jeux ON ID_Jeux = Jeux.ID WHERE nomJeux = ? GROUP BY ID_User ORDER BY pts DESC";
    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        echo "". mysqli_error($conn);
        return false;   
    }
    mysqli_stmt_bind_param($stmt, "s",$nom_jeux);


    // execute la requete 
    mysqli_stmt_execute($stmt);
    // recupere les resultats de la requete
    $result = mysqli_stmt_get_result($stmt);

    mysqli_stmt_close($stmt);   

    if ($result) {
        $classements = [];
        while ($row = mysqli_fetch_assoc($result))
        {
            $classements[] = $row;
        }
        return $classements;
    }
    return null;
}


?>
