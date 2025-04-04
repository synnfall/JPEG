<?php
$env = parse_ini_file('../.env');

if($env["DB_HOST"]=="" || $env["DB_NAME"]=="" || $env["USER"]=="" || $env["PASSWORD"]=="" || $env["PORT"]=="") exit(".env mal complété ou problème lors de son chargement");

$hosts = $env["DB_HOST"];
$user = $env["USER"];
$passwd = $env["PASSWORD"];
$db_name = $env["DB_NAME"];
$port = $env["PORT"];

unset($env);