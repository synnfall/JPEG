<?php

function getResultList($result) {
    $list = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $list[] = $row;
    }
    return $list;
}

function generateToken() {
    return bin2hex(random_bytes(32));
}

function select_partie_by_name($conn, $userID)
{
    $sql = "SELECT `gameID` FROM `queue` WHERE `userID` = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        echo "Erreur de préparation : " . mysqli_error($conn);
        return false;
    }

    mysqli_stmt_bind_param($stmt, "i", $userID);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    if ($result) {
        return mysqli_fetch_assoc($result);
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
    $sql = "DELETE FROM `Parties` WHERE `date` < (NOW() - INTERVAL 6 HOUR)";
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