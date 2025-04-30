<?php

function getResultList($result) {
    $list = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $list[] = $row;
    }
    return $list;
}

function create_user($conn, $identifiant, $password, $lien_PDP = "./img/pfp/default_pfp.jpg") {
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $sql = "INSERT INTO Utilisateurs (identifiant, mdp, lienPdp, isAdmin, parties_w, parties_l) VALUES (?, ?, ?, 0, 0, 0)";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        echo "Erreur de préparation : " . mysqli_error($conn);
        return false;
    }

    mysqli_stmt_bind_param($stmt, "sss", $identifiant, $hashed_password, $lien_PDP);
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $result;
}

function update_pfp($conn, $user_id, $lien_PDP) {
    $sql = "UPDATE Utilisateurs SET  `lienPdp` = ? WHERE `UserID` = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        echo "Erreur de préparation : " . mysqli_error($conn);
        return false;
    }

    mysqli_stmt_bind_param($stmt, "si", $lien_PDP, $user_id);
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $result;
}

function update_user($conn, $user_id, $identifiant, $password, $lien_PDP, $parties_w = 0, $parties_l = 0) {
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $sql = "UPDATE Utilisateurs SET identifiant = ?, mdp = ?, lienPdp = ?, parties_w = ?, parties_l = ? WHERE UserID = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        echo "Erreur de préparation : " . mysqli_error($conn);
        return false;
    }

    mysqli_stmt_bind_param($stmt, "sssiii", $identifiant, $hashed_password, $lien_PDP, $parties_w, $parties_l, $user_id);
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $result;
}

function delete_user($conn, $user_id) {
    $sql = "DELETE FROM Utilisateurs WHERE UserID = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        echo "Erreur de préparation : " . mysqli_error($conn);
        return false;
    }

    mysqli_stmt_bind_param($stmt, "i", $user_id);
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $result;
}

function get_user($conn, $user_id) {
    $sql = "SELECT * FROM Utilisateurs WHERE UserID = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        echo "Erreur de préparation : " . mysqli_error($conn);
        return false;
    }

    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    if ($result) {
        return getResultList($result);
    }
    return null;
}

function get_user_by_name($conn, $name) {
    $sql = "SELECT * FROM Utilisateurs WHERE identifiant = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        echo "Erreur de préparation : " . mysqli_error($conn);
        return false;
    }

    mysqli_stmt_bind_param($stmt, "s", $name);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    if ($result) {
        return getResultList($result);
    }
    return null;
}
function get_all_user($conn) {
    $sql = "SELECT * FROM Utilisateurs";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        echo "Erreur lors de la requête : " . mysqli_error($conn);
        return false;
    }

    return getResultList($result);
}



//Rcup les utilisateurs pour la pagination
function get_users_paginated($conn, $offset, $limit) {
    $sql = "SELECT * FROM Utilisateurs LIMIT ?, ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $offset, $limit);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return getResultList($result);
}

// Compte le nombre total d'utilisateurs
function get_users_count($conn) {
    $sql = "SELECT COUNT(*) as total FROM Utilisateurs";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row["total"];
    }
    return 0;
}

// Recherche par identifiant (LIKE)
function search_users($conn, $search) {
    $like = "%" . $search . "%";
    $sql = "SELECT * FROM Utilisateurs WHERE identifiant LIKE ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $like);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return getResultList($result);
}

?>



