<?php
session_start();

if( ! isset($_SESSION["JPEG"]) && ! $_SESSION["JPEG"])
{
    foreach ($_SESSION as $key => $value) {
        unset($_SESSION[$key]);
    }
    unset($_SESSION);
    $_SESSION["JPEG"] = true;
}
if( ! isset($_SESSION['user'])) $_SESSION['user'] = null; 
if( ! isset($_SESSION['admin'])) $_SESSION['admin'] = false;
if( ! isset($_SESSION['score'])) $_SESSION['score'] = null;

function del_session()
{
    foreach ($$_SESSION as $key => $value) {
        unset($_SESSION[$key]);
    }
    unset($_SESSION);
    session_destroy();
}