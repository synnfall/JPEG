<?php

function getResultList($result) {
    $list = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $list[] = $row;
    }
    return $list;
}

function create_friends($conn, $UserID1, $UserID2) {

    $sql = "INSERT INTO friends (UserID1, UserID2) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        echo "Erreur de préparation : " . mysqli_error($conn);
        return false;
    }

    mysqli_stmt_bind_param($stmt, "ii", $UserID1, $UserID2);
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $result;
}

function update_friends($conn, $UserID1, $UserID2, $new1, $new2) {
    
    $sql = "UPDATE friends SET UserID1 = ?, UserID2 = ?  WHERE UserID1 = ? and UserID2= ? ";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        echo "Erreur de préparation : " . mysqli_error($conn);
        return false;
    }

    mysqli_stmt_bind_param($stmt, "iiii", $UserID1, $UserID2, $new1, $new2);
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $result;
}

function delete_friends($conn, $UserID1, $UserID2) {
    $sql = "DELETE FROM friends WHERE UserID1 = ? and UserID2 = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        echo "Erreur de préparation : " . mysqli_error($conn);
        return false;
    }

    mysqli_stmt_bind_param($stmt, "ii", $UserID1, $UserID2);
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return $result;
}

function get_friends($conn, $UserID1, $UserID2) {
    $sql = "SELECT * FROM friends WHERE UserID1 = ? and UserID2 = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        echo "Erreur de préparation : " . mysqli_error($conn);
        return false;
    }

    mysqli_stmt_bind_param($stmt, "ii", $UserID1, $UserID2);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    if ($result) {
        return getResultList($result);
    }
    return null;
}


function get_all_friends($conn) {
    $sql = "SELECT * FROM friends";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        echo "Erreur lors de la requête : " . mysqli_error($conn);
        return false;
    }

    return getResultList($result);
}






