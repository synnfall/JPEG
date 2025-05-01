<?php
include_once __DIR__."/../CRUD/crud_utilisateurs.php";
include_once __DIR__."/../CRUD/crud_parties.php";
include_once __DIR__."/../CRUD/crud_queue.php";
include_once __DIR__."/../db/db_connect.php";
session_start();
clean_partie($conn);
clean_queue($conn);

if( ! isset($_SESSION["JPEG"]))
{
    if(! $_SESSION["JPEG"]){
        foreach ($_SESSION as $key => $value) {
            unset($_SESSION[$key]);
        }
        $_SESSION["JPEG"] = true;
    }
}

function init_session()
{
    if( ! isset($_SESSION['user'])) $_SESSION['user'] = null; 
    if( ! isset($_SESSION['admin'])) $_SESSION['admin'] = false;
    if( ! isset($_SESSION['score'])) $_SESSION['score'] = null;
    return $_SESSION['user']!=null;
}

function del_session()
{
    foreach ($_SESSION as $key => $value) {
        unset($_SESSION[$key]);
    }
}

function disconnect($connected)
{
    if(isset($_GET["disconnect"]) && $_GET["disconnect"]=="true")
    {
        del_session();
        return init_session();
    }
    return $connected;
}
function delete($conn,$connected)
{
    if($connected && isset($_GET["delete"]) && $_GET["delete"]=="true"){
        delete_user($conn, $_SESSION['UserID']);
        del_session();
        return init_session();
    }
    return $connected;
}
$connected = init_session();
$connected = delete($conn,$connected);
$connected = disconnect($connected);