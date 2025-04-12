<?php

include_once __DIR__."/../CRUD/crud_classement.php";

function get_classment_api($conn)
{
    if(isset($_GET["cl_nb_joueurs"]) && is_int($_GET["cl_nb_joueurs"]) && $_GET["cl_nb_joueurs"] > 0)
    {
        return get_lst_classement($conn, $_GET["cl_nb_joueurs"]);
    }
    else 
    {
        get_lst_classement($conn, 10);
    }
}