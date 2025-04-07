<?php

include("../db/db_connect.php");

// Créer un utilisateur avec isAdmin = 0
function create_user($conn, $identifiant, $password, $lien_PDP) {
    // Hash du mdp avec BCRYPT
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Prépare la requet SQL
    $sql = "INSERT INTO Utilisateurs (identifiant, mdp, lienPdp, isAdmin) VALUES (?, ?, ?, 0)";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        echo "Erreur de préparation : " . mysqli_error($conn);
        return false;
    }

    // Rajoute les param a la requete préparé 
    mysqli_stmt_bind_param($stmt, "sss", $identifiant, $hashed_password, $lien_PDP);
    
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return $result;
}


// Met à jour les données de l'utilisateur sans modifier son rôle
function update_user($conn, $user_id, $identifiant, $password, $lien_PDP) {

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $sql = "UPDATE Utilisateurs SET identifiant=?, mdp=?, lienPdp=? WHERE UserId=$?;";
    $stmt = mysqli_prepare($conn, $sql);    

    if (!$stmt) {
        echo "Erreur de préparation : " . mysqli_error($conn);
        return false;
    }

    mysqli_stmt_bind_param($stmt, "sssi", $identifiant, $hashed_password, $lien_PDP, $user_id);

    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $result;

    
}

// Supprime un utilisateur
function delete_user($conn, $user_id) { 


    $sql = "DELETE FROM Utilisateurs WHERE id=$?;";

    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        echo "". mysqli_error($conn);
        return false;
    }

    mysqli_stmt_bind_param($stmt, "i", $user_id);
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return $result;
}

// Récupère un utilisateur
function get_user($conn, $user_id) {
    $sql = "SELECT * FROM Utilisateurs WHERE UserId=$?;";
    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        echo "". mysqli_error($conn);
        return false;   
    }
    mysqli_stmt_bind_param($stmt, "i",$user_id);


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



include "../db/db_disconnect";
?>
