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
    $sql = "SELECT `idPartie` FROM `Parties` WHERE `date` < (NOW() - INTERVAL 70 SECOND)";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $id_p = $row["idPartie"];
        $sql = "DROP TABLE IF EXISTS `db_grp14`.`games_$id_p`;";
        mysqli_query($conn, $sql);
    }

    $sql = "DELETE FROM `Parties` WHERE `date` < (NOW() - INTERVAL 70 SECOND)";
 
    return mysqli_query($conn, $sql);
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

function est_joueur1($conn, $token, $ID_partie){
    $ID_partie = (int)$ID_partie;
    $token = mysqli_real_escape_string($conn, $token);

    $sql = "SELECT token1 FROM parties WHERE `idPartie` = ? LIMIT 1;";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        echo "Erreur de préparation : " . mysqli_error($conn);
        return false;
    }

    mysqli_stmt_bind_param($stmt, "i", $ID_partie);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    $row = mysqli_fetch_assoc($result);
    return $row['token1'] === $token;
}

function est_joueur2($conn, $token, $ID_partie){
    $ID_partie = (int)$ID_partie;
    $token = mysqli_real_escape_string($conn, $token);

    $sql = "SELECT token2 FROM parties WHERE `idPartie` = ? LIMIT 1;";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        echo "Erreur de préparation : " . mysqli_error($conn);
        return false;
    }

    mysqli_stmt_bind_param($stmt, "i", $ID_partie);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    $row = mysqli_fetch_assoc($result);
    return $row['token2'] === $token;
}