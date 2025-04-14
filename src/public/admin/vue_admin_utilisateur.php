<?php



include_once(__DIR__."/../../CRUD/crud_utilisateurs.php");



$utilisateurs = get_all_user($conn); 


$utilisateur_a_modifier = null;
if (isset($_GET["action"]) && $_GET["action"] === "update" && isset($_GET["id"])) {
    $id = $_GET["id"];
    $utilisateur_a_modifier = get_user($conn, $id); // À définir dans CRUD
}

/** 
 * Tableau des utilisateurs 
 */
function html_table_utilisateur($utilisateurs){
	$html="<table border='1' cellpadding='10'>\n" ; 
	$html.="<tr><th>Identifiant</th><th>Mot de passe</th><th>LienPdp</th><th>Date Création</th><th>Admin</th><th>Modifier</th><th>Supprimer</th></tr>\n";

	foreach($utilisateurs as $utilisateur){
		$html .= html_tr_utilisateur($utilisateur); 	
	}

	$html.="</table>\n" ; 
	return $html ; 
}



/**
 * Ligne du tableau: utilisateur | mdp | lienPdp | edition | suppression
 */
function html_tr_utilisateur($utilisateur){
	$html="\t<tr>\n" ; 
	
	$id 	= $utilisateur["id"] ; 
	$identifiant 	= $utilisateur["identifiant"] ; 
	$mdp = $utilisateur["mdp"] ; 
	$lienPdp	= $utilisateur["lienPdp"] ; 
    $dateCreation = $utilisateur["dateCreation"] ;
    $isAdmin = $utilisateur["isAdmin"] ;

	$html.="\t\t<td>$identifiant</td>\n" ;
	$html.="\t\t<td>$mdp</td>\n" ;
	$html.="\t\t<td>$lienPdp</td>\n" ;
     $html.="\t\t<td>$dateCreation</td>\n";
    $html.= "\t\t<td>$isAdmin</td>\n";

	$a_update=html_a_update_utilisateur($id) ; 
	$html.="\t\t<td>$a_update</td>\n" ;
	
	$a_delete=html_a_delete_utilisateur($id) ; 
	$html.="\t\t<td>$a_delete</td>\n" ;
	
	$html.="\t</tr>\n" ; 
	return $html ;
}

/**
 * Lien de suppression
 */
function html_a_delete_utilisateur($id){
	$href="admin_utilisateur.php?action=delete&table=utilisateur&id=$id" ; 
	$html="<a href='$href' ><img src='delete.png' width='30px'></a>" ;
       	return $html ; 	
}

/**
 * Lien de maj
 */
function html_a_update_utilisateur($id){
	$href="admin_utilisateur.php?action=update&table=utilisateur&id=$id" ; 
	$html="<a href='$href' ><img src='pencil.png' width='30px'></a>" ;
       	return $html ; 	
}

/*
 * Formulaire de maj d'un utilisateur
 */
function html_form_maj($utilisateur){
	$id = $utilisateur["UserID"];

	$identifiant 	= $utilisateur["identifiant"] ; 
	$mdp = $utilisateur["mdp"] ; 
	$lienPdp	= $utilisateur["lienPdp"] ; 
    
	
	$html="<form action='admin_utilisateur.php' method='POST'>\n" ; 
	$html.="<label for='identifiant'>identifiant</label>\n" ;
	$html.="\t<input type='text' name='identifiant' value='$identifiant'>\n" ; 
    
	$html.="<label for='mdp'>Préidentifiant</label>\n" ;
	$html.="\t<input type='text' name='mdp' value='$mdp'>\n" ; 
	$html.="<label for='identifiant'>lienPdp joueurs</label>\n" ;
	$html.="\t<input type='text' name='lienPdp' value='$lienPdp'>\n" ; 
	$html.="\t<input type='hidden' name='id' value='$id'>\n" ; 
	$html.="\t<input type='hidden' name='action' value='update'>\n" ; 
	$html.="\t<input type='submit'>\n" ; 
	$html.="</form>\n";

	return $html ; 
}

/**
 * Formulaire de creation d'un utilisateur
 */
function html_form_create(){
	
	$html="<form action='admin_utilisateur.php' method='POST'>\n" ; 
	$html.="<label for='identifiant'>identifiant</label>\n" ;
	$html.="\t<input type='text' name='identifiant' >\n" ; 
	$html.="<label for='mdp'>Préidentifiant</label>\n" ;
	$html.="\t<input type='text' name='mdp' >\n" ; 
	$html.="<label for='mdp'>lienPdp joueurs</label>\n" ;
	$html.="\t<input type='text' name='lienPdp' >\n" ; 
	$html.="\t<input type='hidden' name='action' value='create'>\n" ; 
	$html.="\t<input type='hidden' name='id'>\n" ; 
	$html.="\t<input type='submit'>\n" ; 
	$html.="</form>\n";

	return $html ; 
}


?>




<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Admin - Gestion des Utilisateurs</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <h1>Page d'administration - Gestion des utilisateurs</h1>

  <h2>Créer un nouvel utilisateur</h2>
  <?php
    echo html_form_create();
  ?>

  <hr>

  <?php if ($utilisateur_a_modifier): ?>
    <h2>Modifier l'utilisateur : <?= htmlspecialchars($utilisateur_a_modifier["identifiant"]) ?></h2>
    <?php echo html_form_maj($utilisateur_a_modifier); ?>
    <hr>
  <?php endif; ?>

  <h2>Liste des utilisateurs</h2>
  <?php
    echo html_table_utilisateur($utilisateurs);
  ?>

</body>
</html>



