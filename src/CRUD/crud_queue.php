<?php

function check_joueur_in_queue($conn, $token)
{
    $sql = "SELECT `userID`, `gameID` FROM `queue` WHERE `token` = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        echo "Erreur de préparation : " . mysqli_error($conn);
        return false;
    }

    mysqli_stmt_bind_param($stmt, "s", $token);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    if ($result) {
        return mysqli_fetch_assoc($result);
    }
    return false;
}

function select_user_by_games($conn, $ID_Jeux, $userID)
{
    $sql = "SELECT `userID`, `gameID` FROM `queue` WHERE `gameID` = ? AND `userID` != ?";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        echo "Erreur de préparation : " . mysqli_error($conn);
        return false;
    }

    mysqli_stmt_bind_param($stmt, "ii", $ID_Jeux,$userID);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    if ($result) {
        return mysqli_fetch_assoc($result);
    }
    return null;
}

function create_queue($conn, $userID, $ID_Jeux) {

    $token = bin2hex(random_bytes(32));
    $sql = "INSERT INTO `queue`(`userID`, `gameID`,`token`, `date`) VALUES (?, ?, ?, NOW())";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        echo "Erreur de préparation : " . mysqli_error($conn);
        return false;
    }

    mysqli_stmt_bind_param($stmt, "iis", $userID, $ID_Jeux,$token);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $token;
}

function update_queue($conn, $token) {
    $sql = "UPDATE queue SET `date` = NOW() WHERE `token` = ?";
    
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        echo "Erreur de préparation : " . mysqli_error($conn);
        return false;
    }

    mysqli_stmt_bind_param($stmt, "s", $token);
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