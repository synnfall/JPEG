<?php
error_reporting(E_ALL) ;
ini_set( 'display_errors' , '1' ) ;


include_once __DIR__ . '/../../API/jeuxLike.php';
include_once __DIR__ . '/../../db/db_connect.php';
include_once __DIR__ . '/../../libs/session.php';

header('Content-Type: application/json');

if (!isset($_GET['id_jeux'])){
    echo json_encode(["result" => false, "message" => "id_jeux non définis ou non valide"]);
    exit;
}

else{
$JeuxID = intval($_GET['id_jeux']);



$UserID = $_SESSION["UserID"];

$result = add_likes($conn, $UserID, $JeuxID);

echo $result; 
}

?>

<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Titre de la page</title>
  
</head>
<body>

  <!-- Le reste du contenu -->
  </body>
</html>
