<?php

function getResultList($result) {
    $list = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $list[] = $row;
    }
    return $list;
}

function create_queue($conn, $userID, $state, $user_adked, $ID_Jeux, $date) {

    $sql = "INSERT INTO queue (userID, state, user_adked, ID_Jeux, date) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        echo "Erreur de préparation : " . mysqli_error($conn);
        return false;
    }

    mysqli_stmt_bind_param($stmt, "iiiis", $userID, $state, $user_adked, $ID_Jeux, $date);
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $result;
}

function update_queue($conn, $userID, $state, $user_adked, $ID_Jeux, $date, $oldUserID, $oldDate) {
    $sql = "UPDATE queue SET userID = ?, state = ?, user_adked = ?, ID_jeux = ?, date = ? WHERE userID = ? AND date = ?";
    
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        echo "Erreur de préparation : " . mysqli_error($conn);
        return false;
    }

    mysqli_stmt_bind_param($stmt, "iiiisis", $userID, $state, $user_adked, $ID_Jeux, $date, $oldUserID, $oldDate);
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $result;
}


function delete_queue($conn, $userID, $date) {
    $sql = "DELETE FROM queue WHERE userID = ? and date = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        echo "Erreur de préparation : " . mysqli_error($conn);
        return false;
    }

    mysqli_stmt_bind_param($stmt, "is", $userID, $date);
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $result;
}

function get_friends($conn, $userID, $date) {
    $sql = "SELECT * FROM queue WHERE userID = ? and date = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        echo "Erreur de préparation : " . mysqli_error($conn);
        return false;
    }

    mysqli_stmt_bind_param($stmt, "is", $userID, $date);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    if ($result) {
        return getResultList($result);
    }
    return null;
}


function get_all_friends($conn) {
    $sql = "SELECT * FROM queue";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        echo "Erreur lors de la requête : " . mysqli_error($conn);
        return false;
    }

    return getResultList($result);
}






