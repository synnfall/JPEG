<?php

function create_pfc_games($conn,$p_id)
{
    $table_name = "games_" . (int)$p_id;
    $sql = "CREATE TABLE `db_grp14`.`$table_name` ( `coup` INT NOT NULL AUTO_INCREMENT , `date` TIMESTAMP NOT NULL , `coupj1` INT NULL DEFAULT NULL , `coupj2` INT NULL DEFAULT NULL , `cheat1` INT NULL DEFAULT NULL , `cheat2` INT NULL DEFAULT NULL , PRIMARY KEY (`coup`)) ENGINE = InnoDB; ";
    
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
    $sql = "INSERT INTO `$table_name`(`coup`, `date`, `coupj1`, `coupj2`, `cheat1`, `cheat2`) VALUES (null,NOW(),null,null,null,null)";

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

function get_score_pfc($conn, $p_id){
    $table_name = "games_" . (int)$p_id;
    $score = array(0,0);

    $sql = "SELECT * FROM `$table_name`;";
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