<?php

function html_table_jeux($jeux) {
    $html = "<table border='1' cellpadding='10'>";
    $html .= "<tr><th>Nom</th><th>Likes</th><th>Description</th><th>Modifier</th><th>Supprimer</th></tr>";
    
    foreach ($jeux as $jeu) {

        $id = (int)$jeu["ID"];
        $nom = htmlspecialchars($jeu['nomJeux']);
        $likes = htmlspecialchars($jeu['nbLikes']);
        $desc = htmlspecialchars($jeu['description']);

        $html .= "<tr>
            <td>$nom</td>
            <td>$likes</td>
            <td>$desc</td>
            <td><a href='admin_jeux.php?action=update&JeuID=$id'><img src='../img/icons/edit.svg' width='30px' alt='Modifier'></a></td>
            <td><a href='admin_jeux.php?action=delete&JeuID=$id'><img src='../img/icons/delete.svg' width='30px' alt='Supprimer'></a></td>
        </tr>";
    }

    $html .= "</table>";
    return $html;
}


function html_form_create_jeu() {
    $csrf = $_SESSION['csrf_token'];
    return "<form method='POST' action='admin_jeux.php'>
        <label>Nom</label><input type='text' name='nom'><br>
        <label>Likes</label><input type='number' name='likes'><br>
        <label>Description</label><textarea name='description'></textarea><br>
        <input type='hidden' name='action' value='create'>
        <input type='hidden' name='csrf_token' value='$csrf'>
        <input type='submit' class='submit' value='Ajouter'>
    </form>";
}


function html_form_update_jeu($jeu) {
    $csrf = $_SESSION['csrf_token'];
    
    $id = (int)$jeu['ID'];
    $nom = htmlspecialchars($jeu['nomJeux']);
    $likes = htmlspecialchars($jeu['nbLikes']);
    $desc = htmlspecialchars($jeu['description']);

    return "<form method='POST' action='admin_jeux.php'>
        <label>Nom</label><input type='text' name='nom' value='$nom'><br>
        <label>Likes</label><input type='number' name='likes' value='$likes'><br>
        <label>Description</label><textarea name='description'>$desc</textarea><br>
        <input type='hidden' name='JeuID' value='$id'>
        <input type='hidden' name='action' value='update'>
        <input type='hidden' name='csrf_token' value='$csrf'>
        <input type='submit' class='submit' value='Mettre à jour'>
    </form>";
}

