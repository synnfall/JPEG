<?php

function create_pfc_games($conn,$p_id,$db_name)
{
    $table_name = "games_" . (int)$p_id;
    $sql = "CREATE TABLE `$db_name`.`$table_name` ( `coup` INT NOT NULL AUTO_INCREMENT , `date` TIMESTAMP(3) NOT NULL , `coupj1` INT NULL DEFAULT NULL , `coupj2` INT NULL DEFAULT NULL , `cheat1` INT NULL DEFAULT NULL , `cheat2` INT NULL DEFAULT NULL , PRIMARY KEY (`coup`)) ENGINE = InnoDB; ";
    
    return mysqli_query($conn, $sql);
}

function est_empty_games_pfc($conn, $p_id){
    $table_name = "games_" . (int)$p_id;
    $sql =  "SELECT EXISTS (SELECT 1 FROM `$table_name` LIMIT 1) AS est_vide;";

    $result = mysqli_query($conn, $sql);

    if (!$result) {
        return false;
    }

    $row = mysqli_fetch_assoc($result);
    return $row['est_vide'] == 0;
}

function create_empty_coup_pfc($conn, $p_id){
    $table_name = "games_" . (int)$p_id;
    $sql = "INSERT INTO `$table_name`(`coup`, `date`, `coupj1`, `coupj2`, `cheat1`, `cheat2`) VALUES (null,NOW(3),null,null,null,null)";

    return mysqli_query($conn, $sql);
}

function select_last_coup_pfc($conn, $p_id){
    $table_name = "games_" . (int)$p_id;
    $sql = "SELECT * FROM `$table_name` ORDER BY `coup` DESC LIMIT 1;";

    $result = mysqli_query($conn, $sql);

    if (!$result) {
        return null;
    }

    return mysqli_fetch_assoc($result); 
}

function get_score_pfc_crud($conn, $p_id){
    $table_name = "games_" . (int)$p_id;
    $score = array(0,0);

    $sql = "SELECT * FROM `$table_name` WHERE `date` < NOW(3) - INTERVAL 24 SECOND;";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $coupj1 = $row["coupj1"];
            $coupj2 = $row["coupj2"];
            if (!$coupj1 && $coupj2) {
                $score[1] += 1;
            }
            elseif($coupj1 && !$coupj2){
                $score[0] += 1;
            }
            elseif($coupj1 && $coupj2){
                switch ($coupj1) {
                    case 1:
                        if ($coupj2==3){
                            $score[0] += 1;
                        }
                        elseif($coupj2==2){
                            $score[1] += 1;
                        }
                        break;
                    case 2:
                        if ($coupj2==1){
                            $score[0] += 1;
                        }
                        elseif($coupj2==3){
                            $score[1] += 1;
                        }
                        break;
                    case 3:
                        if ($coupj2==2){
                            $score[0] += 1;
                        }
                        elseif($coupj2==1){
                            $score[1] += 1;
                        }
                        break;
                }
            }
        }
    }
    return $score;
}

function update_coupj1($conn, $p_id, $coup){
    $table_name = "games_" . (int)$p_id;
    $last_coup_id = select_last_coup_pfc($conn, $p_id)['coup'];
    $sql = "UPDATE `$table_name` SET `coupj1`= ? WHERE `coup`= $last_coup_id ";

    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        echo "Erreur de préparation : " . mysqli_error($conn);
        return false;
    }

    mysqli_stmt_bind_param($stmt, "i", $coup);
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return $result; 
}

function update_coupj2($conn, $p_id, $coup){
    $table_name = "games_" . (int)$p_id;
    $last_coup_id = select_last_coup_pfc($conn, $p_id)['coup'];
    $sql = "UPDATE `$table_name` SET `coupj2`= ? WHERE `coup`= $last_coup_id ";

    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        echo "Erreur de préparation : " . mysqli_error($conn);
        return false;
    }

    mysqli_stmt_bind_param($stmt, "i", $coup);
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return $result; 
}

