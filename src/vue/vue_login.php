<?php

function error_login($check_register)
{
    if( !isset($_POST["register"]) && !isset($_POST["login"]) ) return "";

    $html = '<label name="problem_input" class="danger">';

    if(isset($_POST["register"]) && isset($_POST["login"]))
    {
        $html .= "Vous ne pouvez pas vous connecter et vous enregistrer en même temps !";
    }
    elseif($check_register==NULL)
    {
        $html .= "Votre création a réussi mais la connexion a votre compte a échoué !";
    }
    else
    {
        $html .= "Votre identifiant ou mot de passe est erronée !";
    }
    return $html . "</label>";
}