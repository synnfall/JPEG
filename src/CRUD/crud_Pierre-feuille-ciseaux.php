<?php

function create_pfc_games($conn,$p_id)
{
    $table_name = "games_" . (int)$p_id;
    $sql = "CREATE TABLE `db_grp14`.`$table_name` ( `coup` INT NOT NULL AUTO_INCREMENT , `date` TIMESTAMP NOT NULL , `coupj1` VARCHAR(16) NULL DEFAULT NULL , `coupj2` VARCHAR(16) NULL DEFAULT NULL , PRIMARY KEY (`coup`)) ENGINE = InnoDB; ";
    
    return mysqli_query($conn, $sql);
}