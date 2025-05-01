<?php

function getResultList_($result) {
    $list = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $list[] = $row;
    }
    return $list;
}

function create_LikeJeux($conn, $JeuxID, $UserID ) {

    $sql = "INSERT INTO LikeJeux (JeuxID, UserID) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        echo "Erreur de préparation : " . mysqli_error($conn);
        return false;
    }

    mysqli_stmt_bind_param($stmt, "ii", $JeuxID, $UserID);
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $result;
}



function update_LikeJeux($conn, $ID, $UserID, $JeuxID) {
    
    $sql = "UPDATE LikeJeux SET UserID= ?, JeuxID = ? WHERE ID = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        echo "Erreur de préparation : " . mysqli_error($conn);
        return false;
    }

    mysqli_stmt_bind_param($stmt, "iii", $UserID, $JeuxID, $ID);
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $result;
}

function delete_LikeJeux($conn, $ID) {
    $sql = "DELETE FROM LikeJeux WHERE ID = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        echo "Erreur de préparation : " . mysqli_error($conn);
        return false;
    }

    mysqli_stmt_bind_param($stmt, "i", $ID);
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $result;
}

function get_LikeJeux($conn, $ID) {
    $sql = "SELECT * FROM LikeJeux WHERE ID = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        echo "Erreur de préparation : " . mysqli_error($conn);
        return false;
    }

    mysqli_stmt_bind_param($stmt, "i", $ID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    if ($result) {
        return getResultList_($result);
    }
    return null;
}


function get_LikeJeux_user($conn, $UserID) {
    $sql = "SELECT * FROM LikeJeux WHERE UserID = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        echo "Erreur de préparation : " . mysqli_error($conn);
        return false;
    }

    mysqli_stmt_bind_param($stmt, "i", $UserID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    if ($result) {
        return getResultList_($result);
    }
    return null;
}


function get_all_LikeJeux($conn) {
    $sql = "SELECT * FROM LikeJeux";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        echo "Erreur lors de la requête : " . mysqli_error($conn);
        return false;
    }

    return getResultList_($result);
}





// Compte le nombre total de like
function get_jeux_count($conn, $JeuxID) {
    $sql = "SELECT COUNT(*) as total FROM LikeJeux WHERE JeuxID = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        echo "Erreur de préparation : " . mysqli_error($conn);
        return false;
    }

    mysqli_stmt_bind_param($stmt, "i", $JeuxID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);


    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row["total"];
    }
    return null;
}





