<?php

include_once __DIR__."/../CRUD/crud_jeux.php";

function lst_games_api($conn)
{
    return select_all_games($conn);
}