<?php
 include_once __DIR__ . '/../../CRUD/crud_utilisateurs.php'; 
 
 function get_utilisateur($conn, $userId) {
 
 
 
     
     $user = get_user($conn, $userId)[0];
     
     $date = date("d/m/Y", strtotime($user["dateCreation"] ?? "now"));
 
     return json_encode(["identifiant" => $user["identifiant"], "chemin_pfp" => $user["lienPdp"], "date_join" => $date, "parties_w" => 40, "parties_l" => 21 ]);

 }