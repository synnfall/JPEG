<?php
include_once __DIR__."/../libs/env.php";

if($_ENV["DB_HOST"]=="" || $_ENV["DB_NAME"]=="" || $_ENV["USER"]=="" || $_ENV["PASSWORD"]=="" || $_ENV["PORT"]=="") exit(".env mal complété ou problème lors de son chargement");

$hosts = $_ENV["DB_HOST"];
$user = $_ENV["USER"];
$passwd = $_ENV["PASSWORD"];
$db_name = $_ENV["DB_NAME"];
$port = $_ENV["PORT"];

if(isset($_ENV["HOSTNAME"]) && $_ENV["HOSTNAME"] != "") $HOSTNAME = $_ENV["HOSTNAME"];

unset($_ENV);