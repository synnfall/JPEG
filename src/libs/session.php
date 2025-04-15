<?php
session_start();

if( ! isset($_SESSION["JPEG"]) && ! $_SESSION["JPEG"])
{
    foreach ($_SESSION as $key => $value) {
        unset($_SESSION[$key]);
    }
    $_SESSION["JPEG"] = true;
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
$connected = init_session();
$connected = disconnect($connected);