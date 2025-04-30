<?php

function getResultList($result) {
    $list = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $list[] = $row;
    }
    return $list;
}

function select_user_by_games($conn, $ID_Jeux)
{
    $sql = "SELECT `userID`, `gameID` FROM `queue` WHERE `gameID` = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        echo "Erreur de préparation : " . mysqli_error($conn);
        return false;
    }

    mysqli_stmt_bind_param($stmt, "i", $ID_Jeux);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    if ($result) {
        return mysqli_fetch_assoc($result);
    }
    return null;
}

function create_queue($conn, $userID, $ID_Jeux) {

    $sql = "INSERT INTO `queue`(`userID`, `gameID`, `date`) VALUES (?, ?, NOW())";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        echo "Erreur de préparation : " . mysqli_error($conn);
        return false;
    }

    mysqli_stmt_bind_param($stmt, "ii", $userID, $ID_Jeux);
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $result;
}

function update_queue($conn, $userID) {
    $sql = "UPDATE queue SET `date` = NOW() WHERE userID = ?";
    
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        echo "Erreur de préparation : " . mysqli_error($conn);
        return false;
    }

    mysqli_stmt_bind_param($stmt, "i", $userID);
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $result;
}

function delete_queue($conn, $userID)
{
    $sql = "DELETE FROM `queue` WHERE `userID` = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        echo "Erreur de préparation : " . mysqli_error($conn);
        return false;
    }
    mysqli_stmt_bind_param($stmt, "i", $userID);
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $result;
}

function clean_queue($conn) {
    $sql = "DELETE FROM `queue` WHERE `date` < (NOW() - INTERVAL 5 SECOND)";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        echo "Erreur de préparation : " . mysqli_error($conn);
        return false;
    }
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $result;
}