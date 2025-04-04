<?php
$env = parse_ini_file('../.env');

if(! ( isset($env["DB_HOST"]) && isset($env["DB_NAME"]) && isset($env["USER"]) && isset($env["PASSWORD"]) && isset($env["PORT"])) ) exit(".env mal complété ou problème lors de son chargement");

$hosts = $env["DB_HOST"];
$user = $env["USER"];
$passwd = $env["PASSWORD"];
$db_name = $env["DB_NAME"];
$port = $env["PORT"];

unset($env);