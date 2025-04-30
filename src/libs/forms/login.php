<?php
include_once __DIR__."/../../CRUD/crud_utilisateurs.php";

function login($conn) {
    if (!isset($_SESSION['login_essai'])) {
        $_SESSION['login_essai'] = 0;
        $_SESSION['dernier_login_essai'] = time();
    }

    
    if ($_SESSION['login_essai'] >= 10 && time() - $_SESSION['dernier_login_essai'] < 300) {
        die("Trop de tentatives. Veuillez réessayer plus tard.");
    }

    if (isset($_POST["login"], $_POST["mdp"]) && !isset($_POST["register"])) {
        $user_input = htmlspecialchars($_POST["login"], ENT_QUOTES, 'UTF-8');
        $users = get_user_by_name($conn, $user_input);

        if ($users != false && $users != null) {
            foreach ($users as $value) {
                if (password_verify($_POST["mdp"], $value["mdp"])) {
                    
                    $_SESSION['login_attempts'] = 0;
                    $_SESSION['UserID'] = $value['UserID'];
                    $_SESSION['user'] = $value['identifiant'];
                    $_SESSION['lienPdp'] = $value['lienPdp'];
                    $_SESSION['admin'] = ($value["isAdmin"] == 1);
                    $_SESSION['dateCreation'] = $value["dateCreation"];
                    session_regenerate_id(true); 
                    return true;
                }
            }
        }

        
        $_SESSION['login_essai'] += 1;
        $_SESSION['dernier_login_essai'] = time();
    }

    return false;
}




function register($conn)
{
    if(isset($_POST["register"]) && isset($_POST["mdp"]) && !isset($_POST["login"]))
    {
        $users = get_user_by_name($conn, $_POST["register"]);
        if($users!=[])
        {
            foreach ($users as $value)
            {
                if(password_verify($_POST["mdp"], $value["mdp"]))
                {
                    return false;
                }
            }
        }
        $est_cree = create_user($conn, htmlspecialchars($_POST["register"], ENT_QUOTES, 'UTF-8'), $_POST["mdp"]);
        if( $est_cree )
        {
            $users = get_user_by_name($conn, $_POST["register"]);
            if($users!=false && $users!=null )
            {
                foreach ($users as $value)
                {
                    if(password_verify($_POST["mdp"],$value["mdp"]))
                    {
                        $_SESSION['UserID'] = $value['UserID'];
                        $_SESSION['user'] = $value['identifiant'];
                        $_SESSION['lienPdp'] = $value['lienPdp'];
                        $_SESSION['admin'] = ($value["isAdmin"] == 1);
                        $_SESSION['dateCreation'] = $value["dateCreation"];
                        return true;
                    }
                }
            }
        }
        else
        {
            return null;
        }
    }
    return false;
}