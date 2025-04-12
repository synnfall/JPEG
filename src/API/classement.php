<?php

include_once __DIR__."/../CRUD/crud_classement.php";

function get_classment_api($conn)
{
    if(isset($_GET["cl_nb_joueurs"]) && ctype_digit($_GET["cl_nb_joueurs"]) && ( (int) $_GET["cl_nb_joueurs"] > 0 ))
    {
        return get_lst_classement($conn, (int) $_GET["cl_nb_joueurs"]);
    }
    else
    {
        return get_lst_classement($conn, 10);
    }
}