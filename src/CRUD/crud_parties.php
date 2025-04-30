<?php

function generateToken() {
    return bin2hex(random_bytes(32));
}

function select_partie_by_name($conn, $userID)
{
    $sql = "SELECT * FROM `Parties` WHERE `IDUser1` = ? or `IDUser2` = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        echo "Erreur de préparation : " . mysqli_error($conn);
        return false;
    }

    mysqli_stmt_bind_param($stmt, "ii", $userID, $userID);
    mysqli_stmt_execute($stmt);
    
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    if ($result) {
        return mysqli_fetch_assoc($result);
    }
    return false;
}

function select_token_by_userid($conn, $userID)
{
    $sql = "SELECT CASE WHEN IDUser1 = ? THEN token1 WHEN IDUser2 = ? THEN token2 ELSE NULL END AS token FROM Parties WHERE IDUser1 = ? OR IDUser2 = ?;";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        echo "Erreur de préparation : " . mysqli_error($conn);
        return false;
    }

    mysqli_stmt_bind_param($stmt, "iiii", $userID, $userID,$userID, $userID);
    mysqli_stmt_execute($stmt);
    
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    if ($result) {
        return mysqli_fetch_assoc($result)["token"];
    }
    return false;
}

function get_id_other_users($conn, $userID)
{
    $sql = "SELECT CASE WHEN IDUser1 = ? THEN IDUser2 WHEN IDUser2 = ? THEN IDUser1 ELSE NULL END AS IDUser FROM Parties WHERE IDUser1 = ? OR IDUser2 = ?;";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        echo "Erreur de préparation : " . mysqli_error($conn);
        return false;
    }

    mysqli_stmt_bind_param($stmt, "iiii", $userID, $userID,$userID, $userID);
    mysqli_stmt_execute($stmt);
    
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    if ($result) {
        return mysqli_fetch_assoc($result)["IDUser"];
    }
    return false;
}

function create_partie($conn, $gameID, $userID1, $userID2) {

    $token1 = generateToken();
    $token2 = generateToken();

    $sql = "INSERT INTO `Parties`(`idPartie`, `gameID`, `IDUser1`, `IDUser2`, `token1`, `token2`, `date`) VALUES (null,?,?,?,?,?,NOW())";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        echo "Erreur de préparation : " . mysqli_error($conn);
        return false;
    }

    mysqli_stmt_bind_param($stmt, "iiiss", $gameID, $userID1, $userID2, $token1, $token2);
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $result;
}

function clean_partie($conn) {
    $sql = "DELETE FROM `Parties` WHERE `date` < (NOW() - INTERVAL 7000 SECOND)";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        echo "Erreur de préparation : " . mysqli_error($conn);
        return false;
    }
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $result;
}

function update_partie($conn, $idPartie) {
    $sql = "UPDATE `Parties` SET `date` = NOW() WHERE idPartie = ?";
    
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        echo "Erreur de préparation : " . mysqli_error($conn);
        return false;
    }

    mysqli_stmt_bind_param($stmt, "i", $idPartie);
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $result;
}

function delete_partie($conn, $idPartie)
{
    $sql = "DELETE FROM `Parties` WHERE `idPartie` = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        echo "Erreur de préparation : " . mysqli_error($conn);
        return false;
    }
    mysqli_stmt_bind_param($stmt, "i", $idPartie);
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $result;
}