function update_coupj1_cheat($conn, $p_id, $coup){
    $table_name = "games_" . (int)$p_id;
    $last_coup_id = select_last_coup_pfc($conn, $p_id)['coup'];
    $sql = "SELECT * FROM `$table_name` WHERE `coup`= $last_coup_id;";

    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        echo "Erreur de préparation : " . mysqli_error($conn);
        return false;
    }

    mysqli_stmt_bind_param($stmt, "i", $coup);
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return $result; 
}

function update_coupj2_cheat($conn, $p_id, $coup){
    $table_name = "games_" . (int)$p_id;
    $last_coup_id = select_last_coup_pfc($conn, $p_id)['coup'];
    $sql = "UPDATE `$table_name` SET `coupj2`= ?, `cheat2` = 1 WHERE `coup`= $last_coup_id ";

    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        echo "Erreur de préparation : " . mysqli_error($conn);
        return false;
    }

    mysqli_stmt_bind_param($stmt, "i", $coup);
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return $result; 
}

function select_coupj1_cheat($conn, $p_id){
    $table_name = "games_" . (int)$p_id;
    $last_coup_id = select_last_coup_pfc($conn, $p_id)['coup'];
    $sql = "UPDATE `$table_name` SET `cheat1` = 1 WHERE `coup`= $last_coup_id ";
    $result = mysqli_query($conn, $sql);

    if($result){
        $sql = "SELECT `coupj2` FROM `$table_name` WHERE `coup`= $last_coup_id ";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            return null;
        }

        return mysqli_fetch_assoc($result)["coupj2"]; 
    }
    return $result;
}

function select_coupj2_cheat($conn, $p_id){
    $table_name = "games_" . (int)$p_id;
    $last_coup_id = select_last_coup_pfc($conn, $p_id)['coup'];
    $sql = "UPDATE `$table_name` SET `cheat2` = 1 WHERE `coup`= $last_coup_id ";
    $result = mysqli_query($conn, $sql);

    if($result){
        $sql = "SELECT `coupj1` FROM `$table_name` WHERE `coup`= $last_coup_id ";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            return null;
        }

        return mysqli_fetch_assoc($result)['coupj1']; 
    }
    return $result;
}

function joueur_1_a_cheat_pfc($conn, $p_id){
    $table_name = "games_" . (int)$p_id;
    $last_coup_id = select_last_coup_pfc($conn, $p_id)['coup'];

    $sql = "SELECT `cheat1` FROM `$table_name` WHERE `coup`= $last_coup_id ";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        return null;
    }

    return mysqli_fetch_assoc($result)['cheat1']==1; 

    return $result;
}

function joueur_2_a_cheat_pfc($conn, $p_id){
    $table_name = "games_" . (int)$p_id;
    $last_coup_id = select_last_coup_pfc($conn, $p_id)['coup'];

    $sql = "SELECT `cheat2` FROM `$table_name` WHERE `coup`= $last_coup_id ";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        return null;
    }

    return mysqli_fetch_assoc($result)['cheat2']==1; 

    return $result;
}

function select_coupj1($conn, $p_id){
    $table_name = "games_" . (int)$p_id;
    $last_coup_id = select_last_coup_pfc($conn, $p_id)['coup'];

    $sql = "SELECT `coupj1` FROM `$table_name` WHERE `coup`= $last_coup_id ";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        return null;
    }

    return mysqli_fetch_assoc($result)['coupj1']; 
}

function select_coupj2($conn, $p_id){
    $table_name = "games_" . (int)$p_id;
    $last_coup_id = select_last_coup_pfc($conn, $p_id)['coup'];

    $sql = "SELECT `coupj2` FROM `$table_name` WHERE `coup`= $last_coup_id ";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        return null;
    }

    return mysqli_fetch_assoc($result)['coupj2']; 
}