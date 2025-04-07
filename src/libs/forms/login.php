<?php
include_once __DIR__."/../../CRUD/cruds_utilisateurs.php";
function login($conn){
    if(isset($_POST["login"]) && isset($_POST["mdp"]))
    {
        $users = get_user($conn, $_POST["login"]);
        if($users!=false && $users!=null )
        {
            foreach ($users as $value)
            {
                if(password_verify($value["mdp"], $_POST["mdp"]))
                {
                    $_SESSION['UserID'] = $value['UserID'];
                    $_SESSION['pseudo'] = $value['identifiant'];
                    $_SESSION['lienPdp'] = $value['lienPdp'];
                    $_SESSION['admin'] = ($value["isAdmin"] == 1);
                    $_SESSION['dateCreation'] = $value["dateCreation"];
                    return true;
                }
            }
        }
    }
    return false;
}

function register($conn)
{
    if(isset($_POST["register"]) && isset($_POST["mdp"]))
    {
        $users = get_user($conn, $_POST["register"]);
        if($users==false) return false;
        if($users!=null)
        {
            foreach ($users as $value)
            {
                if(password_verify($value["mdp"], $_POST["mdp"]))
                {
                    return false;
                }
            }
        }
        
    }
    return false;
}