<?php
include_once __DIR__."/../CRUD/crud_historique.php";
include_once __DIR__."/../CRUD/crud_utilisateurs.php";

$histo = get_historique($conn, $_GET["id_p"]);

if(! $histo){
  header("Location: .");
  exit;
}

$IDj1 = $histo["ID_J1"];
$IDj2 = $histo["ID_J2"];
$joueur_1_a_gagner = ($IDj1 == $histo["gagnant"]);

$Joueur1 = get_user($conn, $IDj1)[0];
$Joueur2 = get_user($conn, $IDj2)[0];
$name1 = $Joueur1["identifiant"];
$pfp1 = $Joueur1["lienPdp"];

$name2 = $Joueur2["identifiant"];
$pfp2 = $Joueur2["lienPdp"];
function vue_win($name){
  $html="";
  $html.='<img src="./img/icons/trophy.png" alt="won"><h1>'.$name.' Won!</h1>';
  return $html;
}

function vue_loose(){
  $html="";
  $html.='<img src="./img/icons/loose.png" alt="lost"><h1>You Lost !</h1>';
  return $html;
}

?>