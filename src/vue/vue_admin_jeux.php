<?php

function html_table_jeux($jeux) {
    $html = "<table border='1' cellpadding='10'>";
    $html .= "<tr><th>Nom</th><th>Likes</th><th>Description</th><th>Modifier</th><th>Supprimer</th></tr>";
    foreach ($jeux as $jeu) {
        $id = $jeu["ID"];
        $html .= "<tr>
            <td>{$jeu['nomJeux']}</td>
            <td>{$jeu['nbLikes']}</td>
            <td>{$jeu['description']}</td>
            <td><a href='admin_jeux.php?action=update&JeuID=$id'><img src='../img/icons/edit.svg' width='30px'></a></td>
            <td><a href='admin_jeux.php?action=delete&JeuID=$id'><img src='../img/icons/delete.svg' width='30px'></a></td>
        </tr>";
    }
    $html .= "</table>";
    return $html;
}

function html_form_create_jeu() {
    return "<form method='POST' action='admin_jeux.php'>
        <label>Nom</label><input type='text' name='nom'><br>
        <label>Likes</label><input type='number' name='likes'><br>
        <label>Description</label><textarea name='description'></textarea><br>
        <input type='hidden' name='action' value='create'>
        <input type='submit' class='submit' value='Ajouter'>
    </form>";
}

function html_form_update_jeu($jeu) {
    return "<form method='POST' action='admin_jeux.php'>
        <label>Nom</label><input type='text' name='nom' value='{$jeu['nomJeux']}'><br>
        <label>Likes</label><input type='number' name='likes' value='{$jeu['nbLikes']}'><br>
        <label>Description</label><textarea name='description'>{$jeu['description']}</textarea><br>
        <input type='hidden' name='JeuID' value='{$jeu['ID']}'>
        <input type='hidden' name='action' value='update'>
        <input type='submit' class='submit' value='Mettre à jour'>
    </form>";
}
?>
