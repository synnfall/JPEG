<?php



include_once(__DIR__."/../../CRUD/crud_utilisateurs.php");



$utilisateurs = get_all_user($conn); 


$utilisateur_a_modifier = null;
if (isset($_GET["action"]) && $_GET["action"] === "update" && isset($_GET["UserID"])) {
    $id = $_GET["UserID"];
    $utilisateur_a_modifier = get_user($conn, $id); 
}

/** 
 * Tableau des utilisateurs 
 */
function html_table_utilisateur($utilisateurs){
	$html="<table border='1' cellpadding='10'>\n" ; 
	$html.="<tr><th>Identifiant</th><th>LienPdp</th><th>Date Création</th><th>Admin</th><th>Modifier</th><th>Supprimer</th></tr>\n";

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
	
	$id 	= $utilisateur["UserID"] ; 
	$identifiant 	= $utilisateur["identifiant"] ; 
	
	$lienPdp	= $utilisateur["lienPdp"] ; 
    $dateCreation = $utilisateur["dateCreation"] ;
    $isAdmin = $utilisateur["isAdmin"] ;

	$html.="\t\t<td>$identifiant</td>\n" ;
	
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
	$href="admin_utilisateur.php?action=delete&UserID=$id" ; 
	$html="<a href='$href' ><img src='delete.png' width='30px'></a>" ;
       	return $html ; 	
}

/**
 * Lien de maj
 */
function html_a_update_utilisateur($id){
	$href="admin_utilisateur.php?action=update&UserID=$id" ; 
	$html="<a href='$href' ><img src='pencil.png' width='30px'></a>" ;
       	return $html ; 	
}

/*
 * Formulaire de maj d'un utilisateur
 */
function html_form_maj($utilisateur){
	$id = $utilisateur["UserID"];

	$identifiant 	= $utilisateur["identifiant"] ; 
	
	$lienPdp	= $utilisateur["lienPdp"] ; 
    
	
	$html="<form action='admin_utilisateur.php' method='POST'>\n" ; 
	$html.="<label for='identifiant'>identifiant</label>\n" ;
	$html.="<input type='text' name='identifiant' value='$identifiant'>\n" ; // \t
    
	 
	$html.="<label for='identifiant'>lienPdp joueurs</label>\n" ;
	$html.="<input type='text' name='lienPdp' value='$lienPdp'>\n" ; // \t
	$html.="<input type='hidden' name='UserID' value='$id'>\n" ; // \t
	$html.="<input type='hidden' name='action' value='update'>\n" ; // \t
	$html.="<input type='submit'>\n" ; // \t
	$html.="</form>\n";

	return $html ; 
}

/**
 * Formulaire de creation d'un utilisateur
 */
function html_form_create(){
	
	$html="<form action='admin_utilisateur.php' method='POST'>\n" ; 
	$html.="<label for='identifiant'>identifiant</label>\n" ;
	$html.="<input type='text' name='identifiant' >\n" ; // \t
	$html.="<label for='mdp'>lienPdp joueurs</label>\n" ;
	$html.="<input type='text' name='lienPdp' >\n" ; // \t
	$html.="<input type='hidden' name='action' value='create'>\n" ; // \t
	$html.="<input type='hidden' name='id'>\n" ; // \t
	$html.="<input type='submit' class='submit'>\n" ; // \t
	$html.="</form>\n";

	return $html ; 
}


?>







